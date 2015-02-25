# PressVarrs

> This is a work in progress. Very alpha, subject to sweeping changes at random intervals :)

# Prereqs
- Vagrant
- VirtualBox (optional)
- Amazon Web Services account (optional)
- Digital Ocean account (optional)

# Install
`vagrant up`

# Vagrant up to AWS
Create a new EC2 instance on the AWS platform.

Required definitions:
	- username
	- keypair_name
	- private_key_path

Recommendations:
	- Consider using an elastic_ip for more longer lived instances.
	- Use your subnet_id to boot up smaller instances outside of your VPC.
	- Consider adding your AWS credentials to your .bashrc or .zshrc file and remove it from `devops.json`

`vagrant up --provider=aws`

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
# Troubleshooting

- Running `vagrant up --provider=aws` throws the following error:
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
