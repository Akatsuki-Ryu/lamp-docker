#!/bin/bash
set -e

# Wait for the MySQL server to be ready
until mysqladmin ping -h localhost -u root --password=$MYSQL_ROOT_PASSWORD --silent; do
    echo 'Waiting for MySQL to be ready...'
    sleep 1
done

# Wait for the Master MySQL server to be ready
until mysqladmin ping -h db -u root --password=$MYSQL_ROOT_PASSWORD --silent; do
    echo 'Waiting for MySQL Master to be up...'
    sleep 1
done

mysql -h db -u root -p$MYSQL_ROOT_PASSWORD -e "SHOW MASTER STATUS\G" > /tmp/master_status
MASTER_LOG_FILE=$(grep File /tmp/master_status | awk '{print $2}')
MASTER_LOG_POS=$(grep Position /tmp/master_status | awk '{print $2}')

mysql -u root -p$MYSQL_ROOT_PASSWORD << EOF
CHANGE MASTER TO
MASTER_HOST='db',
MASTER_USER='repl_user',
MASTER_PASSWORD='repl_password',
MASTER_LOG_FILE='$MASTER_LOG_FILE',
MASTER_LOG_POS=$MASTER_LOG_POS;
START SLAVE;
EOF

# Keep the container running
tail -f /dev/null