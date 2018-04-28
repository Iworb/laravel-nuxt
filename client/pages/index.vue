<template>
    <div>
        <div class="top-right links">
            <template v-if="authenticated">
                <nuxt-link :to="localePath('home')">
                    {{ $t('pages.home.name') }}
                </nuxt-link>
            </template>
            <template v-else>
                <nuxt-link :to="localePath('login')">
                    {{ $t('pages.login.name') }}
                </nuxt-link>
                <nuxt-link :to="localePath('register')">
                    {{ $t('pages.register.name') }}
                </nuxt-link>
            </template>
        </div>

        <div class="text-center">
            <div class="title mb-4">
                {{ title }}
            </div>

            <div class="links">
                <a href="https://laravel.com/docs">Documentation</a>
                <a href="https://laracasts.com">Laracasts</a>
                <a href="https://laravel-news.com">News</a>
                <a href="https://forge.laravel.com">Forge</a>
                <a href="https://github.com/laravel/laravel">GitHub</a>
            </div>
        </div>
    </div>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    layout: 'simple',

    head () {
      return {title: this.$t('pages.index.title')}
    },

    computed: mapGetters({
      authenticated: 'auth/check'
    }),

    data: () => ({
      title: process.env.appName
    })
  }
</script>

<style scoped>
    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .title {
        font-size: 85px;
    }
</style>
