# gulp-ngtemplate [![Build Status](https://secure.travis-ci.org/mgcrea/gulp-ngtemplate.png?branch=master)](http://travis-ci.org/#!/mgcrea/gulp-ngtemplate)

> Gulp task to precompile AngularJS templates with `$templateCache`.


## Getting Started
This plugin requires Gulp `^3.0.0`

If you haven't used [Gulp](http://gulpjs.com/) before, be sure to check out the [Getting Started](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md) guide, as it explains how to create a [Gulpfile](https://github.com/gulpjs/gulp/blob/master/docs/API.md) as well as install and use Gulp plugins. Once you're familiar with that process, you may install this plugin with this command:

```shell
npm install gulp-ngtemplate --save-dev
```

Once the plugin has been installed, it may be required inside your Gulpfile with this line of JavaScript:

```js
var ngtemplate = require('gulp-ngtemplate');
```


## Usage

```javascript
var htmlmin = require('gulp-htmlmin');
var ngtemplate = require('gulp-ngtemplate');

gulp.task('templates:dist', function() {
  gulp.src('{,*/}*.tpl.html')
    .pipe(htmlmin({collapseWhitespace: true}))
    .pipe(ngtemplate({module: function(name) { return 'mgcrea.ngStrap.' + name.split('/')[0]; }}))
    .pipe(gulp.dest('dist'));
});
```


## Options

- module (Function/String)

Name of the AngularJS module.

Default: `ngTemplates`

- standalone (Function/String)

Create an AngularJS module.

Default: false


## Contributing
In lieu of a formal styleguide, take care to maintain the existing coding style. Add unit tests for any new or changed functionality.


## License

The MIT License (MIT)

Copyright (c) 2014 Olivier Louvignes

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
