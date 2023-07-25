# Prerequisites

Install git: https://git-scm.com/downloads

Install docker & docker compose: https://docs.docker.com/get-docker/

# Clone the app

```
git clone https://github.com/MahmoudRizk/rest-server-demo.git
```

# Run the app

## Linux

### Open terminal inside the repo directory

```cd /<path>/rest-server-demo```

### Copy .env.example to .env file

```
cat .env.example > .env
```

### docker compose up
```
sudo docker-compose -f docker/docker-compose.yml --env-file .env up
```

### Run database migrations 
```
sudo docker exec -it server php artisan migrate
```

## Windows

### Copy .env.example to .env file

* Create new .env file.
* Copy & Paste the content of .env.example to .env file.

### Enable resources file sharing from docker desktop

from ```settings -> resources -> file sharing```, add the path to the repo dir.

### Open terminal inside the repo directory

#### docker compose up

```
docker compose -f docker/docker-compose.yml --env-file .env up
```

#### Run database migrations

from docker desktop, open new terminal inside server container
```containers -> server -> Actions -> Open in terminal```

then run the migration command

```
php artisan migrate
```

# Check the app is working

Open the browser:
* Go to this url ```127.0.0.1:8080```, Laravel page shall be shown.
* Go to url ```127.0.0.1:8080/api/students```, json list of students shall be shown.
