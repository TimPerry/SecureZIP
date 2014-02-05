Vagrant.configure("2") do |config|

  config.vm.box = "precise64"
  config.vm.network :private_network, ip: "192.168.122.122"

  config.vm.synced_folder "./vagrant", "/vagrant", id: "vagrant-root", owner: "www-data", group: "www-data"
  config.vm.synced_folder "./", "/var/www", id: "web-root", owner: "www-data", group: "www-data", :nfs => false

  config.vm.provision :shell, :path => "./vagrant/setup.sh"

  config.ssh.username = "vagrant"
  config.ssh.shell = "bash -l"
  config.ssh.keep_alive = true
  config.ssh.forward_agent = false
  config.ssh.forward_x11 = false
  config.vagrant.host = :detect

end