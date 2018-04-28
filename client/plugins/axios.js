import swal from 'sweetalert2'
import Form from 'vform'

process.env.NODE_TLS_REJECT_UNAUTHORIZED = '0'

export default ({app, $axios, store, redirect}) => {
  if (process.server) {
    return
  }
  $axios.onError(async error => {
    const {status} = error.response || {}

    if (status >= 500) {
      swal({
        type: 'error',
        title: app.i18n.t('error_alert_title'),
        text: app.i18n.t('error_alert_text'),
        reverseButtons: true,
        confirmButtonText: app.i18n.t('ok'),
        cancelButtonText: app.i18n.t('cancel')
      })
    }

    if (status === 401 && store.getters['auth/check']) {
      await swal({
        type: 'warning',
        title: app.i18n.t('token_expired_alert_title'),
        text: app.i18n.t('token_expired_alert_text'),
        reverseButtons: true,
        confirmButtonText: app.i18n.t('ok'),
        cancelButtonText: app.i18n.t('cancel')
      })
      await store.dispatch('auth/logout', true)
      redirect({name: 'login'})
    }
    throw error
  })
  // TODO temporary vform solution for @nuxtjs/axios
  Form.prototype.submit = async function (method, url, config = {}) {
    this.startProcessing()

    const data = method === 'get'
      ? {params: this.data()}
      : this.data()
    try {
      const response = await $axios[method](this.route(url), data, ...config)
      this.finishProcessing()
      return response
    } catch (error) {
      this.busy = false
      if (error.response) {
        this.errors.set(this.extractErrors(error.response))
      }
      throw error
    }
  }
}
