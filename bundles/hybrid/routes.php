<?php

/*
|--------------------------------------------------------------------------
| Installer
|--------------------------------------------------------------------------
|
| Run installation route when hybrid is not installed yet.
*/
Route::any('(:bundle)/installer/?(:any)?/?(:num)?', function ($action = 'index', $steps = 0)
{
    // we should disable this routing when the system detect it's already
    // running/installed.
    if (Hybrid\Installer::installed() and ( ! ($action === 'steps' && intval($steps) === 2)))
    {
        return Response::error('404');
    }

    // Otherwise, install it right away.
    return Controller::call("hybrid::installer@{$action}", array($steps));
});

/*
|--------------------------------------------------------------------------
| Default Routing
|--------------------------------------------------------------------------
*/
Route::any('(:bundle)', array('before' => 'hybrid::installed|hybrid::auth', function ()
{
    // Display the dashboard
    return Controller::call('hybrid::dashboard@index');
}));

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
|
| Detects all controller under hybrid bundle and register it to routing
*/
Route::controller(array(
    'hybrid::account',
    'hybrid::auth',
    'hybrid::dashboard',
    'hybrid::extensions',
    'hybrid::forgot',
    'hybrid::manages',
    'hybrid::pages',
    'hybrid::settings',
    'hybrid::users',
));

/*
|--------------------------------------------------------------------------
| Auth Routing
|--------------------------------------------------------------------------
*/
Route::any('(:bundle)/(login|register|logout)', function ($action)
{
    return Controller::call("hybrid::auth@{$action}");
});

/*
|--------------------------------------------------------------------------
| Route Filtering
|--------------------------------------------------------------------------
|
*/
Route::filter('hybrid::auth', function ()
{
    $redirect = Input::get('redirect');
    
    Session::flash('hybrid.redirect', $redirect);

    // Redirect the user to login page if user is not logged in.
    if (Auth::guest()) return Redirect::to(handles('hybrid::login'));
});

Route::filter('hybrid::not-auth', function ()
{
    $redirect = Input::get('redirect');
    
    Session::flash('hybrid.redirect', $redirect);

    // Redirect the user to login page if user is not logged in.
    if ( ! Auth::guest()) return Redirect::to(handles('hybrid'));
});


Route::filter('hybrid::installed', function ()
{
    // we should run installer when the system detect it's already
    // running/installed.
    if ( ! Hybrid\Installer::installed())
    {
        return Redirect::to_action("hybrid::installer@index");
    }
});

Route::filter('hybrid::csrf', function()
{
    if (Request::forged()) return Response::error('500');
});