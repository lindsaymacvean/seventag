/**
 * Copyright (C) 2015 Digimedia Sp. z.o.o. d/b/a Clearcode
 *
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License as published by the Free
 * Software Foundation, either version 3 of the License, or (at your option) any
 * later version.
 *
 * This program is distrubuted in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
/// <reference path="typings/tsd.d.ts" />
var WEB_DIR = 'web', REPORTS_DIR = 'reports', SOURCE_DIR = 'src', TEST_DIR = 'tests', DEST_DIR = 'web', TEMP_DIR = '.tmp', APP_DIR = 'app', CODE_COVERAGE_DIR = 'build/coverage', ADMIN_NAMESPACE = 'admin-panel', DEBUGGER_NAMESPACE = 'container-debugger';
var gulp = require('gulp-help')(require('gulp')), config = require('./package.json').config, sourcemaps = require('gulp-sourcemaps'), gulpif = require('gulp-if'), minify = true, argv = require('yargs').argv, fs = require('fs'), path = require('path');
var env = argv.env || 'prod', baseUrl = argv.specs || 'http://7tag.dev/';
process.env.PHANTOMJS_BIN = 'node_modules/.bin/phantomjs';
// --------------- CLEAN ---------------------------------
var rimraf = require('gulp-rimraf');
gulp.task('build:clean', 'Remove build folders before build', function () {
    return gulp.src([
        DEST_DIR + '/' + ADMIN_NAMESPACE + '/**/*.js',
        DEST_DIR + '/' + ADMIN_NAMESPACE + '/**/*.css',
        DEST_DIR + '/' + ADMIN_NAMESPACE + '/**/*.html',
        DEST_DIR + '/' + ADMIN_NAMESPACE + '/**/*.php',
        DEST_DIR + '/' + DEBUGGER_NAMESPACE + '/**/*.js',
        DEST_DIR + '/' + DEBUGGER_NAMESPACE + '/**/*.css',
        DEST_DIR + '/' + DEBUGGER_NAMESPACE + '/**/*.html',
    ])
        .pipe(rimraf());
});
// --------------- WEBDRIVER -----------------------
var protractor = require('gulp-protractor');
gulp.task('webdriver:update', 'Download latest webdriver release', protractor.webdriver_update);
gulp.task('webdriver:standalone', 'Run webdriver with selenium', protractor.webdriver_standalone);
// --------------- IMAGES -----------------------
var imagesSource = [SOURCE_DIR + '/**/images/*'];
gulp.task('build:images', 'Prepare images to production release', function () {
    return gulp.src(imagesSource)
        .pipe(gulp.dest(DEST_DIR));
});
var debuggerIconsSource = [
    SOURCE_DIR + '/' + DEBUGGER_NAMESPACE + '/**/*.svg'
];
gulp.task('build:debugger-icons', 'Build icons for debugger', function () {
    return gulp.src(debuggerIconsSource)
        .pipe(gulp.dest(DEST_DIR + '/' + DEBUGGER_NAMESPACE));
});
gulp.task('watch:debugger-icons', 'Watch debugger icons for changes', function () {
    gulp.watch(debuggerIconsSource, ['build:debugger-icons']);
});
gulp.task('watch:images', 'Watch images for changes and run build', function () {
    gulp.watch(imagesSource, ['build:images']);
});
// --------------- FONTS -----------------------
var iconfont = require('gulp-iconfont'), consolidate = require('gulp-consolidate'), sass = require('gulp-sass');
var fontsSource = APP_DIR + '/icons/*.svg';
var FONT_NAME = '7tagicon';
function fonts(sassSource, cssDest) {
    return gulp.src(fontsSource)
        .pipe(iconfont({
        fontName: FONT_NAME,
        normalize: true
    }))
        .on('glyphs', function (glyphs) {
        gulp.src(sassSource)
            .pipe(consolidate('lodash', {
            glyphs: glyphs,
            fontName: FONT_NAME,
            fontPath: 'fonts/',
            className: 'icon'
        }))
            .pipe(sass())
            .pipe(gulp.dest(cssDest));
    });
}
gulp.task('build:fonts-admin', 'Build fonts based on svg icons', function () {
    return fonts(SOURCE_DIR + '/' + ADMIN_NAMESPACE + '/app/icons.scss', DEST_DIR + '/' + ADMIN_NAMESPACE)
        .pipe(gulp.dest(DEST_DIR + '/' + ADMIN_NAMESPACE + '/fonts'));
});
gulp.task('build:fonts-debugger', 'Build fonts based on svg icons for debugger', function () {
    return fonts(SOURCE_DIR + '/' + ADMIN_NAMESPACE + '/app/icons.scss', DEST_DIR + '/' + DEBUGGER_NAMESPACE)
        .pipe(gulp.dest(DEST_DIR + '/' + DEBUGGER_NAMESPACE + '/fonts'));
});
gulp.task('watch:fonts', 'Watch fonts for changes and run fonts build', function () {
    gulp.watch(fontsSource, [
        'build:fonts-admin',
        'build:fonts-debugger'
    ]);
});
// --------------- STYLES -----------------------
var csso = require('gulp-csso'), concat = require('gulp-concat'), rename = require('gulp-rename');
var stylesSource = [
    SOURCE_DIR + '/**/*.scss',
    '!' + SOURCE_DIR + '/**/_*.scss',
    '!' + SOURCE_DIR + '/' + ADMIN_NAMESPACE + '/app/icons.scss'
];
gulp.task('build:styles', 'Build sass styles file', function () {
    return gulp.src(stylesSource)
        .pipe(sass())
        .pipe(gulpif(minify, csso()))
        .pipe(gulp.dest(DEST_DIR));
});
gulp.task('watch:styles', 'Watch styles for changes', function () {
    gulp.watch(SOURCE_DIR + '/**/*.scss', ['build:styles']);
});
gulp.task('build:vendor-styles-admin', 'Copy vendor styles for admin panel', function () {
    gulp.src([
        'bower_components/animate.css/animate.min.css',
        'bower_components/codemirror/lib/codemirror.css',
        'bower_components/codemirror/addon/lint/lint.css'
    ])
        .pipe(gulp.dest(DEST_DIR + '/' + ADMIN_NAMESPACE));
});
gulp.task('build:vendor-styles-debugger', 'Add animate.css to debugger styles', function () {
    gulp.src([
        'bower_components/animate.css/animate.min.css'
    ])
        .pipe(gulp.dest(DEST_DIR + '/' + DEBUGGER_NAMESPACE));
});
// --------------- SCRIPTS -----------------------
var browserify = require('browserify'), babelify = require('babelify'), source = require('vinyl-source-stream'), wiredep = require('wiredep'), uglify = require('gulp-uglify'), replace = require('gulp-replace'), babel = require('gulp-babel'), template = require('gulp-template'), html2js = require('html2js'), gutil = require('gulp-util'), buffer = require('vinyl-buffer');
function bundle(namespace) {
    var bundler = browserify(SOURCE_DIR + '/' + namespace + '/app/app-' + env + '.js', {
        debug: true
    }).transform(babelify, { presets: ['es2015'] });
    return bundler.bundle()
        .on('error', function (err) {
        console.log(err);
        this.emit('end');
    })
        .pipe(source('app.js'))
        .pipe(buffer())
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(gulpif(minify, uglify()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(DEST_DIR + '/' + namespace));
}
gulp.task('build:scripts-admin', 'Build javascript files with sourcemaps for admin panel', function () {
    return bundle(ADMIN_NAMESPACE);
});
gulp.task('build:vendors-admin', 'Build javascript vendor files for admin panel', function () {
    var bowerDeps = wiredep({
        dependencies: true,
        devDependencies: env !== 'prod'
    });
    return gulp.src(bowerDeps.js, { base: 'bower_components' })
        .pipe(concat('vendor.js'))
        .pipe(gulpif(minify, uglify()))
        .pipe(gulp.dest(DEST_DIR + '/' + ADMIN_NAMESPACE));
});
gulp.task('watch:scripts-admin', 'Watch javascript files for changes for admin panel', function () {
    gulp.watch(SOURCE_DIR + '/' + ADMIN_NAMESPACE + '/**/*.js', ['build:scripts-admin']);
});
var debuggerSource = [
    SOURCE_DIR + '/container-debugger/**/*.js',
    '!' + SOURCE_DIR + '/container-debugger/debug.js'
];
gulp.task('build:scripts-debugger', 'Build javascript files with sourcemaps for debugger', function () {
    var sourcemapsOpt = {
        sourceRoot: process.cwd() + '/' + SOURCE_DIR + '/container-debugger'
    };
    return gulp.src(debuggerSource)
        .pipe(sourcemaps.init())
        .pipe(babel())
        .pipe(concat('scripts.js'))
        .pipe(gulpif(minify, uglify()))
        .pipe(sourcemaps.write('./', sourcemapsOpt))
        .pipe(gulp.dest(DEST_DIR + '/container-debugger'));
});
gulp.task('build:vendors-debugger', 'Build javascript vendor files for debugger', function () {
    var bowerDeps = wiredep({
        dependencies: true,
        devDependencies: env !== 'prod'
    });
    return gulp.src(bowerDeps.js, { base: 'bower_components' })
        .pipe(concat('vendor.js'))
        .pipe(gulpif(minify, uglify().on('error', gutil.log)))
        .pipe(gulp.dest(DEST_DIR + '/' + DEBUGGER_NAMESPACE));
});
var debuggerIndexFile = DEST_DIR + '/' + DEBUGGER_NAMESPACE + '/index.html';
gulp.task('build:iframe-debugger', 'Build debug.js file', function () {
    var filename = debuggerIndexFile, filePath = path.resolve(__dirname, filename), source = fs.readFileSync(filePath, 'utf8');
    var tpl = html2js(source, {
        mode: 'default',
        wrap: false
    });
    return gulp.src(SOURCE_DIR + '/' + DEBUGGER_NAMESPACE + '/debug.js')
        .pipe(template({
        template: tpl
    }))
        .pipe(gulpif(minify, uglify()))
        .pipe(gulpif(env === 'dev', replace(/##host##/g, baseUrl + "container-debugger")))
        .pipe(gulp.dest(DEST_DIR + '/' + DEBUGGER_NAMESPACE));
});
gulp.task('build:scripts-container', 'Build container script', function () {
    return gulp.src(config.containerSource)
        .pipe(concat('library.js.dist'))
        .pipe(gulpif(minify, uglify().on('error', gutil.log)))
        .pipe(gulp.dest(APP_DIR + '/Resources/container-lib'));
});
gulp.task('build:container-bootstrap', 'Copy bootstrap file to symfony resource folder', function () {
    return gulp.src(config.bootstrapSource)
        .pipe(concat('bootstrap.js.dist'))
        .pipe(gulpif(minify, uglify()))
        .pipe(gulp.dest(APP_DIR + '/Resources/container-lib'));
});
gulp.task('watch:scripts-container', 'Watch container javascript source for changes', function () {
    gulp.watch(config.containerSource, ['build:scripts-container']);
});
gulp.task('watch:scripts-debugger', 'Watch javascript files for changes in debugger', function () {
    gulp.watch(debuggerSource, ['build:scripts-debugger']);
});
// --------------- TEMPLATES -----------------------
var jade = require('gulp-jade'), ejs = require('./src/gulp/gulp-ejs'), i18n = require('i18n'), ngTemplate = require('gulp-ngtemplate'), htmlreplace = require('gulp-html-replace'), versionJson = require('./version.json');
var templateJadeSource = [
    SOURCE_DIR + '/**/*.jade',
    '!' + SOURCE_DIR + '/**/_*.jade',
    '!' + SOURCE_DIR + '/' + ADMIN_NAMESPACE + '/index.jade'
];
var templateEjsSource = [
    SOURCE_DIR + '/' + DEBUGGER_NAMESPACE + '/**/*.html',
    '!' + SOURCE_DIR + '/' + DEBUGGER_NAMESPACE + '/**/_*.html'
];
var indexSource = [SOURCE_DIR + '/' + ADMIN_NAMESPACE + '/index.jade'];
i18n.configure({
    locales: ['en'],
    defaultLocale: 'en',
    directory: APP_DIR + '/locales'
});
function templatesJadeBuild(templates) {
    return gulp.src(templates)
        .pipe(jade({
        pretty: true,
        locals: {
            '__': function (phrase) {
                return phrase;
            },
            'getLocale': i18n.getLocale,
            'version': versionJson.version
        }
    }))
        .on('error', function (err) {
        console.error(err.toString());
        this.emit('end');
    });
}
function templateEjsBuild(templates) {
    return gulp.src(templates)
        .pipe(ejs({
        getLocale: i18n.getLocale,
        version: versionJson.version,
        __: i18n.__
    }));
}
gulp.task('build:templates-ejs', 'Build templates for debugger with ejs', function () {
    return templateEjsBuild(templateEjsSource)
        .pipe(gulp.dest(DEST_DIR + '/' + DEBUGGER_NAMESPACE));
});
gulp.task('build:templates-jade', 'Build templates for admin panel with jade', function () {
    return templatesJadeBuild(templateJadeSource)
        .pipe(gulp.dest(DEST_DIR));
});
gulp.task('build:template-cached-debugger', 'Add debugger templates to templateCache service', function () {
    return gulp.src([
        DEST_DIR + '/' + DEBUGGER_NAMESPACE + '/**/*.html',
        '!' + DEST_DIR + '/' + DEBUGGER_NAMESPACE + '/*.html'
    ])
        .pipe(ngTemplate({
        module: 'stg.debugger.templates'
    }))
        .pipe(concat('templates.cache.js'))
        .pipe(gulp.dest(DEST_DIR + '/' + DEBUGGER_NAMESPACE));
});
gulp.task('build:templates-index', 'Build templates index and change it to php extension', function () {
    return templatesJadeBuild(indexSource)
        .pipe(gulpif(env === 'dev', gulp.dest(DEST_DIR + '/' + ADMIN_NAMESPACE)))
        .pipe(rename('index.php'))
        .pipe(htmlreplace({
        'pluginsjstop': '<?php $pathTop = __DIR__.\'/../../var/cache/seventagPluginsJavascriptTop.php\'; if(is_file($pathTop)) { require_once $pathTop; } ?>',
        'pluginsjsbottom': '<?php $pathBottom = __DIR__.\'/../../var/cache/seventagPluginsJavascriptBottom.php\'; if(is_file($pathBottom)) { require_once $pathBottom; } ?>',
        'oauthsettings': '<?php $path = __DIR__.\'/../../var/cache/OAuthClientSettings.php\'; if(is_file($path)) { require_once $path; } ?>'
    }))
        .pipe(gulp.dest(DEST_DIR + '/' + ADMIN_NAMESPACE));
});
gulp.task('watch:templates-jade', 'Watch jade templates for changes', function () {
    var source = templateJadeSource.concat(indexSource);
    gulp.watch(source, [
        'build:templates-jade',
        'build:templates-index'
    ]);
});
gulp.task('watch:templates-ejs', 'Watch ejs templates for changes', function () {
    gulp.watch(SOURCE_DIR + '/' + DEBUGGER_NAMESPACE + '/**/*.html', [
        'build:templates-ejs'
    ]);
});
// --------------- INJECT -----------------------
var inject = require('gulp-inject');
gulp.task('build:inject-admin', 'Inject styles, scripts and php tags to index of admin', function () {
    var vendors = gulp.src(DEST_DIR + '/' + ADMIN_NAMESPACE + '/vendor.js', { read: false });
    var sources = gulp.src([
        DEST_DIR + '/' + ADMIN_NAMESPACE + '/*.js',
        DEST_DIR + '/' + ADMIN_NAMESPACE + '/app/vendor.css',
        DEST_DIR + '/' + ADMIN_NAMESPACE + '/**/*.css',
        '!' + DEST_DIR + '/' + ADMIN_NAMESPACE + '/vendor.js'
    ], { read: false });
    return gulp.src(DEST_DIR + '/' + ADMIN_NAMESPACE + '/index.*')
        .pipe(inject(vendors, { name: 'vendors', relative: true }))
        .pipe(inject(sources, { relative: true, addRootSlash: true }))
        .pipe(gulp.dest(DEST_DIR + '/' + ADMIN_NAMESPACE));
});
// --------------- OTHERS -----------------------
var othersSource = [
    SOURCE_DIR + '/' + ADMIN_NAMESPACE + '/**/*.ico',
    'bower_components/zeroclipboard/dist/ZeroClipboard.swf'
];
gulp.task('build:others', 'Build every other not handled in other tasks', function () {
    return gulp.src(othersSource)
        .pipe(gulp.dest(DEST_DIR + '/' + ADMIN_NAMESPACE));
});
gulp.task('watch:others', 'Watch not built files for changes', function () {
    gulp.watch(othersSource, ['build:others']);
});
// --------------- TEST -------------------------
var karma = require('gulp-karma');
var adminTestSource = SOURCE_DIR + '/' + ADMIN_NAMESPACE + '/**/*.spec.js', debuggerTestSource = TEST_DIR + '/' + DEBUGGER_NAMESPACE + '/**/*.spec.js', adminCoverageReportFile = 'coverage-admin-panel.xml', debuggerCoverageReportFile = 'coverage-debugger.xml';
function testWithCodeCoverage(srcFiles, instrumentedFile, coverageOutputFile) {
    var preprocessors = {};
    preprocessors[instrumentedFile] = ['sourcemap', 'coverage'];
    return gulp
        .src(srcFiles)
        .pipe(karma({
        configFile: 'unit.conf.js',
        preprocessors: preprocessors,
        basePath: '.',
        coverageReporter: {
            type: 'clover',
            dir: CODE_COVERAGE_DIR,
            basePath: '.',
            subdir: '.',
            file: coverageOutputFile
        },
        action: 'run'
    }))
        .on('error', function (err) {
        throw err;
    });
}
gulp.task('tests:admin-build', 'Build javascript test files for admin panel', function () {
    return gulp.src(adminTestSource)
        .pipe(babel())
        .pipe(gulp.dest(TEMP_DIR + '/' + ADMIN_NAMESPACE));
});
gulp.task('tests:admin-unit', 'Run unit tests for admin panel', ['tests:admin-build'], function () {
    var fileToInstrument = '**' + DEST_DIR + '/' + ADMIN_NAMESPACE + '/app.js', srcFiles = [
        DEST_DIR + '/' + ADMIN_NAMESPACE + '/vendor.js',
        DEST_DIR + '/' + ADMIN_NAMESPACE + '/app.js',
        TEMP_DIR + '/' + ADMIN_NAMESPACE + '/**/*.spec.js'
    ];
    return testWithCodeCoverage(srcFiles, fileToInstrument, adminCoverageReportFile);
});
gulp.task('tests:admin-unit:multiBrowsers', 'Run unit tests for admin panel in saucelabs', ['tests:admin-build'], function () {
    return gulp.src([
        DEST_DIR + '/' + ADMIN_NAMESPACE + '/vendor.js',
        DEST_DIR + '/' + ADMIN_NAMESPACE + '/app.js',
        TEMP_DIR + '/' + ADMIN_NAMESPACE + '/**/*.spec.js'
    ])
        .pipe(karma({
        configFile: 'adminpanel-ci.conf.js',
        action: 'run'
    }))
        .on('error', function (err) {
        throw err;
    });
});
gulp.task('tests:debugger-build', 'Build javascript test files for admin panel', function () {
    return gulp.src(debuggerTestSource)
        .pipe(babel())
        .pipe(gulp.dest(TEMP_DIR + '/' + DEBUGGER_NAMESPACE));
});
gulp.task('tests:debugger-unit', 'Run unit tests for debugger', ['tests:debugger-build'], function () {
    var fileToInstrument = DEST_DIR + '/' + DEBUGGER_NAMESPACE + '/scripts.js', srcFiles = [
        DEST_DIR + '/' + DEBUGGER_NAMESPACE + '/vendor.js',
        DEST_DIR + '/' + DEBUGGER_NAMESPACE + '/scripts.js',
        TEMP_DIR + '/' + DEBUGGER_NAMESPACE + '/**/*.spec.js'
    ];
    return testWithCodeCoverage(srcFiles, fileToInstrument, debuggerCoverageReportFile);
});
gulp.task('tests:debugger-unit:multiBrowsers', 'Run unit tests for debugger in saucelabs', ['tests:debugger-build'], function () {
    return gulp.src([
        DEST_DIR + '/' + DEBUGGER_NAMESPACE + '/vendor.js',
        DEST_DIR + '/' + DEBUGGER_NAMESPACE + '/scripts.js',
        TEMP_DIR + '/' + DEBUGGER_NAMESPACE + '/**/*.spec.js'
    ])
        .pipe(karma({
        configFile: 'debugger-ci.conf.js',
        action: 'run'
    }))
        .on('error', function (err) {
        throw err;
    });
});
gulp.task('watch:tests-admin', 'Watch unit tests on changes', function () {
    gulp.watch(adminTestSource, ['tests:admin-unit']);
});
gulp.task('tests:e2e-debugger-container', 'Rebuild desination folder for debugger e2e tests', function () {
    return gulp.src(TEST_DIR + '/' + DEBUGGER_NAMESPACE + '/tests/mock/stg.js')
        .pipe(gulp.dest(DEST_DIR + '/' + DEBUGGER_NAMESPACE));
});
gulp.task('tests:e2e-debugger-replace-path', 'Replace ##host## to your vhost for debugger e2e tests', function () {
    return gulp.src([
        DEST_DIR + '/' + DEBUGGER_NAMESPACE + '/index.test.html',
        DEST_DIR + '/' + DEBUGGER_NAMESPACE + '/index.test.referrer.html'
    ])
        .pipe(ejs({
        getLocale: i18n.getLocale,
        version: versionJson.version,
        __: i18n.__
    }))
        .pipe(replace(/##host##/g, baseUrl + '/' + DEBUGGER_NAMESPACE))
        .pipe(gulp.dest(DEST_DIR + '/' + DEBUGGER_NAMESPACE));
});
gulp.task('tests:e2e-debugger', 'Run e2e tests for debugger', [
    'tests:e2e-debugger-container',
    'tests:e2e-debugger-replace-path'
], function () {
    var specs = argv.specs || TEST_DIR + '/' + DEBUGGER_NAMESPACE + '/tests/e2e/tag_detail_view.feature';
    var args = [
        '--baseUrl',
        baseUrl + DEBUGGER_NAMESPACE + '/'
    ];
    return gulp.src(specs)
        .pipe(protractor.protractor({
        configFile: 'e2e.conf.js',
        args: args
    }))
        .on('error', function (err) {
        throw err;
    });
});
gulp.task('tests:e2e-admin', 'Run e2e tests for admin', function () {
    var specs = argv.specs || [
        TEST_DIR + '/' + ADMIN_NAMESPACE + '/tests/e2e/**/**/*.feature'
    ];
    var args = [
        '--baseUrl',
        baseUrl
    ];
    return gulp.src(specs)
        .pipe(protractor.protractor({
        configFile: 'e2e.conf.js',
        args: args
    }))
        .on('error', function (err) {
        throw err;
    });
});
// --------------- BUILD -------------------------
var runSequence = require('run-sequence').use(gulp);
gulp.task('build', 'Build application', function (done) {
    runSequence('build:clean', [
        'build:images',
        'build:debugger-icons',
        'build:fonts-admin',
        'build:fonts-debugger',
        'build:styles',
        'build:scripts-admin',
        'build:vendors-admin',
        'build:scripts-debugger',
        'build:vendors-debugger',
        'build:templates-jade',
        'build:templates-ejs',
        'build:templates-index',
        'build:others',
        'build:vendor-styles-admin',
        'build:scripts-container',
        'build:container-bootstrap'
    ], [
        'build:template-cached-debugger',
        'build:iframe-debugger',
        'build:inject-admin',
        'build:vendor-styles-debugger'
    ], done);
});
gulp.task('start', 'Run build of application and watch on changes to build application in realtime', function (done) {
    minify = false;
    runSequence('build', [
        'watch:debugger-icons',
        'watch:scripts-debugger',
        'watch:images',
        'watch:fonts',
        'watch:styles',
        'watch:templates-jade',
        'watch:templates-ejs',
        'watch:scripts-admin',
    ], done);
});
gulp.task('test', 'Run unit tests', function (done) {
    env = 'dev';
    minify = false;
    runSequence('build', [
        'tests:admin-unit',
        'tests:debugger-unit'
    ], done);
});
gulp.task('e2e', 'Run e2e tests', function (done) {
    env = 'prod';
    runSequence('build', 'tests:e2e-admin', 
    //'tests:e2e-debugger',
    done);
});
