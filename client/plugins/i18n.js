import Cookies from 'js-cookie'

export default function ({app}) {
  app.i18n.beforeLanguageSwitch = (oldLocale, newLocale) => {
    app.$axios.setHeader('Accept-Language', newLocale)
    Cookies.set('locale', newLocale, {expires: 365})
  }
}
