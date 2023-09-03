# RL_Web
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


# Docker containers manual steps
## Database
    docker run --name <DB_CONTAINER_NAME> -e MYSQL_ROOT_PASSWORD=<ROOT_PASSWORD> -d mysql:latest

For example:

    docker run --name RL_Database -e MYSQL_ROOT_PASSWORD=my-secret-pw -d mysql:latest


## Web
Create the web server image and the container using the files located under the Docker directory.

### Create IMAGE
    docker build -t <IMAGE_NAME> <PATH>

For example:

    docker build -t symfony4_php74 .

### Create the container
    docker run -d --name <WEB_CONTAINER_NAME> -p 80:80 <IMAGE_NAME>

For example:

    docker run -d --name RL_Web -p 80:80 symfony4_php74


### Access the container
    docker exec -ti <DB/WEB_CONTAINER_NAME> /bin/bash

For example:

    docker exec -ti RL_Web /bin/bash
    docker exec -ti RL_Database /bin/bash

### Add both containers to the same network

    docker network create <NETWORK_NAME>
    docker network connect <NETWORK_NAME> <WEB_CONTAINER_NAME>
    docker network connect <NETWORK_NAME> <DB_CONTAINER_NAME>

For example:
    
    docker network create backend
    docker network connect backend RL_Web
    docker network connect backend RL_Database

