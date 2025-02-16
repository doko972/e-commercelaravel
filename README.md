# Install project
 Clone this repo

 Open in the Browser : 
```
    https://packagist.org/packages/espero-soft/artisan

```

A Laravel package for generating entities, CRUD, services operations for laravel project.
Installation

Run the following command to install the package:
```
composer require espero-soft/artisan:dev-main
```
Update the commands method in the app/Console/kernel.php file:

/**
 * Register the commands for the application.
 */
protected function commands(): void
{
    $this->load(__DIR__.'/Commands');

    // Registering the MakeEntityCommand as a ClosureCommand
    $this->getArtisan()->add( new MakeEntityCommand() );
    // Registering the MakeCrudCommand as a ClosureCommand
    $this->getArtisan()->add( new MakeCrudCommand() );
    // Registering the MakeServiceCommand as a ClosureCommand
    $this->getArtisan()->add( new MakeServiceCommand() );

    require base_path('routes/console.php');
}

Usage
Generate an Entity

To generate a new entity, use the following command:
```
php artisan make:entity YourEntityName
```
Generate a CRUD

To create a complete CRUD for an existing entity, use the following command:
```
php artisan make:crud YourEntityName
```
Examples

Here are a few usage examples:
```
php artisan make:entity Post
php artisan make:crud Post
```