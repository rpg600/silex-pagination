<?php

use msc\Service\FakeService;

use FranMoreno\Silex\Provider\PagerfantaServiceProvider;
use FranMoreno\Silex\Twig\PagerfantaExtension;

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new UrlGeneratorServiceProvider());

$app->register(new PagerfantaServiceProvider());

$app['pagerfanta.view.options'] = array(
    'next_message'  => ' next &raquo;',
    'previous_message'  => '&laquo; previous ',
);

$app->register(new TwigServiceProvider(), array(
    'twig.path'    => array(__DIR__.'/../src/views'),
    'twig.options' => array('cache' => __DIR__.'/../cache/twig'),
));

$app['twig'] = $app->share($app->extend('twig', function($twig) {
    return $twig;
}));

$app['twig']->addExtension(new PagerfantaExtension($app));

$app['service.fake'] = $app->share(function () {
    return new FakeService(1234);
});

require __DIR__.'/../src/controller.php';

$app->run();
