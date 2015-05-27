# Downloads and Installs node.js

# Download NVM
# MORE INFO: https://github.com/creationix/nvm
curl https://raw.githubusercontent.com/creationix/nvm/v0.25.0/install.sh | bash

# source in order to use nvm
source ~/.nvm/nvm.sh

# Install & use iojs
nvm install iojs
nvm use iojs


# BLEEDING - OR just use NGINX

# Run Node.js apps on low ports without running as root
# http://technosophos.com/2012/12/17/run-nodejs-apps-low-ports-without-running-root.html
# sudo apt-get install libcap2-bin
# sudo setcap cap_net_bind_service=+ep $(which iojs)