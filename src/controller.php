<?php

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;
use Symfony\Component\HttpFoundation\Request;

$app->get('/', function (Request $request) use ($app) {

    $results = $app['service.fake']->getResults();

    $adapter = new ArrayAdapter($results);
    $pagerfanta = new Pagerfanta($adapter);
    $pagerfanta->setMaxPerPage(10);
    $pagerfanta->setCurrentPage($request->query->get('page', 1));

    return $app['twig']->render('index.html.twig', array(
        'pager' => $pagerfanta
    ));
})->bind('homepage');
