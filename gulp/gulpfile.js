const {dest, src, series, parallel, watch} = require('gulp');

const sass = require('gulp-sass');
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const autoprefixer = require('gulp-autoprefixer');
const rename = require('gulp-rename');
var mmq = require('gulp-merge-media-queries');

sass.compiler = require('node-sass');


const themeRoot = '../';
const styleSRC = themeRoot + 'assets/sass/style.scss';
const themeInfo = themeRoot + 'assets/sass/_themeInfo.css';
const styleDestination = themeRoot + '/assets/css/src/';
const sassWatchFiles = themeRoot + 'assets/sass/**/*.scss';
const jsWatchFiles = themeRoot + 'assets/js/src/*.js';

function sassCompile(cb) {
    return src(styleSRC)
        .pipe(sass({
            indentedSyntax: false,
            indentType: 'space',
            indentWidth: 4,
            outputStyle: 'expanded',

        }).on('error', sass.logError))
        .pipe(autoprefixer({
            cascade: false,
            overrideBrowserslist: 'last 2 versions'
        }))
        .pipe(mmq({
            log: '*'
        }))
        .pipe(cleanCSS({
            compatibility: '*',
            format: 'beautify',
            level: 2
        }))
        .pipe(dest(styleDestination))
        .pipe(rename({suffix: '.min'}))
        .pipe(cleanCSS({
            compatibility: '*'
        }))
        .pipe(dest(styleDestination));
}

function createThemeStyle(cb) {
    return src([themeInfo, styleDestination + 'style.min.css'], {base: 'assets'})
        .pipe(concat('style.css'))
        .pipe(dest(themeRoot));
}

exports.default = function () {
    watch(sassWatchFiles, {ignoreInitial: false}, series(sassCompile, createThemeStyle));
};