#!/bin/bash
cat ./backup.sql | docker exec -i lamp_db_1 sh -c 'exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD"'
