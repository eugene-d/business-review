(function(requirejs) {
  'use strict';

  requirejs.config(window.requirejsConfig);

  require(['app'], function (app) {
    app.init();
  });

})(window.requirejs);