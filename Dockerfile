FROM studionone/nginx-php5:base

# Update apt and install sudo
RUN apt-get update -y && \
    apt-get install -y sudo

RUN echo "docker ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers

# Add configuration files
ADD conf/nginx.conf /etc/nginx/sites-enabled/main
ADD conf/local/fpm-env.conf /etc/nginx/fpm-env.conf
ADD conf/xdebug.ini /etc/php5/mods-available/xdebug.ini
ADD conf/php.ini /etc/php5/fpm/php.ini

# Setup core user
RUN useradd -m docker && echo "docker:docker" | chpasswd && adduser docker sudo
USER docker 
WORKDIR /home/docker

RUN sudo apt-get update && sudo apt-get install -y python gcc make g++ wget git --force-yes

ADD code /var/www
WORKDIR /var/www

ENV TERM xterm

RUN sudo /usr/local/bin/composer self-update

WORKDIR /

USER root
