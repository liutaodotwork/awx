# Samples of Payment Acceptance Services Powered By Airwallex


This repo demonstrates a smooth and secure payment flow that the payment services are provided by [airwallex.com](https://airwallex.com).


## Web server Nginx configuration

```
server {

    charset utf-8;
    listen 80;
    server_name domain.com;

    # Remove trailing slash
    rewrite ^/(.*)/$ /$1 permanent;

    root        /path/to/awx/webroot;
    index       index.php;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/dev/shm/php-cgi.sock;
        fastcgi_index index.php;
        include fastcgi.conf;
        try_files $uri =404;
    }

    location ~ /\.(ht|svn|git) {
        deny all;
    }

   error_log /data/wwwlogs/error_nginx.log crit;
}
```
