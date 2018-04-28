require('dotenv').config()

const polyfills = [
  'Promise',
  'Object.assign',
  'Object.values',
  'Array.prototype.find',
  'Array.prototype.findIndex',
  'Array.prototype.includes',
  'String.prototype.includes',
  'String.prototype.startsWith',
  'String.prototype.endsWith'
]

process.env.API_URL = process.env.APP_URL

module.exports = {
  // mode: 'spa',

  srcDir: __dirname,

  env: {
    apiUrl: process.env.APP_URL || 'http://api.laravel-nuxt.test',
    appName: process.env.APP_NAME || 'Laravel-Nuxt',
    githubAuth: !!process.env.GITHUB_CLIENT_ID
  },
  axios: {
    browserBaseURL: process.env.APP_URL
  },

  head: {
    title: process.env.APP_NAME,
    titleTemplate: process.env.APP_NAME + ' - %s',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'Nuxt.js project' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ],
    script: [
      { src: `https://cdn.polyfill.io/v2/polyfill.min.js?features=${polyfills.join(',')}` }
    ]
  },

  loading: { color: 'cyan' },

  build: {
    extractCss: {
      allChunks: true
    }
  },

  router: {
    middleware: [
      'check-auth'
    ]
  },

  css: [
    { src: '~assets/sass/app.scss', lang: 'scss' }
  ],

  plugins: [
    '~components/global',
    '~plugins/i18n',
    '~plugins/vform',
    '~plugins/axios',
    '~plugins/fontawesome',
    '~plugins/nuxt-client-init',
    { src: '~plugins/bootstrap', ssr: false }
  ],

  modules: [
    '~modules/spa',
    '@nuxtjs/axios',
    ['nuxt-i18n', {
      locales: [
        {
          code: 'en',
          iso: 'en',
          name: 'English',
          langFile: 'en.js'
        },
        {
          code: 'ru',
          iso: 'ru',
          name: 'Русский',
          langFile: 'ru.js'
        }
      ],
      defaultLocale: 'en',
      loadLanguagesAsync: true,
      langDir: 'locales/'
    }]
  ]
}
