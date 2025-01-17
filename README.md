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
- Run command and wait for a while for Docker to build the container. NOTE: This step can take a few minutes.
```bash
docker compose up -d
```
- Once all services are up, run the following command to generate APP_KEY
```bash
docker compose exec smindler_app php artisan key:generate
```
- Run the following command to migrate database and get some random data for testing purpose.
```bash
docker compose exec smindler_app php artisan migrate --seed
```
- You should see some message similar to this in the terminal.
```
   INFO  Preparing database.

  Creating migration table ....................... 68.42ms DONE

   INFO  Running migrations.

  0001_01_01_000000_create_users_table ........... 78.18ms DONE
  0001_01_01_000001_create_cache_table ........... 23.08ms DONE
  0001_01_01_000002_create_jobs_table ............ 58.89ms DONE

   INFO  Seeding database.

  Database\Seeders\OrderSeeder ........................ RUNNING
  Database\Seeders\OrderSeeder ...................... 0 ms DONE
```

#### How to use

- Access to the interface of the app and see requirements of the task at: http://localhost:8080/
- Access to database dashboard with phpmyadmin at: http://localhost:8888/

#### Testing
##### Automated test

- Run command below for automated testing
```bash
docker compose exec smindler_app php artisan test
```

##### Manually test

You can make multiple HTTP requests using terminal or a third-party platform (example: [Postman](https://www.postman.com/))

```
GET  |  http://localhost:8080/api/orders  |  Get all order records

RESPONSE SCHEMA
{
    "success": boolean,
    "message": string,
    "data": [
        {
            "id": integer,
            "first_name": string,
            "last_name": string,
            "address": string,
            "created_at": datetime,
            "updated_at": datetime,
            "basket": [
                {
                    "id": integer,
                    "name": string,
                    "type": string,
                    "price": float,
                    "order_id": integer,
                    "created_at": datetime,
                    "updated_at": datetime
                }
            ]
        }
    ]
}
```
---
```
GET  |  http://localhost:8080/api/orders/{id}  |  Get a single order by id

RESPONSE SCHEMA
{
    "success": boolean,
    "message": string,
    "data": {
        "id": integer,
        "first_name": string,
        "last_name": string,
        "address": string,
        "created_at": datetime,
        "updated_at": datetime,
        "basket": [
            {
                "id": integer,
                "name": string,
                "type": string,
                "price": float,
                "order_id": integer,
                "created_at": datetime,
                "updated_at": datetime
            }
        ]
    }
}
```
---
```
POST  |  http://localhost:8080/api/orders  |  Create a new order

REQUEST SCHEMA
{
    "first_name": string,
    "last_name": string,
    "address": string,
    "basket": [
        {
            "name": string,
            "type": string,
            "price": float,
        }
    ]
}

RESPONSE SCHEMA
{
    "success": boolean,
    "message": string,
    "data": [
        {
            "id": integer,
            "first_name": string,
            "last_name": string,
            "address": string,
            "created_at": datetime,
            "updated_at": datetime,
            "basket": [
                {
                    "id": integer,
                    "name": string,
                    "type": string,
                    "price": float,
                    "order_id": integer,
                    "created_at": datetime,
                    "updated_at": datetime
                }
            ]
        }
    ]
}
```
---
```
DELETE  |  http://localhost:8080/api/orders/{id}  |  Delete an order by id
```
---


##### HTTP Response Status Codes
| Code  | Title                     | Description                              |
| ----- | ------------------------- | ---------------------------------------- |
| `200` | `OK`                      | When a request was successfully processed (e.g. when using `GET`, `PATCH`, `PUT` or `DELETE`). |
| `201` | `Created`                 | Every time a record has been added to the database (e.g. when creating a new user or post). |
| `400` | `Bad request`             | When the request could not be understood (e.g. fail to validate data). |
| `404` | `Not found`               | When URL is not found. |
| `500` | `Internal server error`   | When an internal error has happened (e.g. when trying to add records in the database fails). |
