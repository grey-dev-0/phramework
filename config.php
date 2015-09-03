<?php namespace GD;

// Main configuration constants
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '311289');
define('DB_NAME', 'greydev');
define('VIEWS_DIR', __DIR__.'/app/View');

// View rendering function
function view($view){ require_once VIEWS_DIR."/$view.php"; }