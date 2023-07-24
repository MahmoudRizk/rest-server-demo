# Prerequisites

Install docker & docker compose: https://docs.docker.com/get-docker/

# Run the app


## docker compose up
```
sudo docker-compose -f docker/docker-compose.yml up
```

## Run database migrations 
```
sudo docker exec -it server php artisan migrate
```





