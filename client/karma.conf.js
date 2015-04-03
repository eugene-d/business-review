module.exports = function(config) {
  var userConfig = require('./build.config.js');
  var testFiles = [
    'app/requirejs-config.js',
    '../test/unit.config.js',
    { pattern: 'app/**/*.js', included: false },
    { pattern: 'vendor/**/*.js', included: false }
  ];

  var options = JSON.parse(process.argv[2]);

  if (options.tests) {
    testFiles.push({ pattern: 'test/unit/' + options.test, included: false });
  } else {
    testFiles.push({ pattern: '../' + userConfig.app_files.jsunit, included: false });
  }

  config.set({
    basePath: './build',
    frameworks: ['requirejs', 'mocha', 'chai'],
    files: testFiles,
    autoWatch: false,
    captureTimeout: 60000
  });
};
