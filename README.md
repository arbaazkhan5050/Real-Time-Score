# Cricket Test


### Description
The project uses Lumen for the API using `dingo/api` for creating a RESTful API. The UI is created with Vue-CLI. The API has CORS set up to accept request from any Origins. `dingo/api` allows us to throttle requests and auth-gate them. `laravel/passport` was not used to keep things lightweight.

### Status
Incomplete. Could not finish in time.

### Directory Structure
```
...
......api // the lumen project
...... vue // a badly named vue cli project
```

### API
`cd` inside the `api` directory and run `composer update`
Once all the dependencies are installed, open the file `.env` to set up your environmental variables. Because of the amount of configuration that is added to this file, the file has been removed from `.gitignore`.

##### Database Preparation
Run the following commands to migrate and seed Database tables:

`php artisan migrate`

`php artisan db:seed`

Some seeders truncate their table before seeding. Others continue adding data to their table.

##### Running the API server

Run the server with php's built-in server:
`php -S localhost:8100 -t public`
This will run the api server at http://localhost:8100

##### Using Transformers
the API uses various Transformers to format the JSON data that is sent back to the front end. Check the `app/Transformers` directory for such transformers. We are not using `Illuminate\Http\Response` for the API. All the response will be formatted by `dingo\api` -'s response helpers.

##### JWT 
The API is fully capable of generating JWT for any registered users. The route has been disabled as it was not needed.

##### Documentation
An automatically generated documentation can be found inside `api/public/docs`. To regenerate the API, use `php artisan apidoc:generate`.

### UI
The UI can be found in the badly named `vue` directory. It is a typescript based vue-cli project that uses vuex to store global states and uses SCSS for styling. 

Run the following codes in order to run the live server and make changes:

`cd vue`

`yarn install` or `npm install`

`yarn serve` or `npm run serve`

This will run the development server at http://localhost:8080

##### Environmental Variabls
Modify the file `.env.local` and set your proper environmental variable. For example, if you are running the api server in a different port, set it to that.

For the production build, copy `.env.local` to `.env.production` and set all the production environment variables there. Like the production API server.