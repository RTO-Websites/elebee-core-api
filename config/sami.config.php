<?php

use Sami\Sami;
use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$projectDir = dirname(__DIR__);
$buildDir = $projectDir . '/docs';
$srcDir = dirname($projectDir) . '/elebee-core';


$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in($srcDir)
;

$versions = GitVersionCollection::create($srcDir)
    ->add('master', '0.4.0')
    ->addFromTags('0.3.0')
    ->addFromTags('0.2.0')
    ->addFromTags('0.1.0')
;

return new Sami($iterator, [
    'theme'                => 'default',
    'versions'             => $versions,
    'title'                => 'Elebee Core API',
    'build_dir'            => $buildDir . '/%version%',
    'cache_dir'            => $projectDir . '/cache/%version%',
    'remote_repository'    => new GitHubRemoteRepository('RTO-Websites/elebee-core', $srcDir),
    'default_opened_level' => 2,
]);