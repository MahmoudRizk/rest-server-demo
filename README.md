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

### docker compose up
```
sudo docker-compose -f docker/docker-compose.yml --env-file .env up
```

### Run database migrations 
```
sudo docker exec -it server php artisan migrate
```

## Windows

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

# Assignment

As we discussed later in the REST API session, this is a simple app for an educational system. There are three main entities <b>Students</b>, <b>Courses</b> & <b>Grades</b>, You can find the database schema under ```database/migrations``` directory. For each entity there will be a migration file defining its table schema.

You are required to implement APIs for each of those entities enabling <b>CRUD</b> operations. For each API You will find a <b>TODO</b> in ```routes/api.php``` file where you can implement the required API.

Each API is having a unit test that will be failing by default since there are no endpoints implemented yet. After you successfully implement the endpoints all the unit tests shall pass successfully. 

You will need first to read about routes & executing SQL queries in Laravel docs before starting the assignment.

Routing: https://laravel.com/docs/9.x/routing#basic-routing
Running queries: https://laravel.com/docs/9.x/database#running-queries
Returning responses: https://laravel.com/docs/9.x/responses#json-responses

## Running the tests

### Linux

```
sudo docker exec -it server php artisan test
```

### Windows

Open a new terminal inside the <b>server</b> container.

Then execute this command inside the container's terminal

```
php artisan test
```


## Browsing database

To browse the database & observe changes made, you can install any SQL client like DBeaver or any alternative and connect to the database.

We are using <b>mysql</b> for this assignment & credentials for the database can be found in .env file prefixed with <b>DB_*</b>. You will need DB_USERNAME & DB_PASSWORD values. Don't forget to change the <b>port to 33006</b>.

