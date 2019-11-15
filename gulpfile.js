const cssnano = require('cssnano');
const gulp = require('gulp');
const postcss = require('gulp-postcss');
const less = require('gulp-less');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const LessAutoprefix = require('less-plugin-autoprefix');
const autoprefix = new LessAutoprefix({ browsers: ['last 15 versions'] });

const css = () => {
  return gulp
    .src('./assets/less/main.less')
    .pipe(sourcemaps.init())
    .pipe(less({
      plugins: [autoprefix]
    }))
    .pipe(postcss([cssnano()]))
    .pipe(sourcemaps.write())
    .pipe(rename('style.css'))
    .pipe(gulp.dest('./'));
};

exports.build = css;
exports.default = css;
