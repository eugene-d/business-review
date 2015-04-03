var requirejsConfig = { // jshint ignore:line
  baseUrl: './',
  paths: {
    'angular': [
      'vendor/angular/angular',
    ],
    'angular-route': [
      'vendor/angular-route/angular-route'
    ]
  },
  shim: {
    'angular': {
      exports: 'angular'
    },
    'angular-route': {
      deps: ['angular']
    }
  }
};