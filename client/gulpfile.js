var path = require('path'),
    gulp = require('gulp'),
    clean = require('gulp-clean'),
    inject = require('gulp-inject'),
    series = require('stream-series'),
    symlink = require('gulp-symlink'),
    uglify = require('gulp-uglify'),
    htmlmin = require('gulp-htmlmin'),
    connect = require('gulp-connect'),
    karma = require('gulp-karma'),
    jshint = require('gulp-jshint'),
    minifyCSS = require('gulp-minify-css'),
    sass = require('gulp-sass'),
    imagemin = require('gulp-imagemin'),
    protractor = require("gulp-protractor").protractor,
    program = require('commander'),
    stylish = require('jshint-stylish'),
    gulpif = require('gulp-if'),
    protractrorPagePort = '35000',
    livePagePort = '35001',
    debug = false,
    WATCH_MODE = 'watch',
    RUN_MODE = 'run',
    spawn = require('child_process').spawn,
    gutil = require('gulp-util');

var env = process.env.NODE_ENV || 'development';

var mode = RUN_MODE;

var userConfig = require('./build.config.js');

function list(val) {
  return val.split(',');
}

function resolveTargetDir() {
  return debug ? userConfig.build_dir : userConfig.compile_dir;
}

function startPhpServer() {
    var child = spawn("sh", ["serverForProtractor.sh"], {cwd: process.cwd()}),
        stdout = '',
        stderr = '';

    child.stdout.setEncoding('utf8');
    child.stdout.on('data', function (data) {
        stdout += data;
        //gutil.log(data);
    });

    child.stderr.setEncoding('utf8');
    child.stderr.on('data', function (data) {
        stderr += data;
        //gutil.log(gutil.colors.red(data));
    });

    child.on('close', function(code) {
        gutil.log("Done with exit code", code);
        //gutil.log("You access complete stdout and stderr from here"); // stdout, stderr
    });
}

function globWithTargetDir(globs) {
  return globs.filter(function (glob) {
    return !glob.match(/^\!/)}
  ).map(function (glob) {
      return glob.replace(/(\!?)/, '$1' + resolveTargetDir() + '/');
  });
}

program
  .version('0.0.1')
  .option('-t, --tests [glob]', 'Specify which tests to run')
  .option('-b, --browsers <items>', 'Specify which browsers to run on', list)
  .option('-r, --reporters <items>', 'Specify which reporters to use', list)
  .parse(process.argv);

gulp.task('clean:build', function () {
  return gulp.src([userConfig.build_dir + '/**/*.*'], {read: false})
    .pipe(clean());
});

gulp.task('clean:compile', function () {
  return gulp.src([userConfig.compile_dir], {read: false})
    .pipe(clean());
});

gulp.task('vendorJs', ['clean:build'], function() {
  var src = userConfig.vendor_files.js.concat(userConfig.vendor_files.dev);
  var jsTask = gulp.src(src, {base: './'});
  if (!debug) {
    jsTask
      .pipe(gulp.dest(userConfig.compile_dir));
  } else {
    jsTask
      .pipe(gulp.dest(userConfig.build_dir));
  }

  return jsTask
    .pipe(connect.reload());
});

gulp.task('vendorCss', ['clean:build'], function() {
  var src = userConfig.vendor_files.css;
  var jsTask = gulp.src(src, {base: './vendor/angular-material/'});
  if (!debug) {
    jsTask
      .pipe(gulp.dest(userConfig.compile_dir + '/assets'));
  } else {
    jsTask
      .pipe(gulp.dest(userConfig.build_dir + '/assets'));
  }

  return jsTask
    .pipe(connect.reload());
});

gulp.task('js', function() {
  var src = userConfig.app_files.js.concat(userConfig.app_files.atpl);
  var jsTask = gulp.src(src, {base: './src'});
  if (!debug) {
    jsTask
      .pipe(uglify())
      .pipe(gulp.dest(userConfig.compile_dir));
  } else {
    jsTask
      .pipe(gulp.dest(userConfig.build_dir));
  }

  return jsTask
    .pipe(connect.reload());
});

gulp.task('template', function() {
  var templateTask = gulp.src(userConfig.app_files.atpl, {base: './src'});
  if (!debug) {
    templateTask.pipe(htmlmin({ collapseWhitespace: true }));
  } else {
    templateTask
      .pipe(gulp.dest(userConfig.build_dir));
  }

  return templateTask.pipe(connect.reload());
});

