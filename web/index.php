<?php

	define('APP_DIR', realpath(__DIR__ . "/../app/"));

	require_once __DIR__ . '/../vendor/autoload.php';
	$app = new Silex\Application();

	$app->register(new Silex\Provider\TwigServiceProvider(), array(
		'twig.path' => APP_DIR . '/views',
	));


	$app->get("/", function() use ($app) {

		return $app['twig']->render('index.html.twig');

	});

	$app->get("/upload", function () use ($app) {

		return $app['twig']->render('upload.html.twig');

	});

	$app->run();