# ViajesParaTi
Technical Test Repo.

# Project
- Symfony 4.4
- PHP 7.4.33
- mysql 8.X

# Install
## The easy way 
Download the Docker directory.

Move to the directory and run:

    docker compose up

###     
    

# Docker
## Database
    docker run --name <CONTAINER_NAME> -e MYSQL_ROOT_PASSWORD=<ROOT_PASSWORD> -d mysql:latest

For example:

    docker run --name mysql_viajesParaTi -e MYSQL_ROOT_PASSWORD=my-secret-pw -d mysql:latest


## Project
Create the project image and the container using the files located under the Docker directory.
### Create IMAGE
    docker build -t <IMAGE_NAME> <PATH>

For example:

    docker build -t symfony4_php74 .

### create the container
    docker run -d --name <CONTAINER_NAME> -p 80:80 <IMAGE_NAME>

For example:

    docker run -d --name ViajesParaTi -p 80:80 symfony4_php74


### Access the container
    docker exec -ti <CONTAINER_NAME> /bin/bash

For example:

    docker exec -ti ViajesParaTi /bin/bash
