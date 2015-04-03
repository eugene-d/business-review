module.exports = {
  build_dir: 'build',
  compile_dir: 'bin',

  app_files: {
    js: ['src/**/*.js', '!src/**/*.spec.js', '!src/**/*.scenario.js'],
    jsunit: ['src/**/*.spec.js'],
    jsscenario: ['src/**/*.scenario.js'],
    html: ['src/index.html'],
    styles: ['assets/*.css'],
    scss: ['src/sass/**/*.scss'],
    sass: ['src/sass/app.scss'],
    atpl: ['src/**/*.tpl.html']
  },

  vendor_files: {
    js: [
      'vendor/angular/angular.js',
      'vendor/angular-route/angular-route.js',
      'vendor/requirejs/require.js'
    ],
    dev: [
      'vendor/angular-mocks/angular-mocks.js'
    ]
  }
};

