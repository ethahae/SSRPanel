#!/bin/sh
set -e
printenv >> /etc/environment
service cron start
runuser -u www-data "php artisan queue:work database --queue=default --timeout=60 --sleep=5 --tries=3 &"
exec apache2-foreground