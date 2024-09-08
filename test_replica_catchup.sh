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

# Create test database and table
important_echo "Creating test database and table on master"
execute_mysql_command db "CREATE DATABASE IF NOT EXISTS catchup_test; USE catchup_test; CREATE TABLE IF NOT EXISTS test_table (id INT AUTO_INCREMENT PRIMARY KEY, data VARCHAR(100));"

# Insert initial data
execute_mysql_command db "USE catchup_test; INSERT INTO test_table (data) VALUES ('Initial data');"

# Verify replication is working
important_echo "Verifying initial replication"
sleep 5
REPLICA_DATA=$(execute_mysql_command db_replica "USE catchup_test; SELECT * FROM test_table;")
echo "$REPLICA_DATA"

# Stop the replica
important_echo "Stopping the replica"
docker compose stop db_replica

# Insert more data on the master
important_echo "Inserting more data on the master"
execute_mysql_command db "USE catchup_test; INSERT INTO test_table (data) VALUES ('Data while replica was down');"

# Start the replica
important_echo "Starting the replica"
docker compose start db_replica

# Wait for the replica to catch up
important_echo "Waiting for the replica to catch up..."
sleep 10

# Check if the replica caught up
important_echo "Checking if the replica caught up"
REPLICA_DATA=$(execute_mysql_command db_replica "USE catchup_test; SELECT * FROM test_table;")
echo "$REPLICA_DATA"

# Verify if all data is present
if echo "$REPLICA_DATA" | grep -q "Data while replica was down"; then
    important_echo "Replica successfully caught up with changes!"
else
    echo -e "${RED}Replica failed to catch up with changes.${NC}"
    exit 1
fi

# Clean up test data
important_echo "Cleaning up test data"
execute_mysql_command db "DROP DATABASE IF EXISTS catchup_test;"
execute_mysql_command db_replica "DROP DATABASE IF EXISTS catchup_test;"

important_echo "Replica catch-up test completed successfully."