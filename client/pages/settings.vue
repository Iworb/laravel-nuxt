<template>
  <div class="row">
    <div class="col-md-3">
      <card :title="$t('pages.settings.title')" class="settings-card">
        <ul class="nav flex-column nav-pills">
          <li v-for="tab in tabs" class="nav-item">
            <router-link :to="localePath(tab.route)" class="nav-link" active-class="active">
              <fa :icon="tab.icon" fixed-width/>
              {{ tab.name }}
            </router-link>
          </li>
        </ul>
      </card>
    </div>

    <div class="col-md-9">
      <transition name="fade" mode="out-in">
        <nuxt-child/>
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  middleware: 'auth',
  computed: {
    tabs () {
      return [
        {
          icon: 'user',
          name: this.$t('pages.settings.profile.title'),
          route: 'settings-profile'
        },
        {
          icon: 'lock',
          name: this.$t('pages.settings.password.title'),
          route: 'settings-password'
        }
      ]
    }
  }
}
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>
