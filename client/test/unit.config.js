var tests = [];

for (var file in window.__karma__.files) {
  if (window.__karma__.files.hasOwnProperty(file)) {
    if (/.*\.spec\.js$/.test(file)) {
      tests.push(file);
    }
  }
}

requirejsConfig.paths['angular-mocks'] = '../vendor/angular-mocks/angular-mocks';
requirejsConfig.shim['angular-mocks'] = {
  deps: ['angular']
};

requirejsConfig.baseUrl = './base/build/app';
requirejsConfig.deps = tests;
requirejsConfig.callback = window.__karma__.start;

requirejs.config(requirejsConfig);
