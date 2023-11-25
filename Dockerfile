FROM wyveo/nginx-php-fpm:php81

COPY . /usr/share/nginx/html
COPY nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /usr/share/nginx/html

RUN apt update; \ 
    apt install vim -y

RUN ln -s public html