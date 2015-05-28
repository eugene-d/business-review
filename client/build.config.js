module.exports = {
  build_dir: 'build',
  compile_dir: 'bin',

  app_files: {
    js: ['src/**/*.js', '!src/**/*.spec.js', '!src/**/*.scenario.js'],
    jsunit: 'src/**/*.spec.js',
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
      'vendor/angular-ui-router/release/angular-ui-router.js',
      'vendor/angular-animate/angular-animate.js',
      'vendor/angular-aria/angular-aria.js',
      'vendor/angular-material/angular-material.js',
      'vendor/angular-resource/angular-resource.js',
      'vendor/requirejs/require.js'
    ],
    css: [
      'vendor/angular-material/angular-material.css',
      'vendor/components-font-awesome/css/font-awesome.css',
      'vendor/components-font-awesome/fonts/fontawesome-webfont.svg',
      'vendor/components-font-awesome/fonts/fontawesome-webfont.woff',
      'vendor/components-font-awesome/fonts/fontawesome-webfont.woff2'
    ],
    dev: [
      'vendor/angular-mocks/angular-mocks.js'
    ]
  }
};

