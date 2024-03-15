@servers(['web' => 'deployer@5.35.84.189'])

@setup
    $repository = 'git@gitlab.com:moriarty5/ieltswizard.git';
    $release = date('YmdHis');

    $releases_dir = '/var/www/ieltswizard/releases';
    $app_dir = '/var/www/ieltswizard/app';
    $new_release_dir = $releases_dir .'/'. $release;

    $dev_releases_dir = '/var/www/ieltswizard/development';
    $dev_app_dir = '/var/www/ieltswizard/dev-app';
    $new_dev_release_dir = $dev_releases_dir .'/'. $release;
@endsetup

@story('deploy')
    clone_repository
    exec_commands
    update_symlinks
@endstory

@story('deploy_dev')
    clone_repository_dev
    exec_commands_dev
    update_symlinks_dev
@endstory

@task('clone_repository')
    echo 'Cloning repository'
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
    cd {{ $new_release_dir }}
    git reset --hard {{ $commit }}
@endtask

@task('clone_repository_dev')
    echo 'Cloning repository'
    [ -d {{ $dev_releases_dir }} ] || mkdir {{ $dev_releases_dir }}
    git clone --depth 1 {{ $repository }} {{ $new_dev_release_dir }}
    cd {{ $new_dev_release_dir }}
    git reset --hard {{ $commit }}
@endtask

@task('exec_commands')
    echo 'Linking .env file'
    ln -nfs {{ $app_dir }}/.env {{ $new_release_dir }}/.env
    echo "Starting deployment ({{ $release }})"
    cd {{ $new_release_dir }}
    composer install --prefer-dist --no-scripts --ignore-platform-reqs -q -o
    echo "Composer installed successfully"
    /usr/bin/php8.3 artisan migrate --force
    echo "Migrations have been executed successfully"
    /usr/bin/php8.3 artisan storage:link
    echo "Symlink for storage has been created"
@endtask

@task('exec_commands_dev')
    echo 'Linking .env file'
    ln -nfs {{ $dev_app_dir }}/.env {{ $new_dev_release_dir }}/.env
    echo "Starting deployment ({{ $release }})"
    cd {{ $new_dev_release_dir }}
    composer install --prefer-dist --no-scripts --ignore-platform-reqs -q -o
    echo "Composer installed successfully"
    /usr/bin/php8.3 artisan migrate --force
    echo "Migrations have been executed successfully"
    /usr/bin/php8.3 artisan storage:link
    echo "Symlink for storage has been created"
@endtask

@task('update_symlinks')
    echo "Linking storage directory"
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $app_dir }}/storage {{ $new_release_dir }}/storage

    echo 'Linking current release'
    ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current
@endtask

@task('update_symlinks_dev')
    echo "Linking storage directory"
    rm -rf {{ $new_dev_release_dir }}/storage
    ln -nfs {{ $dev_app_dir }}/storage {{ $new_dev_release_dir }}/storage

    echo 'Linking current release'
    ln -nfs {{ $new_dev_release_dir }} {{ $dev_app_dir }}/current
@endtask
