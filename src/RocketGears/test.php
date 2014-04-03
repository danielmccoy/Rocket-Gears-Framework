<?php

	header('Content-type: text/plain');

	include_once('Base.php');
	include_once('RoutePattern.php');
	include_once('Route.php');
	include_once('Request.php');
	include_once('Application.php');

	$app = RocketGears\Application::getInstance();

	$app->get('/test/{id}/{test}/{more}', function($p1, $p2, $p3){
		echo "{$p1}, {$p2}, {$p3}";
	})->where('id', '[0-9]+');

	$r = new RocketGears\Request('GET', '/test/1/test/more+stuff');

	$app->run($r);
