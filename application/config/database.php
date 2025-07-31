<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	// Offline development
	'username' => 'root',
	'password' => '',

	 // online development (productions)
	//  'username' => 'kina3126_mp_kanpa',
	//  'password' => 'kanpa2020',

	'database' => 'kina3126_mp_kanpa.co.id',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$capsule = new Capsule;
$capsule->addConnection([
	'driver'    => 'mysql',
	'host'      => $db['default']['hostname'],
	'database'  => $db['default']['database'],
	'username'  => $db['default']['username'],
	'password'  => $db['default']['password'],
	'charset'   => $db['default']['char_set'],
	'collation' => $db['default']['dbcollat'],
	'prefix'    => $db['default']['dbprefix'],
]);

$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();