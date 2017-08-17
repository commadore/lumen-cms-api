<?php
namespace Deployer;

require 'recipe/laravel.php';

task('upload', function () {
    upload('.', '{{release_path}}');
});

task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'upload',
    'deploy:shared',
    'deploy:writable',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// Configuration
set('ssh_type', 'native');
set('ssh_multiplexing', false);

add('shared_files', []);
add('shared_dirs', [
    'challenges'
]);

add('writable_dirs', []);

// run migrations
before('deploy:symlink', 'artisan:migrate');

// manage fpm
task('reload:php-fpm', function () {
    run('sudo /usr/sbin/service php7.0-fpm restart');
});

after('deploy', 'reload:php-fpm');
after('rollback', 'reload:php-fpm');

// Servers
host('production')
    ->hostname('r9-skycontent.uksouth.cloudapp.azure.com')
    ->user('deploy')
    ->forwardAgent()
    ->set('deploy_path', '/var/www/skycontent.rocket9.co.uk')
;
