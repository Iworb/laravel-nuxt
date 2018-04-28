export default (ctx) => {
  if (process.client) ctx.store.dispatch('nuxtClientInit', ctx)
}
