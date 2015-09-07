<?php
use Silex\Application;
use App\ItemsController;

require_once __DIR__.'/../vendor/autoload.php';

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
	return false;
}

$app = new Application();
$app['debug'] = true; // todo set to false in production

$app->register(new Silex\Provider\MonologServiceProvider(), array(
	'monolog.logfile' => __DIR__.'/../logs/development.log',
));

$items = [];

$app->mount('/', new ItemsController()); // todo fix so can have /items

$app->run();