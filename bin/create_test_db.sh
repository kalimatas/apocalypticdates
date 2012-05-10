#!/bin/bash

DBUSER=root
DBPASSWORD=qazwsxedc
DBSNAME=apocalypticdates # source DB
DBNAME=apocalypticdates_test # destination DB
DBSERVER=127.0.0.1

echo "Copying DB structure..."

DBCONN="-h ${DBSERVER} -u ${DBUSER} --password=${DBPASSWORD}"
echo "DROP DATABASE IF EXISTS ${DBNAME}" | mysql ${DBCONN}
echo "CREATE DATABASE ${DBNAME}" | mysql ${DBCONN}

mysqldump -d ${DBCONN} ${DBSNAME} | sed 's/ AUTO_INCREMENT=[0-9]*\b//' | mysql ${DBCONN} ${DBNAME}

echo "Ok"