<?php

	use Symfony\Component\Filesystem\Filesystem;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\Process\Process;
	use SZIP\UploadsManager\UploadsManager;
	use SZIP\Zipper\Secure7zZipper;

	define('APP_DIR', realpath(__DIR__ . "/../app/"));

	require_once __DIR__ . '/../vendor/autoload.php';
	$app = new Silex\Application();

	$app->register(new Silex\Provider\TwigServiceProvider(), array(
		'twig.path' => APP_DIR . '/views',
	));

	$app->get("/", function () use ($app) {

		return $app['twig']->render('index.html.twig');

	});

	$app->post("/", function (Request $request) use ($app) {

		$files = $request->files->get("upload_files");

		$password = uniqid();

		$folder_loc = "/files/" . uniqid();
		$full_folder_loc = __DIR__ . $folder_loc;

		$zip_loc = $folder_loc . "/" . uniqid() . ".zip";
		$full_zip_loc = __DIR__ . $zip_loc;

		$fs = new Filesystem();

		try {

			$uploadManager = new UploadsManager( $files, $fs, $full_folder_loc );
			$uploadManager->processUploads();

			$zipper = new Secure7zZipper( $full_folder_loc, $full_zip_loc, $password );
			$zipper->zip();

			return $app['twig']->render('upload.html.twig', array(

				"password" => $password,
				"zip_loc" => $zip_loc

			));

		} catch( Exception $e ) {

			return $app['twig']->render('upload_failed.html.twig', array(

				"message" => "Unfortunately, something went wrong. Sorry, please try again." . $e->getMessage()

			));

		}

	});

	$app->run();