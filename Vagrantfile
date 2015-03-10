Vagrant.configure("2") do |config|

  config.vm.box = "hashicorp/precise64"
  #config.vm.box_url = "http://files.vagrantup.com/precise32.box"

  config.vm.provision :shell, :path => "vagrantSetup.sh"
  #config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.network :private_network, ip: "192.168.66.66"

end