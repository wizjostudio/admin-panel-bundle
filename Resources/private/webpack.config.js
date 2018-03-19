var Encore = require('@symfony/webpack-encore');

Encore
  .setOutputPath('../public/build')
  .setPublicPath('/bundles/wizjoadminpanel/build')

  .enableSourceMaps(!Encore.isProduction())
  .cleanupOutputBeforeBuild()
  .setManifestKeyPrefix('wizjoadminpanel')
  .enableVersioning()

  .enableSassLoader()
  .enableVueLoader()
  .createSharedEntry('vendor', [
    'vue',
    'bootstrap-vue',
    'axios',
    'vuex',
    'vue-router',

    './js/global.js',

    'bootstrap/scss/bootstrap.scss',
    'bootstrap-vue/dist/bootstrap-vue.css',

    './scss/light-bootstrap-dashboard.scss',
    './scss/custom.scss'
  ]);

module.exports = Encore.getWebpackConfig();
