#!/bin/bash
docker exec lamp_db_1 sh -c 'exec mysqldump --all-databases -uroot -p"$MYSQL_ROOT_PASSWORD"' > ./backup.sql