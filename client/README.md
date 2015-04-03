# [ng-boilerplate](http://ianwalter.github.io/ng-boilerplate/)
*A base for front-end development with AngularJS.*

#### ng-boilerplate includes:
* **Application**
    * [RequireJS](http://requirejs.org/) - JavaScript file and module loader
    * [Sass](http://sass-lang.com/) - CSS extension language
    * [Bourbon](http://bourbon.io/) - Mixin library for Sass
    * [Neat](http://neat.bourbon.io/) - Grid framework for Sass and Bourbon
    * [Bitters](http://bitters.bourbon.io/) - Scaffold styles for Bourbon projects
    * [Refills](http://refills.bourbon.io/) - Prepackaged patterns built on top of Bourbon
    * [Bower](http://bower.io/) - Front-end package manager
    * [Gulp](http://gulpjs.com/) - Streaming build system
* **Testing**
    * [angular-mocks](https://github.com/angular/bower-angular-mocks/) - Mocking for AngularJS
    * [Karma](http://karma-runner.github.io/) - JavaScript unit test runner
    * [Mocha](http://mochajs.org/) - Testing framework
    * [Chai](http://chaijs.com/) - Super-flexible assertion library
    * [Protractor](https://github.com/angular/protractor/) - End-to-end test runner
* **Style**
    * [airbnb/javascript](https://github.com/airbnb/javascript/) - JavaScript Style Guide


#### Instructions:
* Install bower using ```sudo npm install bower -g```. Then run bower in the ng-boilerplate directory to install 
  front-end dependencies: ```bower install```.
* Install gulp using ```sudo npm install gulp -g```. Then install the gulp plugins: ```npm install```.
* Run ```gulp``` to compile, minify, lint and test front-end assets.
* Run ```gulp debug default``` while you are developing so that you can use the unminified version of your assets.
* Run ```gulp server``` or ```gulp debug server``` if you want the default task run and your files served by a 
  development HTTP server (includes livereload!)
* Run ```gulp test``` to execute a single run of tests.


#### Additional Instructions
npm install -g phantomjs
npm install -g protractor
webdriver-manager update

#### Environment Variables
NODE_ENV = production
NODE_ENV = development

#### HTTP Server for Protractror
cd client/build
php -S 127.0.0.1:35000