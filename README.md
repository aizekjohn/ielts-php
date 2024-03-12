# Installation

- `composer install`
- install redis as this project uses redis for caching and queues
- modify .env file 
  - configure DB settings
  - configure LOG settings
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan storage:link`

Default admin credentials can be found in `database/seeders/CreateAdminSeeder.php`
