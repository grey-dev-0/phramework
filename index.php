<?php require_once 'config.php'; require_once 'vendor/autoload.php';

use GD\Database\Query;

$query = new Query();
$cars = $query->select('id', 'name')->from('my_objects')->fetch()->toJson();
echo '<pre>';
echo $cars;
echo '</pre>';
// view('hello');