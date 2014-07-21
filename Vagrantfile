# -*- mode: ruby -*-
# vi: set ft=ruby :

require 'rubygems'
require 'json'

# Can't run vagrant without Vagrantfile.json
if File.exists?("Varrgrant.local.json")
	boxfile = "Varrgrant.local.json"
elsif File.exists?("Varrgrant.json")
	boxfile = "Varrgrant.json"
elsif ! boxes File.exists?("Varrgrant-sample.json")
	FileUtils.copy_file("Varrgrant-sample.json", "Varrgrant.json")
	puts "[success] Copied Varrgrant-sample.json to Varrgrant.json."
	puts "[info] Configure your vagrant environment by adding Varrgrant definitions to Varrgrant.json."
	exit
end

boxes = JSON.parse(File.read(boxfile));

puts "[info] Loading box configuration from #{boxfile}"

# Vagrantfile API version.
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

	# SETUP global configuration for boxes
	box_config_global = proc do |box_config|

		box_config.vm.box = "precise"
		box_config.vm.box_url = "http://cloud-images.ubuntu.com/vagrant/precise/current/precise-server-cloudimg-amd64-vagrant-disk1.box"

		if defined? VagrantPlugins::Cachier
			# plugin: vagrant-cachier
			puts "[info] Enabled: vagrant-cachier"
			box_config.cache.scope = :machine
		end

		if defined? VagrantPlugins::Vbguest
			# plugin: vagrant-vbguest
			puts "[info] Enabled: vagrant-vbguest"
		end
	end

	# SETUP box configuration
	boxes.each do |box|
		next unless box["hostname"]

		hostname = (box["hostname"].kind_of? String) ? box["hostname"] : box["hostname"].first

		config.vm.define hostname do |config|
			box_config_global.call(config)

			config.vm.hostname = hostname

			if box["ip"]
				if box["ip"].kind_of? String
					config.vm.network "private_network", ip: box["ip"], :netmask => "255.255.255.0"
				else
					box["ip"].each do |ipaddress|
						config.vm.network "private_network", ip: ipaddress, :netmask => "255.255.255.0"
					end
				end
			end

			if defined? VagrantPlugins::HostsUpdater and box["hostname"] and box["ip"]
				# plugin - hostsupdater
				puts "[info] Enabled: vagrant-hostsupdater"
				# temp until I get host entries to be unique.
				box["hostname"].shift if box["hostname"].kind_of?(Array)

				config.hostsupdater.aliases = box["hostname"] if box["hostname"].kind_of?(Array)
			end

			if box["port_fowarding"]
				box["port_fowarding"].each do |port|
					config.vm.network "forwarded_port", guest: port["guest"], host: port["host"]
				end
			end

			if box["synced_folders"]
				box["synced_folders"].each do |params|
					next unless ( params.include?('host') or params.include?('guest') )

					folder_args = Hash[params.map{ |key, value| next if ( !params.include? 'host' or !params.include? 'guest' ); [key.to_sym, value] }]

					# Make the directory if it doesnt exists
					FileUtils.mkdir_p(params["host"]) unless File.exists?(params["host"])

					config.vm.synced_folder params["host"], params["guest"], folder_args
				end
			end

			if box["config"]
				config.ssh.username = box["config"]["ssh_username"] if box["config"]["ssh_username"]
				config.ssh.host = box["config"]["ssh_host"] if box["config"]["ssh_host"]
				config.ssh.port = box["config"]["ssh_port"] if box["config"]["ssh_port"]
				config.ssh.private_key_path = box["config"]["ssh_private_key_path"] if box["config"]["ssh_private_key_path"]
				config.ssh.forward_agent = box["config"]["forward_agent"] if box["config"]["forward_agent"]
				config.ssh.forward_x11 = box["config"]["forward_x11"] if box["config"]["forward_x11"]
				config.ssh.shell = box["config"]["shell"] if box["config"]["shell"]

				if box["config"]["disable_default_synced_folder"]
					config.vm.synced_folder ".", "/vagrant", id: "vagrant-root", disabled: true
				end
			end

			config.vm.provider :virtualbox do |virtualbox, override|
				if box["customize"]
					virtualbox.gui = true if box["customize"]["gui"]
					virtualbox.customize ["modifyvm", :id, "--cpus", box["customize"]["cpus"] ] if box["customize"]["cpus"]
					virtualbox.customize ["modifyvm", :id, "--memory", box["customize"]["memory"] ] if box["customize"]["memory"]
				end
			end

			config.vm.provider :vmware_fusion do |vmware, override|
				if box["customize"]
					override.vm.box_url = "http://files.vagrantup.com/precise64_vmware.box"
					vmware.gui = true if box["customize"]["gui"]
					vmware.vmx["numvcpus"] = box["customize"]["cpus"] if box["customize"]["cpus"]
					vmware.vmx["memsize"] = box["customize"]["cpus"] if box["customize"]["memory"]
				end
			end

			config.vm.provider :aws do |aws, override|
				if box["ami"]
					override.vm.box_url = "https://github.com/mitchellh/vagrant-aws/raw/master/dummy.box"
					override.ssh.private_key_path = box["ami"]["private_key_path"]
					override.ssh.username = box["ami"]["username"]

					aws.keypair_name = box["ami"]["keypair_name"]

					aws.ami = box["ami"]["id"] if box["ami"]["id"]
					aws.availability_zone = box["ami"]["availability_zone"] if box["ami"]["availability_zone"]
					aws.region = box["ami"]["region"] if box["ami"]["region"]
					aws.instance_type = box["ami"]["instance_type"] if box["ami"]["instance_type"]
					aws.security_groups = box["ami"]["security_groups"] if box["ami"]["security_groups"]
					aws.iam_instance_profile_arn = box["ami"]["iam_instance_profile_arn"] if box["ami"]["iam_instance_profile_arn"]
					aws.iam_instance_profile_name = box["ami"]["iam_instance_profile_name"] if box["ami"]["iam_instance_profile_name"]
					aws.use_iam_profile = box["ami"]["use_iam_profile"] if box["ami"]["use_iam_profile"]
					aws.private_ip_address = box["ami"]["private_ip_address"] if box["ami"]["private_ip_address"]
					aws.subnet_id = box["ami"]["subnet_id"] if box["ami"]["subnet_id"]
					aws.tags = box["ami"]["tags"] if box["ami"]["tags"]
					aws.user_data = box["ami"]["user_data"] if box["ami"]["user_data"]
				end
			end

			config.vm.provider :rackspace do |rs, override|
				if box["rackspace"]
					override.vm.box_url = "https://github.com/mitchellh/vagrant-rackspace/raw/master/dummy.box"
					override.ssh.username = box["rackspace"]["ssh_username"] if box["rackspace"]["ssh_username"]
					override.ssh.private_key_path = box["rackspace"]["private_key_path"] if box["rackspace"]["private_key_path"]

					rs.username = box["rackspace"]["username"]
					rs.api_key = box["rackspace"]["api_key"]
					rs.flavor = box["rackspace"]["flavor"] ? "#{box["rackspace"]["flavor"]}MB" : /512MB/
					rs.image = box["rackspace"]["image"] if box["rackspace"]["image"]
					rs.public_key_path = box["rackspace"]["public_key_path"] if box["rackspace"]["public_key_path"]

					rs.server_name = hostname
					rs.disk_config = box["rackspace"]["disk_config"] if box["rackspace"]["disk_config"]
					rs.rackspace_region = :dfw unless box["rackspace"]["rackspace_region"]
					rs.rackspace_compute_url = box["rackspace"]["rackspace_compute_url"] if box["rackspace"]["rackspace_compute_url"]
					rs.rackspace_auth_url = box["rackspace"]["rackspace_auth_url"] if box["rackspace"]["rackspace_auth_url"]

					if box["rackspace"]["network"]
						box["rackspace"]["network"].each do |network|
							rs.network = network
						end
					end
				end
			end

			config.vm.provider :digital_ocean do |digital_ocean, override|
				if box["digital_ocean"]
					override.vm.box_url = "https://github.com/smdahlen/vagrant-digitalocean/raw/master/box/digital_ocean.box"
					override.ssh.private_key_path = box["digital_ocean"]["private_key_path"]

					digital_ocean.client_id = box["digital_ocean"]["client_id"]
					digital_ocean.api_key = box["digital_ocean"]["api_key"]

					digital_ocean.ssh_key_name = box["digital_ocean"]["ssh_key_name"] if box["digital_ocean"]["ssh_key_name"]
					digital_ocean.image = box["digital_ocean"]["image"] if box["digital_ocean"]["image"]
					digital_ocean.region = box["digital_ocean"]["region"] if box["digital_ocean"]["region"]
					digital_ocean.size = box["digital_ocean"]["size"] if box["digital_ocean"]["size"]
					digital_ocean.private_networking = box["digital_ocean"]["private_networking"] if box["digital_ocean"]["private_networking"]
					digital_ocean.setup = box["digital_ocean"]["setup"] if box["digital_ocean"]["setup"]
				end
			end

			if box["chef"] and defined? VagrantPlugins::Omnibus
				# plugin: vagrant-omnibus
				puts "[info] Enabled: vagrant-ominbus"
				config.omnibus.chef_version = :latest

				config.vm.provision :chef_solo do |chef|
					chef.log_level = :debug if box["chef"]["debug_log"]

					chef.roles_path = "ops/roles"
					chef.cookbooks_path = ["ops/cookbooks", "vendor/cookbooks"]
					chef.environments_path = "ops/environments"

					#chef.data_bags_path = "ops/data_bags_path"
					#chef.synced_folder_type = "NFS"

					# Register custom chef attributes
					chef.json = box["chef"]["json"] if box["chef"]["json"]

					chef.environment = box["chef"]["environment"] if box["chef"]["environment"]
					chef.json["chef_environment"] = box["chef"]["environment"] if box["chef"]["environment"]

					if box["chef"]["recipes"]
						if box["chef"]["recipes"].kind_of? String
							chef.add_recipe "recipe[#{box["chef"]["recipes"]}]"
						else
							box["chef"]["recipes"].each do |recipe|
								chef.add_recipe "recipe[#{recipe}]"
							end
						end
					end

					if box["chef"]["roles"]
						if box["chef"]["roles"].kind_of? String
							chef.add_role box["chef"]["roles"]
						else
							box["chef"]["roles"].each do |role|
								chef.add_role role
							end
						end
					end
				end
			end
		end
	end
end