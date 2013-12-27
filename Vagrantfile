# -*- mode: ruby -*-
# vi: set ft=ruby :

require 'rubygems'
require 'json'

boxfile = "Varrgrant.json"
sampleboxfile = "Varrgrant-sample.json"

# Can't run vagrant without Vagrantfile.json
unless File.exists?(boxfile) then
    FileUtils.copy_file(sampleboxfile, boxfile)
    puts "[success] Copied #{sampleboxfile} to #{boxfile}."
    puts "[info] Configure your vagrant environment by adding Varrgrant definitions to #{boxfile}."
    exit
end

boxes = JSON.parse(File.read(boxfile));

puts "[info] Loading box configuration from #{boxfile}"

# Vagrantfile API version.
VAGRANTFILE_API_VERSION = "2"

# provider: vmware_fusion, aws, rackspace, virtualbox
case "#{ARGV[1]}"; when '--provider=aws'; provider = 'aws'; when '--provider=vmware_fusion'; provider = 'vmware_fusion'; else; provider = 'virtualbox'; end if ARGV[1]

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

    # SETUP global configuration for boxes
    box_config_global = proc do |box_config|

        box_config.vm.box = "precise"

        case provider
            when 'vmware_fusion'
                box_config.vm.box_url = "http://files.vagrantup.com/precise64_vmware.box"
            when 'aws'
                box_config.vm.box_url = "https://github.com/mitchellh/vagrant-aws/raw/master/dummy.box"
            when 'rackspace'
                box_config.vm.box_url = "https://github.com/mitchellh/vagrant-rackspace/raw/master/dummy.box"
            else
                box_config.vm.box_url = "http://cloud-images.ubuntu.com/vagrant/precise/current/precise-server-cloudimg-amd64-vagrant-disk1.box"
        end

        if defined? VagrantPlugins::Cachier
            # plugin: vagrant-cachier
            puts "[info] Enabled: vagrant-cachier"
            box_config.cache.scope = :machine
        end

        if defined? VagrantPlugins::Vbguest
            # plugin: vagrant-vbguest
            puts "[info] Enabled: vagrant-vbguest"

            # we will try to autodetect this path.
            # However, if we cannot or you have a special one you may pass it like:
            # config.vbguest.iso_path = "#{ENV['HOME']}/Downloads/VBoxGuestAdditions.iso"
            # or
            # config.vbguest.iso_path = "http://company.server/VirtualBox/%{version}/VBoxGuestAdditions.iso"

            # set auto_update to false, if do NOT want to check the correct additions
            # version when booting this machine
            box_config.vbguest.auto_update = false

            # do NOT download the iso file from a webserver
            box_config.vbguest.no_remote = false
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

            if box["disable_default_synced_folder"]
                # Uncomment the following line to turn off the default synced folder:
                config.vm.synced_folder ".", "/vagrant", id: "vagrant-root", disabled: true
            end

            if box["config"]
                config.ssh.username = box["config"]["ssh_username"] if box["config"]["ssh_username"]
                config.ssh.host = box["config"]["ssh_host"] if box["config"]["ssh_host"]
                config.ssh.port = box["config"]["ssh_port"] if box["config"]["ssh_port"]
                config.ssh.private_key_path = box["config"]["ssh_private_key_path"] if box["config"]["ssh_private_key_path"]
                config.ssh.forward_agent = box["config"]["forward_agent"] if box["config"]["forward_agent"]
                config.ssh.forward_x11 = box["config"]["forward_x11"] if box["config"]["forward_x11"]
                config.ssh.shell = box["config"]["shell"] if box["config"]["shell"]
            end

            config.vm.provider :virtualbox do |node|
                if box["customize"]
                    node.gui = true if box["customize"]["gui"]
                    node.customize ["modifyvm", :id, "--cpus", box["customize"]["cpus"] ] if box["customize"]["cpus"]
                    node.customize ["modifyvm", :id, "--memory", box["customize"]["memory"] ] if box["customize"]["memory"]
                end
            end

            config.vm.provider :vmware_fusion do |node|
                if box["customize"]
                    node.gui = true if box["customize"]["gui"]
                    node.vmx["numvcpus"] = box["customize"]["cpus"] if box["customize"]["cpus"]
                    node.vmx["memsize"] = box["customize"]["cpus"] if box["customize"]["memory"]
                end
            end

            config.vm.provider :aws do |aws, override|
                if box["ami"]
                    # I'd like to use environment variables for these,
                    # but cant seem to get it working for the life of me. grrr!
                    aws.access_key_id = box["ami"]["access_key_id"]
                    aws.secret_access_key = box["ami"]["secret_access_key"]
                    aws.keypair_name = box["ami"]["keypair_name"]
                    override.ssh.private_key_path = box["ami"]["private_key_path"]
                    override.ssh.username = box["ami"]["username"]

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
                    rs.username = box["rackspace"]["username"]
                    rs.api_key = box["rackspace"]["api_key"]

                    rs.flavor = box["rackspace"]["flavor"] ? "#{box["rackspace"]["flavor"]}MB" : /512MB/
                    rs.image = box["rackspace"]["image"] if box["rackspace"]["image"]

                    override.ssh.username = box["rackspace"]["ssh_username"] if box["rackspace"]["ssh_username"]
                    override.ssh.private_key_path = box["rackspace"]["private_key_path"] if box["rackspace"]["private_key_path"]
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

            if box["chef"] and defined? VagrantPlugins::Omnibus
                # plugin: vagrant-omnibus
                puts "[info] Enabled: vagrant-ominbus"
                config.omnibus.chef_version = :latest

                # plugin: vagrant-berkshelf
                puts "[info] Enabled: vagrant-berkshelf"
                config.berkshelf.enabled = true

                config.vm.provision :chef_solo do |chef|
                    chef.log_level = :debug if box["chef"]["debug_log"]

                    chef.roles_path = "ops/roles"
                    chef.environments_path = "ops/environments"

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