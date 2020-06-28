# Url Shortener
Project to receive a shorten URL and redirect to full one

# Dependencies

You need to install composer, docker and docker-compose

### Composer install:
https://www.digitalocean.com/community/tutorials/how-to-install-composer-on-ubuntu-20-04-quickstart-pt

### Docker and docker-compose install (apt distros):

```sh
sudo apt update
sudo apt install apt-transport-https ca-certificates curl software-properties-common
sudo apt install build-essential
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
sudo apt update
sudo apt install docker-ce
sudo service docker start
sudo curl -L "https://github.com/docker/compose/releases/download/1.26.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```

### Add docker to groups:
```sh
sudo usermod -aG docker ${USER}
sudo reboot
```

# Configure the environment:

### Install project dependencies

```sh
cd /path-to-project/url-shortener
make install
make start
```
After that, you can access the project at: `http://localhost:8000`
