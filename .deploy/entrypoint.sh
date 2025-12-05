#!/bin/sh

echo "🎬 entrypoint.sh: [$(whoami)] [PHP $(php -r 'echo phpversion();')]"

echo "🎬 WordPress environment ready"

# WordPress için gerekli dizin izinlerini ayarla
if [ -d "/var/www/html/wp-content" ]; then
    chown -R app:app /var/www/html/wp-content
fi

echo "🎬 start supervisord"

supervisord -c /var/www/html/.deploy/config/supervisor.conf
