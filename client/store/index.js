import Cookies from 'js-cookie'
import { cookieFromRequest } from '~/utils'

export const actions = {
  nuxtServerInit ({commit}, {req}) {
    const token = cookieFromRequest(req, 'token')
    if (token) {
      commit('auth/SET_TOKEN', token)
    }

    let locale = cookieFromRequest(req, 'locale') || this.app.i18n.locale
    this.$axios.setHeader('Accept-Language', locale)
  },

  nuxtClientInit ({commit}) {
    const token = Cookies.get('token')
    if (token) {
      commit('auth/SET_TOKEN', token)
    }

    let locale = Cookies.get('locale')
    if (!locale) {
      locale = this.app.i18n.locale
      Cookies.set('locale', locale, {expires: 365})
    }
    this.$axios.setHeader('Accept-Language', locale)
  }
}
