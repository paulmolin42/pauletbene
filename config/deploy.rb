# config valid only for current version of Capistrano
lock '3.8.1'

set :application, 'pauletbene'
set :repo_url, 'git@github.com:paulmolin42/pauletbene.git'

set :tmp_dir, '/var/www/tmp'
set :deploy_to, '/var/www/pauletbene'

set :linked_files, ['app/config/parameters.yml']
set :linked_dirs, [fetch(:log_path), 'web/images', 'web/pdf', 'web/audio']

after 'deploy:updated', 'npm:install'
