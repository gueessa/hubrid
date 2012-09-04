<?php

/*
|--------------------------------------------------------------------------
| Hybrid Auto-Loader Mappings
|--------------------------------------------------------------------------
|
| Registering a mapping couldn't be easier. Just pass an array of class
| to path maps into the "map" function of Autoloader. Then, when you
| want to use that class, just use it. It's simple!
|
*/

Autoloader::map(array(
    'Hybrid'          => Bundle::path('hybrid').'hybrid'.EXT,
	'Base_Controller' => Bundle::path('hybrid').'controllers'.DS.'core'.DS.'base.php',
));

/*
|--------------------------------------------------------------------------
| Hybrid Library
|--------------------------------------------------------------------------
|
| Map hybrid Library using PSR-0 standard namespace.
*/

Autoloader::namespaces(array(
    'Hybrid\Model'  => Bundle::path('hybrid').'models'.DS,
    'Hybrid'        => Bundle::path('hybrid').'libraries'.DS,
));

/*
|--------------------------------------------------------------------------
| hybrid Events Listener
|--------------------------------------------------------------------------
|
| Lets listen to when hybrid bundle is started.
*/

Event::listen('laravel.started: hybrid', function ()
{
    Hybrid\Core::start();
});

Event::listen('laravel.done', function ()
{
    Hybrid\Core::done();
});

/*
|--------------------------------------------------------------------------
| hybrid IoC (Migration)
|--------------------------------------------------------------------------
|
| Lets hybrid run Laravel\CLI migration actions
*/

if( ! IoC::registered('task: hybrid.migrator'))
{
    IoC::register('task: hybrid.migrator', function($method, $bundle = null)
    {
        // Initiate the dependencies to Laravel\CLI migrate.
        $database = new Laravel\CLI\Tasks\Migrate\Database;
        $resolver = new Laravel\CLI\Tasks\Migrate\Resolver($database);
        $migrate  = new Laravel\CLI\Tasks\Migrate\Migrator($resolver, $database);

        if (method_exists($migrate, $method))
        {
            try
            {
                // We need to resolve to output buffering Task Migrator will echo some
                // output to terminal.
                ob_start();

                $migrate->{$method}($bundle);

                ob_end_clean();
            }
            catch (Exception $e) {}
        }
        else
        {
            throw new Exception('Unable to find migration action');
        }
    });
}

/*
|--------------------------------------------------------------------------
| hybrid IoC (Publisher)
|--------------------------------------------------------------------------
|
| Lets hybrid run Laravel\CLI bundle asset publish actions. This is an
| alias to `php artisan bundle:publish`
*/

if( ! IoC::registered('task: hybrid.publisher'))
{
    IoC::register('task: hybrid.publisher', function($bundle = null)
    {
        // Initiate the dependencies to Laravel\CLI bundle publisher.
        $publisher = new Laravel\CLI\Tasks\Bundle\Publisher;

        try
        {
            // We need to resolve to output buffering Task Migrator will echo some
            // output to terminal.
            ob_start();

            $publisher->publish($bundle);

            ob_end_clean();
        }
        catch (Exception $e) {}
    });	
}

/*
|--------------------------------------------------------------------------
| hybrid IoC (Mailer)
|--------------------------------------------------------------------------
|
| Lets hybrid handle mailer (integration with Message bundle) using IoC
*/

if( ! IoC::registered('hybrid.mailer'))
{
    IoC::register('hybrid.mailer', function($from = true)
    {
        /*
        // Ensure Messages bundle is registered
        if ( ! Bundle::exists('messages')) Bundle::register('messages');

        // Ensure it's started as well
        if ( ! Bundle::started('messages')) Bundle::start('messages');

        $memory = hybrid\Core::memory();

        $config = $memory->get('email');
        $driver = $config['default'];
        $transports = $config['transports'];
        $email = $config['from'];

        Config::set('messages::config.transports', $transports);

        $mailer = Message::instance($driver);

        if ($from === true)
        {
            $mailer->from($email, $memory->get('site.name', 'hybrid'));
        }

        return $mailer;
        */
    });
}

/*
|--------------------------------------------------------------------------
| Hybrid Helpers
|--------------------------------------------------------------------------
*/

include_once Bundle::path('hybrid').'helpers.php';