#!/bin/bash

# Set the backup directory
BACKUP_DIR="/backups"

# Set the database credentials
DB_USER="root"
DB_PASS="root_password"
DB_NAME="lamp_db"

# Function to create a backup
create_backup() {
    current_date=$(date +"%Y%m%d_%H%M%S")
    backup_file="$BACKUP_DIR/daily_backup_$current_date.sql"

    echo "Creating daily backup..."
    mysqldump -h db -u"$DB_USER" -p"$DB_PASS" --ssl-mode=DISABLED "$DB_NAME" > "$backup_file"

    if [ $? -eq 0 ]; then
        echo "Daily backup created successfully: $backup_file"
        # Compress the backup
        gzip -f "$backup_file"
        echo "Backup compressed: $backup_file.gz"
    else
        echo "Error: Daily backup failed"
        return 1
    fi
}

# Function to remove old backups (keep last 7 days)
cleanup_old_backups() {
    echo "Cleaning up old backups..."
    find "$BACKUP_DIR" -name "daily_backup_*.sql.gz" -type f -mtime +7 -delete
    echo "Cleanup completed"
}

# Main loop
while true; do
    # Create a backup
    create_backup

    # Clean up old backups
    cleanup_old_backups

    # Wait for 24 hours before the next backup
    echo "Waiting 24 hours before next backup..."
    sleep 86400
done