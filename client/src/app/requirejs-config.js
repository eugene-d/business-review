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
    'angular-animate': [
      '../vendor/angular-animate/angular-animate'
    ],
    'angular-aria': [
      '../vendor/angular-aria/angular-aria'
    ],
    'angular-material': [
      '../vendor/angular-material/angular-material'
    ],
    'angular-resource': [
      '../vendor/angular-resource/angular-resource'
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
    'angular-animate': {
      deps: ['angular']
    },
    'angular-aria': {
      deps: ['angular']
    },
    'angular-material': {
      deps: ['angular']
    },
    'angular-resource': {
      deps: ['angular']
    },
    'uiRouter': {
      deps: ['angular']
    }
  }
};