#!/bin/bash

chown www-data:www-data -R /home/logs/project /home/logs/php

/usr/local/bin/php /www/dataflow/src/public/console/index.php request_uri=/transfer start -d

