<?php

$loader = new Phalcon\Loader();

$loader->registerDirs(
    [
        APP_PATH . $config->application->controllersDir,
        APP_PATH . $config->application->servicesDir,
        APP_PATH . $config->application->modelsDir,
        APP_PATH . $config->application->pluginsDir,
        APP_PATH . $config->application->testsDir,
    ]
);

$loader->register();