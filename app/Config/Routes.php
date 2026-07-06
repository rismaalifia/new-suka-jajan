<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public
$routes->get('/', 'Home::index');
$routes->get('kuliner', 'Kuliner::index');
$routes->get('search', 'Kuliner::search');

// Auth
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::attemptRegister');
$routes->get('logout', 'Auth::logout');

// Contributor (requires login) — must be before kuliner/(:segment)
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('kuliner/submit', 'Kuliner::submit');
    $routes->post('kuliner/store', 'Kuliner::store');
    $routes->post('review/store', 'Review::store');
    $routes->post('review/update/(:num)', 'Review::update/$1');
    $routes->post('favorite/toggle/(:num)', 'Favorite::toggle/$1');
    $routes->get('favorites', 'Favorite::index');
    $routes->post('kuliner/report-closed/(:num)', 'Kuliner::reportClosed/$1');
    $routes->post('kuliner/upload-photo/(:num)', 'Kuliner::uploadPhoto/$1');
});

// Detail kuliner (slug) — after specific routes to avoid matching "submit" etc.
$routes->get('kuliner/(:segment)', 'Kuliner::detail/$1');

// Geocoding API (internal)
$routes->get('geocode', 'Geocode::search');

// Admin
$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');

    $routes->get('categories', 'Admin\Category::index');
    $routes->get('categories/create', 'Admin\Category::create');
    $routes->post('categories/store', 'Admin\Category::store');
    $routes->get('categories/edit/(:num)', 'Admin\Category::edit/$1');
    $routes->post('categories/update/(:num)', 'Admin\Category::update/$1');
    $routes->post('categories/delete/(:num)', 'Admin\Category::delete/$1');

    $routes->get('tags', 'Admin\Tag::index');
    $routes->get('tags/create', 'Admin\Tag::create');
    $routes->post('tags/store', 'Admin\Tag::store');
    $routes->get('tags/edit/(:num)', 'Admin\Tag::edit/$1');
    $routes->post('tags/update/(:num)', 'Admin\Tag::update/$1');
    $routes->post('tags/delete/(:num)', 'Admin\Tag::delete/$1');

    $routes->get('kuliners', 'Admin\Kuliner::index');
    $routes->get('kuliners/create', 'Admin\Kuliner::create');
    $routes->post('kuliners/store', 'Admin\Kuliner::store');
    $routes->get('kuliners/edit/(:num)', 'Admin\Kuliner::edit/$1');
    $routes->post('kuliners/update/(:num)', 'Admin\Kuliner::update/$1');
    $routes->post('kuliners/delete/(:num)', 'Admin\Kuliner::delete/$1');
    $routes->post('kuliners/approve/(:num)', 'Admin\Kuliner::approve/$1');
    $routes->post('kuliners/reject/(:num)', 'Admin\Kuliner::reject/$1');

    $routes->get('reviews', 'Admin\Review::index');
    $routes->post('reviews/delete/(:num)', 'Admin\Review::delete/$1');
});

// Public API
$routes->group('api', static function ($routes) {
    $routes->get('kuliner', 'Api\Kuliner::index');
});
