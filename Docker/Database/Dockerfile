FROM mysql:latest
MAINTAINER Rodrigo Lozano

ADD schema.sql /docker-entrypoint-initdb.d/1.sql
ADD data.sql /docker-entrypoint-initdb.d/2.sql

EXPOSE 3306