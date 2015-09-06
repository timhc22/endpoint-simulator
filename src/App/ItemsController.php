<?php
namespace App;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ItemsController
 * @package App
 */
class ItemsController implements ControllerProviderInterface
{
	protected $items = [
		'1' => [
		'name' => 'item1',
		],
		'2' => [
		'name' => 'item2',
		],
	];

	/**
	 * Returns routes to connect to the given application.
	 * List all routes here
	 * Silex uses connect function to mount controller to application
	 *
	 * @param Application $app An Application instance
	 * @return ControllerCollection A ControllerCollection instance
	 */
	public function connect(Application $app)
	{
		/** $var ControllerCollection $factory */
		$factory = $app['controllers_factory'];

		$factory->get(
			'/',
			'App\ItemsController::getAll'
		);

		$factory->get(
			'/{id}',
			'App\ItemsController::getCode'
		);

		$factory->post(
			'/',
			'App\ItemsController::postCode'
		);

		$app->delete(
			'/{id}',
			'App\ItemsController::deleteCode'
		);

		return $factory;
	}

	/**
	 * Get all items
	 *
	 * @param Application $app
	 * @return string
	 */
	public function getAll(Application $app)
	{
		return json_encode($this->items);
	}

	/**
	 * Get an item
	 *
	 * @param Application $app
	 * @param $code
	 *
	 * @return string
	 */
	public function getItem(Application $app, $id)
	{
		if (!isset($this->items[$id])) {
			$app->abort(404, "{$id} was not found.");
		}
		return json_encode($this->items[$id]);
	}

	/**
	 * Post an item
	 *
	 * @param Application $app
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function postItem(Application $app, Request $request)
	{
		$name = $request->get('name');
		// todo do post
		$item = [
			'3' => [
				'name' => $name,
			],
		];
		return new Response(json_encode($item), Response::HTTP_CREATED);
	}

	/**
	 * Delete item
	 *
	 * @param Application $app
	 * @param $id
	 *
	 * @return Response
	 */
	public function deleteItem(Application $app, $id)
	{
		return new Response("Deleted {$id}", Response::HTTP_NO_CONTENT);
	}
}
