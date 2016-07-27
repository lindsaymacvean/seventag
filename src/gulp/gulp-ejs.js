'use strict';

var through = require('through2'),
    gutil = require('gulp-util'),
    ejs = require('ejs');

module.exports = function (data, options, settings, filters) {

    for (var filter in filters) {

        if (filters.hasOwnProperty(filter)) {

            ejs.filters[filter] = filters[filter];

        }

    }

    ejs.open = '{@';
    ejs.close = '@}';

    data = data || {};
    settings = settings || {};
    options = options || {};
    settings.ext = typeof settings.ext === 'undefined' ? '.html' : settings.ext;

    return through.obj(function (file, enc, cb) {

        if (file.isNull()) {

            this.push(file);
            return cb();

        }

        if (file.isStream()) {

            this.emit(
                'error',
                new gutil.PluginError('gulp-ejs', 'Streaming not supported')
            );

        }

        options.filename = file.path;
        try {

            file.contents = new Buffer(ejs.render(file.contents.toString(), data, options));
            file.path = gutil.replaceExtension(file.path, settings.ext);

        } catch (err) {

            this.emit('error', new gutil.PluginError('gulp-ejs', err.toString()));

        }

        this.push(file);
        cb();

    });

};
