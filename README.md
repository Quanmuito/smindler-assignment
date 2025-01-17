## About me

Feel free to visit my website at https://www.quanmuito.com/ to know more about me.

## About the project

This is a job assignment from Smindler for hiring process.

## Set up project

#### Prerequisite

- Install Docker [here](https://www.docker.com/).
- Install Git [here](https://git-scm.com/)

#### Installation

- Clone this repository or unzip the content to a folder.
- Open a terminal at the folder.
- Copy `.env.example` and rename to `.env`.
- Fill environment variables for database:
```
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    DB_ROOT_PASSWORD=
```
For example:
```
    DB_PORT=3306
    DB_DATABASE=db123
    DB_USERNAME=user123
    DB_PASSWORD=password123
    DB_ROOT_PASSWORD=rootpassword123
```
- Run command and wait for a while for Docker to build the container.
```bash
    docker compose up -d
```
- Once the container is up, run the following command to migrate database.
```bash
    docker compose exec smindler_app php artisan migrate
```
- You should see some message like this in the terminal.
```
   INFO  Preparing database.

  Creating migration table ....................... 68.42ms DONE

   INFO  Running migrations.

  0001_01_01_000000_create_users_table ........... 78.18ms DONE
  0001_01_01_000001_create_cache_table ........... 23.08ms DONE
  0001_01_01_000002_create_jobs_table ............ 58.89ms DONE
```

#### How to use

- Access to the interface of the app and see usage of the app at: http://localhost:8080/
- Access to database dashboard with phpmyadmin at: http://localhost:8888/
