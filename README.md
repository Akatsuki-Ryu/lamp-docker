# Docker Compose Stack for LEMP (Linux, Nginx, MySQL, PHP) with Replication and Backup

This project sets up a LEMP stack using Docker Compose, with the following components:

1. Nginx: Acts as a reverse proxy
2. PHP: PHP 8.2 with Apache
3. MySQL: Primary and Replica databases
4. phpMyAdmin: For database management
5. Automated database backup

## Key Features

- Nginx reverse proxy with custom configuration
- PHP 8.2 with Apache and additional extensions (GD, ZIP, MySQLi, PDO)
- MySQL 8.0 with primary-replica replication setup
- phpMyAdmin for easy database management
- Automated database backups
- Custom PHP configuration
- Health checks for the database

## Services

- `nginx`: Reverse proxy (ports 81:80 and 8080:8080)
- `web`: PHP 8.2 with Apache
- `db`: MySQL 8.0 primary instance
- `db_replica`: MySQL 8.0 replica instance
- `phpmyadmin`: phpMyAdmin for database management
- `db_backup`: Automated MySQL backups

## Usage

1. Clone this repository
2. Customize the environment variables and configurations as needed
3. Run `docker-compose up -d` to start the stack

For more detailed instructions and customization options, please refer to the individual service configurations in the `docker-compose.yml` file.