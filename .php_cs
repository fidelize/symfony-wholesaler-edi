<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->exclude('app')
    ->exclude('bin')
    ->exclude('docker')
    ->exclude('var')
    ->exclude('vendor')
    ->exclude('web')
    ->in(__DIR__)
;

return Symfony\CS\Config\Config::create()
    ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->finder($finder)
    ->setUsingCache(true)
;