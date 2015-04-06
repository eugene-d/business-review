var requirejsConfig = { // jshint ignore:line
  baseUrl: './app',
  paths: {
    'vendor': '../vendor',
    'angular': [
      '../vendor/angular/angular'
    ],
    'angular-route': [
      '../vendor/angular-route/angular-route'
    ],
    'uiRouter': [
      '../vendor/angular-ui-router/release/angular-ui-router'
    ]
  },
  shim: {
    'angular': {
      exports: 'angular'
    },
    'angular-route': {
      deps: ['angular']
    },
    'uiRouter': {
      deps: ['angular']
    }
  }
};