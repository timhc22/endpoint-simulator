<?php
use Silex\Application;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true; // todo set to false in production

$items = [
	'1'=> [
		'name' => 'item1',
	],
	'2' => [
		'name' => 'item2',
	],
];

$app->get('/', function() use ($toys) {
	return json_encode($toys);
});

$app->get('/{code}', function (Application $app, $code) use ($items) {
	if (!isset($items[$code])) {
		$app->abort(404, "{$code} was not found.");
	}
	return json_encode($items[$code]);
});

$app->run();