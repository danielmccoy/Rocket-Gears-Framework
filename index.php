<?php

	include_once('vendor/autoload.php');

	$app = new RocketGears\Application();

	$app->get('/', function(){
		echo "Welcome.";
	});

	$app->get('/test/{id}/{test}/{more}', function($p1, $p2, $p3){
		echo "{$p1}, {$p2}, {$p3}";
	})->where('id', '[0-9]+');

	$app->run();
