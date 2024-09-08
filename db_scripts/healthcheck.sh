#!/bin/bash
mysqladmin ping -h localhost --user=root --password="$MYSQL_ROOT_PASSWORD" --silent