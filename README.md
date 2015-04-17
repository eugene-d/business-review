# business-review

##Vagrant deployment

- Add to hosts file "192.168.66.66  br.dev"
- Install virtualBox and vagrant [downloads](https://www.vagrantup.com/downloads.html)
```sh 
    $ vagrant box add hashicorp/precise64
```
```sh 
    $ vagrant up
```
- Then in browser [http://br.dev](http://br.dev)


![phpStorm Xdebug Screenshot](https://raw.githubusercontent.com/eugene-d/business-review/master/public/img/phpStormXdebug.png)

##Debug mode
If you do not see errors in debug mode try next:
```sh
chmod -R 777 server/www/storage/
```