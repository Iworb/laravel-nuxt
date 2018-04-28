export default async ({ app, store, req }) => {
  const token = store.getters['auth/token']

  if (process.server) {
    if (token) {
      app.$axios.setToken(token, 'Bearer')
    } else {
      app.$axios.setToken(false)
    }
  }

  if (!store.getters['auth/check'] && token) {
    await store.dispatch('auth/fetchUser')
  }
}
