const ewelink = require('ewelink-api');

(async () => {

/* instantiate class */
const connection = new ewelink({
  email: 'shad_k@live.nl',
  password: 'SchoolRSD',
  region: 'eu',
  APP_ID: 'Uw83EKZFxdif7XFXEsrpduz5YyjP7nTl',
  APP_SECRET: 'mXLOjea0woSMvK9gw7Fjsy7YlFO4iSu6'
});

/* get all devices */
const devices = await connection.getDevices('10016c4db1');
console.log(devices);

  /* toggle device */
  await connection.toggleDevice('10016c4db1');

})();
