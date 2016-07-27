var pkg = require('../package.json');
var ngtemplate = require('../' + pkg.main);
var path = require('path');
var extend = require('lodash.assign');
var File = require('gulp-util').File;
var Buffer = require('buffer').Buffer;
var should = require('should');
require('mocha');

describe('gulp-ngtemplate', function() {

  var defaults;

  beforeEach(function() {
    defaults = {
      path: '/tmp/test/fixture/file.js',
      cwd: '/tmp/test/',
      base: '/tmp/test/fixture/'
    };
  });

  describe('ngtemplate()', function() {
    var testfilePath;

    beforeEach(function() {
      testFilePath = path.normalize('/tmp/test/fixture/file.js');
    });

    it('should properly compile a template', function(done) {

      var fixture = new File(extend({contents: new Buffer('<div>foo</div>')}, defaults));
      var header = 'angular.module(\'ngTemplates\').run([\'$templateCache\', function($templateCache) {';
      var footer = '}]);';

      var stream = ngtemplate();
      stream.on('data', function(newFile){
        should.exist(newFile);
        should.exist(newFile.path);
        should.exist(newFile.relative);
        should.exist(newFile.contents);
        should.equal(newFile.contents.toString(), ['\'use strict\';', header, '  $templateCache.put(\'file.js\', \'<div>foo</div>\');', footer].join('\n\n'));
        newFile.path.should.equal(testFilePath);
        newFile.relative.should.equal('file.js');
      });
      stream.once('end', done);
      stream.write(fixture);
      stream.end();

    });

    it('should support module option as a string', function(done) {

      var fixture = new File(extend({contents: new Buffer('<div>foo</div>')}, defaults));
      var header = 'angular.module(\'foo\').run([\'$templateCache\', function($templateCache) {';
      var footer = '}]);';

      var stream = ngtemplate({module: 'foo'});
      stream.on('data', function(newFile){
        should.exist(newFile);
        should.exist(newFile.path);
        should.exist(newFile.relative);
        should.exist(newFile.contents);
        should.equal(newFile.contents.toString(), ['\'use strict\';', header, '  $templateCache.put(\'file.js\', \'<div>foo</div>\');', footer].join('\n\n'));
        newFile.path.should.equal(testFilePath);
        newFile.relative.should.equal('file.js');
      });
      stream.once('end', done);
      stream.write(fixture);
      stream.end();

    });

    it('should generate a os independent template key', function(done) {

       defaults.path = '/tmp/test/fixture/extra/file.js';
       testFilePath = path.normalize(defaults.path);
       var testFileRelative = path.relative(defaults.base, defaults.path);
       var fixture = new File(extend({contents: new Buffer('<div>foo</div>')}, defaults));
       var header = 'angular.module(\'ngTemplates\').run([\'$templateCache\', function($templateCache) {';
       var footer = '}]);';

       var stream = ngtemplate();
       stream.on('data', function(newFile){
         should.exist(newFile);
         should.exist(newFile.path);
         should.exist(newFile.relative);
         should.exist(newFile.contents);
         should.equal(newFile.contents.toString(), ['\'use strict\';', header, '  $templateCache.put(\'extra/file.js\', \'<div>foo</div>\');', footer].join('\n\n'));
         newFile.path.should.equal(testFilePath);
         newFile.relative.should.equal(testFileRelative);
       });
       stream.once('end', done);
       stream.write(fixture);
       stream.end();
     });

    it('should support module option as a function', function(done) {

      var fixture = new File(extend({contents: new Buffer('<div>foo</div>')}, defaults));
      var header = 'angular.module(\'foo.file.js\').run([\'$templateCache\', function($templateCache) {';
      var footer = '}]);';

      var stream = ngtemplate({module: function(name) { return 'foo.' + name; }});
      stream.on('data', function(newFile){
        should.exist(newFile);
        should.exist(newFile.path);
        should.exist(newFile.relative);
        should.exist(newFile.contents);
        should.equal(newFile.contents.toString(), ['\'use strict\';', header, '  $templateCache.put(\'file.js\', \'<div>foo</div>\');', footer].join('\n\n'));
        newFile.path.should.equal(testFilePath);
        newFile.relative.should.equal('file.js');
      });
      stream.once('end', done);
      stream.write(fixture);
      stream.end();

    });

    it('should support standalone option', function(done) {

      var fixture = new File(extend({contents: new Buffer('<div>foo</div>')}, defaults));
      var header = 'angular.module(\'ngTemplates\', []).run([\'$templateCache\', function($templateCache) {';
      var footer = '}]);';

      var stream = ngtemplate({standalone: true});
      stream.on('data', function(newFile){
        should.exist(newFile);
        should.exist(newFile.path);
        should.exist(newFile.relative);
        should.exist(newFile.contents);
        should.equal(newFile.contents.toString(), ['\'use strict\';', header, '  $templateCache.put(\'file.js\', \'<div>foo</div>\');', footer].join('\n\n'));
        newFile.path.should.equal(testFilePath);
        newFile.relative.should.equal('file.js');
      });
      stream.once('end', done);
      stream.write(fixture);
      stream.end();

    });

  });

});