gulp.task('index-html', ['assets'], function () {
  var target = gulp.src(userConfig.app_files.html, {base: 'src/'})
    .pipe(gulp.dest(userConfig.build_dir));
  var scripts = gulp.src(globWithTargetDir(userConfig.app_files.js), {read: false});
  var styles = gulp.src(globWithTargetDir(userConfig.app_files.styles), {read: false});

  return target
    .pipe(inject(series(scripts, styles), {addRootSlash: false, ignorePath: resolveTargetDir()}))
    .pipe(gulp.dest(userConfig.build_dir));
});

gulp.task('symlink', [], function () {
  return gulp.src([userConfig.build_dir])
    .pipe(symlink(['../public/build'], {force: true}));
});

gulp.task('css', ['clean:build'], function() {
  var options = {
    errLogToConsole: true
  };
  if (!debug) {
    options.outputStyle = 'expanded';
    options.sourceComments = 'map';
  }
  var cssTask = gulp.src(userConfig.app_files.sass)
    .pipe(sass(options));
  if (!debug) {
    cssTask
      .pipe(minifyCSS())
      .pipe(gulp.dest(userConfig.compile_dir + '/assets'))
  } else {
    cssTask
      .pipe(gulp.dest(userConfig.build_dir + '/assets'));
  }

  return cssTask
    .pipe(connect.reload());
});

gulp.task('image', function () {
  //return gulp.src('src/image/**.*')
  //  .pipe(imagemin())
  //  .pipe(gulp.dest(userConfig.build_dir + '/assets/image'))
  //  .pipe(connect.reload());
});

gulp.task('lint', function() {
  return gulp.src(userConfig.app_files.js)
    .pipe(jshint())
    .pipe(jshint.reporter(stylish));
});

gulp.task('karma', function() {
  // undefined.js: unfortunately necessary for now
  return gulp.src(['undefined.js'])
    .pipe(karma({
      configFile: 'karma.conf.js',
      action: mode,
      tests: program.tests,
      reporters: program.reporters || 'dots',
      browsers: program.browsers || ['PhantomJS']
    }))
    .on('error', function() {});
});

gulp.task('protractor', function(done) {
  startPhpServer();
  gulp.src(userConfig.app_files.jsscenario)
    .pipe(protractor({
      configFile: 'protractor.conf.js',
      args: [
        '--baseUrl', 'http://localhost:' + protractrorPagePort,
        '--browser', program.browsers ? program.browsers[0] : 'phantomjs'
      ]
    }))
    .on('end', function() {
      if (mode === RUN_MODE) {
        connect.serverClose();
      }
      done();
    })
    .on('error', function() {
      if (mode === RUN_MODE) {
        connect.serverClose();
      }
      done();
    });
});

gulp.task('connect', function() {
  connect.server({
    livereload: mode === WATCH_MODE,
    port: livePagePort,
    root: userConfig.build_dir
  });
});

gulp.task('debug', function() {
  debug = true;
});

gulp.task('watch-mode', function() {
  mode = WATCH_MODE;

  var jsWatcher = gulp.watch(userConfig.app_files.js, ['js', 'karma', 'protractor']),
    cssWatcher = gulp.watch(userConfig.app_files.scss, ['css', 'protractor']),
    //imageWatcher = gulp.watch('src/image/**/*', ['image']),
    htmlWatcher = gulp.watch(userConfig.app_files.atpl, ['template', 'protractor']),
    testWatcher = gulp.watch(userConfig.app_files.jsunit, ['karma']);
    testWatcher = gulp.watch(userConfig.app_files.jsscenario, ['protractor']);

  function changeNotification(event) {
    console.log('File', event.path, 'was', event.type, ', running tasks...');
  }

  jsWatcher.on('change', changeNotification);
  cssWatcher.on('change', changeNotification);
  //imageWatcher.on('change', changeNotification);
  htmlWatcher.on('change', changeNotification);
  testWatcher.on('change', changeNotification);
});

gulp.task('assets', ['css', 'js', 'lint', 'image']);
gulp.task('all', ['assets', 'karma', 'protractor']);
gulp.task('default', ['watch-mode', 'all']);
gulp.task('server', ['connect', 'default']);
gulp.task('test', ['debug', 'connect', 'karma', 'protractor']);

gulp.task('build', ['debug', 'clean:build', 'vendorJs', 'vendorCss', 'assets', 'index-html', 'symlink']);
gulp.task('watch', ['build', 'watch-mode']);//, 'connect', 'karma', 'protractor']);
