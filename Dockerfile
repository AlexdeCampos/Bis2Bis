FROM wyveo/nginx-php-fpm:php81

COPY --chown=www-data:www-data . /usr/share/nginx/html
COPY nginx.conf /etc/nginx/conf.d/default.conf
RUN chmod -R 765 /usr/share/nginx/

WORKDIR /usr/share/nginx/html

RUN apt update; \ 
    apt install vim -y

RUN ln -s public html