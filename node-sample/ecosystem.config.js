module.exports = {
  apps : [{
    name: 'node-sample',
    script: 'app.js',
    args: '',
    instances: 1,
    autorestart: true,
    watch: false,
    max_memory_restart: '512M',
    env: {
      NODE_ENV: 'development'
    },
    env_production: {
      NODE_ENV: 'production'
    }
  }]
};
