#!/bin/bash

# Set the backup directory
BACKUP_DIR="/backups"

# Set the database credentials
DB_USER="root"
DB_PASS="root_password"

# Function to create backups of all databases
create_backups() {
    current_date=$(date +"%Y%m%d_%H%M%S")
    backup_file="$BACKUP_DIR/all_databases_backup_$current_date.sql"

    echo "Creating backup of all databases..."
    mysqldump -h db -u"$DB_USER" -p"$DB_PASS" --ssl-mode=DISABLED --all-databases > "$backup_file"

    if [ $? -eq 0 ]; then
        echo "Backup of all databases created successfully: $backup_file"
        # Compress the backup
        gzip -f "$backup_file"
        echo "Backup compressed: $backup_file.gz"
    else
        echo "Error: Backup of all databases failed"
        return 1
    fi
}

# Function to remove old backups (keep last 7 days)
cleanup_old_backups() {
    echo "Cleaning up old backups..."
    find "$BACKUP_DIR" -name "all_databases_backup_*.sql.gz" -type f -mtime +7 -delete
    echo "Cleanup completed"
}

# Main loop
while true; do
    # Create backups of all databases
    create_backups

    # Clean up old backups
    cleanup_old_backups

    # Wait for 24 hours before the next backup
    echo "Waiting 24 hours before next backup..."
    sleep 86400
done