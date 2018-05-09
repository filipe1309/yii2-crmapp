Vagrant.configure("2") do |config|

# Which box we'll be using as base
config.vm.box = "hashicorp/precise64"

# Following is only for reference, as Vagrant knows
# where to get the "precise64" box right from the start.
# config.vm.box_url = "http://files.vagrantup.com/precise64.box"

# What to do with the base box as initial setup
config.vm.provision :shell, :path => "bootstrap/01-prepare-precise64.sh"
config.vm.provision :shell, :path => "bootstrap/02-configure-app-for-precise64.sh"
config.vm.provision :shell, :path => "bootstrap/03-configure-app.sh"

# How to expose the web application inside the box:
# publish port 80 at the virtual machine as port 8888 at the host machine.
config.vm.network "forwarded_port", guest: 80, host: 8888

end
