#!/bin/bash

# ANSI color codes
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to execute MySQL commands
execute_mysql_command() {
    docker compose exec -T $1 mysql -uroot -proot_password -e "$2"
}

# Function for important echo messages
important_echo() {
    echo -e "${YELLOW}===================================${NC}"
    echo -e "${GREEN}$1${NC}"
    echo -e "${YELLOW}===================================${NC}"
}

# Check master status
important_echo "Checking Master Status:"
execute_mysql_command db "SHOW MASTER STATUS\G"

# Check slave status
important_echo "Checking Slave Status:"
SLAVE_STATUS=$(execute_mysql_command db_replica "SHOW SLAVE STATUS\G")
echo "$SLAVE_STATUS"

# Check if replication is running
if echo "$SLAVE_STATUS" | grep -q "Slave_IO_Running: Yes" && echo "$SLAVE_STATUS" | grep -q "Slave_SQL_Running: Yes"; then
    important_echo "Replication is running correctly."
else
    echo -e "${RED}Replication is not running correctly. Please check the configuration.${NC}"
    exit 1
fi

# Test replication with a sample table
important_echo "Testing replication with a sample table:"
execute_mysql_command db "CREATE DATABASE IF NOT EXISTS test_db; USE test_db; CREATE TABLE IF NOT EXISTS test_replication (id INT AUTO_INCREMENT PRIMARY KEY, data VARCHAR(100)); INSERT INTO test_replication (data) VALUES ('Test data');"

echo -e "\n${YELLOW}Waiting for replication to occur...${NC}"
sleep 5

important_echo "Checking data on replica:"
REPLICA_DATA=$(execute_mysql_command db_replica "USE test_db; SELECT * FROM test_replication ORDER BY id DESC LIMIT 1;")
echo "$REPLICA_DATA"

if [ -n "$REPLICA_DATA" ]; then
    important_echo "Replication test successful. Data was replicated to the slave."
else
    echo -e "${RED}Replication test failed. No data found on the slave.${NC}"
    exit 1
fi

# Clean up test data
important_echo "Cleaning up test data..."
execute_mysql_command db "DROP DATABASE IF EXISTS test_db;"
execute_mysql_command db_replica "DROP DATABASE IF EXISTS test_db;"

important_echo "Replication check completed successfully and test data cleaned up."