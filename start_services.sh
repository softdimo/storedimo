#!/bin/bash
# Inicia la API de Lumen en segundo plano
php -S 0.0.0.0:8000 -t /var/www/html/api/public &

# Inicia Apache en primer plano
apache2ctl -D FOREGROUND