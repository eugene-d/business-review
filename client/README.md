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


#### SetUp instructions
cd client/
sudo npm install bower -g
bower install
sudo npm install gulp -g
sudo npm install

#### Additional Instructions
sudo npm install phantomjs -g
sudo npm install protractor -g
sudo webdriver-manager update
Insure java is installed, need for run selenium server.

#### Environment Variables
NODE_ENV = production
NODE_ENV = development

#### HTTP Server for Protractror
cd client/build
php -S 127.0.0.1:35000

#### Starting instructions
gulp build (create client/build dir with app content)
gulp watch (watching over sources dir and apply changes)