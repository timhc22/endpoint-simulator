<?php
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true; // todo set to false in production

$items = [
	'1' => [
		'name' => 'item1',
	],
	'2' => [
		'name' => 'item2',
	],
];

/**
 * GET
 */
$app->get('/', function() use ($items) {
	return json_encode($items);
});

/**
 * GET
 */
$app->get('/{code}', function (Application $app, $code) use ($items) {
	if (!isset($items[$code])) {
		$app->abort(404, "{$code} was not found.");
	}
	return json_encode($items[$code]);
});

/**
 * POST
 */
$app->post('/', function (Application $app, Request $request) {
	$name = $request->get('name');

	// todo do post
	$item = [
		'3' => [
			'name' => 'item3',
		],
	];

	return new Response(json_encode($item), Response::HTTP_CREATED);
});

$app->delete('/{id}', function (Application $app, Request $request, $id) {
	// todo do delete
	return new Response("Deleted {$id}", Response::HTTP_NO_CONTENT);
});



$app->run();