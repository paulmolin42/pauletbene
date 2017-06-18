server '193.70.90.176', user: 'www-data', roles: %w{app web}

set :ssh_options, {
  keys: %w(/home/paulm/.ssh/id_rsa),
  forward_agent: true,
}
