# To-Do list app using laravel and mysql
The main goal of this project is to remember and/or exercise my knowlegde about the Laravel framework, good software engineering practices, documentation and software testing.

## Requirements
- [ ] User can create a new to-do with name, description, due date and status
- [ ] User can view a to-do list
- [ ] User can mark a to-do as done
- [ ] User can delete a previously created to-do

## Technologies
The tech stack of this project is:
- PHP with the Laravel framework
- MySQL
- Tailwindcss with Blade templates
- Docker

## How to run
### Prerequisites
Before you start, we will need some softwares installed in your local environment. This project uses sail to setup the server using docker. Therefore, you will need to have [docker desktop](https://www.docker.com/products/docker-desktop/) and after that is highly recommended that you follow the [sail usage guide](https://laravel.com/docs/10.x/sail) available in the Laravel documentation. In this guide i will consider that you configured a shell alias so that way we can simply use `sail <command>` instead of `./vendor/bin/sail <command>`.

Furthermore, to clone the project we will use git, which must also be installed on your machine.

### Getting started
First of all, you will need to clone the project from github. You can do that by running the command below in your terminal:
```
git clone https://github.com/lu1zf/laravel-todo-list
```

After that, we navigate to the project's root folder by typing
```
cd laravel-todo-list
```

Now, we need to install the dependencies of the project, using the sail composer command:
```
sail composer install
```

Before starting the application, you need to follow a few more steps. First, copy the `.env.example` file, rename it to `.env`.

Next, to generate the application key, run:
```
sail artisan key:generate
```

Finally, we need to populate the database with the tables and data needed for the code to run properly:
```
sail artisan migrate
```

Following the entire step by step, you will be able to serve the application locally running this on your terminal
```
sail up -d
```

After this, the app will be available at `http://localhost/`. To stop the app, use the following command
```
sail down
```
