#!/usr/bin/sh
mariadb-dump symfony -uroot -psuperAdmin -h 127.0.0.1 -p3600 > db/Backup-`(date -I)`.sql
echo "Sauvegarde terminée"