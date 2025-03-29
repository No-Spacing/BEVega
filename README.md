# BEVega
 CRUD
## Installation
 1. open command prompt inside the app project folder and type command `composer update`.
 2. rename the `.env.example` file to `.env`.
 3. inside the command prompt type `php artisan key:generate`.
 4. Website uses MYSQL. Please make sure MYSQL is installed to your device before running this commands 
    * type `php artisan migrate` and this will popup in the command prompt
    <br> `The database 'database_name' does not exist on the 'mysql' connection.`
    <br> `Would you like to create it? (yes/no) [yes]`
    <br> type yes to create the database make sure it does not have same database name or it will reset the previous database that saved to your device.
 5. after migrating next type `php artisan db:seed`
 6. then type `npm install && npm run build`.
 7. finally type `composer run dev` to run the program.
## Login Credentials
 * Username: admin@email.com
 * password: Admin123

