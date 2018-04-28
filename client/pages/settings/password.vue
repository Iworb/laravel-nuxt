<template>
  <card :title="$t('pages.settings.password.password_info')">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('password_updated')"/>

      <!-- Old password -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('pages.settings.password.old_password') }}</label>
        <div class="col-md-7">
          <input v-model="form.oldPassword" type="password" name="oldPassword" class="form-control"
                 :class="{ 'is-invalid': form.errors.has('oldPassword') }">
          <has-error :form="form" field="oldPassword"/>
        </div>
      </div>

      <!-- Password -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('pages.settings.password.password') }}</label>
        <div class="col-md-7">
          <input v-model="form.password" type="password" name="password" class="form-control"
            :class="{ 'is-invalid': form.errors.has('password') }">
          <has-error :form="form" field="password"/>
        </div>
      </div>

      <!-- Password Confirmation -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('pages.settings.password.password_confirmation') }}</label>
        <div class="col-md-7">
          <input v-model="form.password_confirmation" type="password" name="password_confirmation" class="form-control"
            :class="{ 'is-invalid': form.errors.has('password_confirmation') }">
          <has-error :form="form" field="password_confirmation"/>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <v-button type="success" :loading="form.busy">{{ $t('pages.settings.password.update') }}</v-button>
        </div>
      </div>
    </form>
  </card>
</template>

<script>
import Form from 'vform'

export default {
  scrollToTop: false,

  head () {
    return { title: this.$t('pages.settings.password.title') }
  },

  data: () => ({
    form: new Form({
      oldPassword: '',
      password: '',
      password_confirmation: ''
    })
  }),

  methods: {
    async update () {
      await this.form.patch('/settings/password')

      this.form.reset()
    }
  }
}
</script>
