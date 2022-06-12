<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'uapping.pt');

// Project repository
set('repository', 'git@github.com:mari-alves/uapping.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
set('shared_files', []);
set('shared_dirs', ['connections']);

// Writable dirs by web server
set('writable_dirs', []);

set('bin/php', function () {
    return '/usr/bin/php7.4';
});

set('bin/composer', function () {
    return '/usr/bin/php7.4 /usr/bin/composer';
});


// Hosts

host('uapping.pt')
    ->user('marianaalves')
    ->set('deploy_path', '~/sites/{{application}}');


// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
