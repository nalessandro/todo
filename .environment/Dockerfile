FROM ubuntu:18.04
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y \
    software-properties-common \
    apt-transport-https \
    lsb-release \
    ca-certificates \
    curl \
    git \
    unzip \
    vim \
    apache2 \
    apache2-utils \
    wget

RUN a2dismod mpm_event
RUN a2enmod mpm_prefork

# ACTIVATE APAHCE mod_rewrite 
RUN a2enmod rewrite

# REMOVE VHOSTS
RUN rm /etc/apache2/sites-enabled/* && rm /etc/apache2/sites-available/*

## INSTALL ppa:ondrej/php
RUN add-apt-repository ppa:ondrej/php
# RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
# RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list

RUN apt-get update && apt-get install -yq \
    libapache2-mod-php7.2 \
    php7.2 \
    php7.2-dev \
    # php7.2-mysql \
    php7.2-curl \
    php7.2-mbstring \
    php7.2-json \
	php7.2-mongodb \
	php7.2-imagick \
	php7.2-xml \
    php7.2-mongodb \
    php7.2-gd \
    php7.2-zip

RUN /bin/bash -c 'pecl install xdebug'

RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN echo "date.timezone = America/New_York" >> /etc/php/7.2/apache2/php.ini 
RUN echo "date.timezone = America/New_York" >> /etc/php/7.2/cli/php.ini

RUN mkdir /etc/php/7.2/extras
RUN mkdir /etc/php/7.2/extras/ssl
RUN wget http://curl.haxx.se/ca/cacert.pem --directory-prefix=/etc/php/7.2/extras/ssl
RUN echo 'curl.cainfo = "/etc/php/7.2/extras/ssl/cacert.pem"' >> /etc/php/7.2/apache2/php.ini
RUN echo 'curl.cainfo = "/etc/php/7.2/extras/ssl/cacert.pem"' >> /etc/php/7.2/cli/php.ini

RUN echo "[XDebug]" >> /etc/php/7.2/apache2/php.ini
RUN echo "zend_extension = /usr/lib/php/20170718/xdebug.so" >> /etc/php/7.2/apache2/php.ini
RUN echo "xdebug.remote_enable = 1" >> /etc/php/7.2/apache2/php.ini
RUN echo "xdebug.remote_autostart = 1" >> /etc/php/7.2/apache2/php.ini
RUN echo "xdebug.remote_host=host.docker.internal" >> /etc/php/7.2/apache2/php.ini
RUN echo "xdebug.remote_log=/var/www/app/xdebug.log" >> /etc/php/7.2/apache2/php.ini
RUN echo "xdebug.remote_handler=dbgp" >> /etc/php/7.2/apache2/php.ini
RUN echo "xdebug.idekey=VSCODE" >> /etc/php/7.2/apache2/php.ini

RUN apt-get remove --purge -y git \
    apt-transport-https \
    gnupg2 \
    lsb-release

RUN apt-get clean

RUN echo 'alias sf="php app/console"' >> ~/.bashrc
RUN echo 'alias sf4="php bin/console"' >> ~/.bashrc
RUN echo '### Git Branch in Bash Prompt ###' >> ~/.bashrc
RUN echo 'parse_git_branch() {' >> ~/.bashrc
RUN echo "    git branch 2> /dev/null | sed -e '/^[^*]/d' -e 's/* \(.*\)/ (\1)/'" >> ~/.bashrc
RUN echo '}' >> ~/.bashrc
RUN echo 'export PS1="\[\e[34m\]\h\[\e[m\] \[\033[32m\]\W\[\033[33m\]\$(parse_git_branch)\[\033[00m\] $ "' >> ~/.bashrc

WORKDIR /var/www/html
CMD ["/usr/sbin/apachectl", "-D", "FOREGROUND"]