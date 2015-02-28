# PressVarrs

> This is a work in progress. Subject to sweeping changes at random intervals until the 1.0.0 :)

### Prerequisites
- [Latest Vagrant](http://vagrantup.com)
- VirtualBox (optional)
- Amazon Web Services account (optional)
- Digital Ocean account (optional)

# Install
```
vagrant up
````

# Vagrant up to AWS
Create a new EC2 instance on the AWS platform.

```
vagrant up --provider=aws
```

Required definitions:

- username
- keypair_name
- private_key_path


### Example devops.json for AWS

```
[
    {
        "hostname": "pressvarrs",
        "aws": {
            "access_key_id": "xxxxxxxxxx",
            "secret_access_key": "xxxxxxxxxx",
            "username": "ubuntu",
            "keypair_name": "my-aws-keypair",
            "private_key_path": "~/.ssh/my-aws-keypair.pem"
        }
    }
]
```

### Recommendations:

- Read up on [all available configuration settings](https://github.com/mitchellh/vagrant-aws) for vagrant-aws.
- Consider setting `elastic_ip` to true for more longer lived instances.
- Use your `subnet_id` to boot up smaller instances outside of your VPC.
- Consider adding your AWS credentials to your `.bashrc` or `.zshrc` file and remove it from `devops.json`.
- [Check out the AWS documentation](http://aws.amazon.com/ec2/instance-types/) on various instance types available.


# Vagrant up to Digital Ocean

```
vagrant up --provider=digital_ocean
```
Required definitions:

- token
- private_key_path

### Example devops.json for DO

```
[
    {
        "hostname": "pressvarrs",
        "digital_ocean": {
            "token": "xxxxxxxxxx",
            "private_key_path": "~/.ssh/my-do-keypair.pem"
        }
    }
]
```


# Vagrant plugins

The following plugins are in use:

- [vagrant-triggers](https://github.com/fgrehm/vagrant-cachier)
- [vagrant-cachier](https://github.com/fgrehm/vagrant-cachier)
- [vagrant-exec](https://github.com/p0deje/vagrant-exec)
- [vagrant-pristine](https://github.com/fgrehm/vagrant-pristine)
- [vagrant-hostsupdater](https://github.com/cogitatio/vagrant-hostsupdater)
- [vagrant-awsinfo](https://github.com/johntdyer/vagrant-awsinfo)
- [vagrant-aws](https://github.com/mitchellh/vagrant-aws)
- [vagrant-digitalocean](https://github.com/smdahlen/vagrant-digitalocean)
- [vagrant-managed-servers](https://github.com/tknerr/vagrant-managed-servers)

# Troubleshooting

```
VPCResourceNotSpecified => The specified instance type can only be used in a VPC. A subnet ID or network interface ID is required to carry out the request.
```
   - Navigate to https://console.aws.amazon.com/vpc/
   - Click on the left navigation menu "Subnets"
   - Use any of the "Subnet ID" identifiers in the table list.

```
No host IP was given to the Vagrant core NFS helper. This is an internal error that should be reported as a bug.
```
   - Remove any NFS flags from your shared_folders definition in order to use AWS
