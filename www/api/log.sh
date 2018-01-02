#!/bin/bash

#PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin:/alidata/server/mysql/bin:/alidata/server/nginx/sbin:/alidata/server/php/sbin:/alidata/server/php/bin:/root/bin
#export PATH
. /etc/profile
    if [ `ps aux|grep -v grep|grep php|wc -l` -gt 1 ]
    then
        echo "active"
    else
        echo "miss"
fi
       /alidata/server/php/bin/php  /alidata/www/m.uzhuang.com/www/api/log.php &

