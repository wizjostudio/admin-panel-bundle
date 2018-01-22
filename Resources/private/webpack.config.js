var Encore = require('@symfony/webpack-encore');

Encore
  .setOutputPath('../public/build')
  .setPublicPath('/bundles/scriberadminpanel/build')

  .enableSourceMaps(!Encore.isProduction())
  .cleanupOutputBeforeBuild()
  .setManifestKeyPrefix('scriberadminpanel')
  .enableVersioning()

  .enableSassLoader()
  .enableVueLoader()
  .createSharedEntry('vendor', [
    'vue',
    'bootstrap-vue',
    'axios',

    './js/global.js',

    'bootstrap/scss/bootstrap.scss',
    './scss/light-bootstrap-dashboard.scss',
    './scss/custom.scss'
  ]);

module.exports = Encore.getWebpackConfig();
