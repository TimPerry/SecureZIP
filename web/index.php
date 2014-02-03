<?php

	define('APP_DIR', realpath(__DIR__ . "/../app/"));

	require_once __DIR__ . '/../vendor/autoload.php';
	$app = new Silex\Application();

	/**
	 * Connects our views to twig
	 */
	$app->register(new Silex\Provider\TwigServiceProvider(), array(
		'twig.path' => APP_DIR . '/views',
	));

	/**
	 * Our index view, uses twig to display our index view
	 * */
	$app->get("/", function () use ($app) {

		return $app['twig']->render('index.html.twig');

	});
