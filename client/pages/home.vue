<template>
    <div>
        <card :title="$t('pages.index.articles')">
            <table>
                <tr>
                    <th>{{ $t('pages.index.table.id') }}</th>
                    <th>{{ $t('pages.index.table.author') }}</th>
                    <th>{{ $t('pages.index.table.slug') }}</th>
                    <th>{{ $t('pages.index.table.title') }}</th>
                    <th>{{ $t('pages.index.table.description') }}</th>
                    <th>{{ $t('pages.index.table.created') }}</th>
                    <th>{{ $t('pages.index.table.updated') }}</th>
                </tr>
                <tr v-for="article in articles" :key="article.id">
                    <td>{{ article.id }}</td>
                    <td>{{ article.user }}</td>
                    <td>{{ article.slug }}</td>
                    <td>{{ article.title }}</td>
                    <td>{{ article.description }}</td>
                    <td>{{ article.created_at }}</td>
                    <td>{{ article.updated_at }}</td>
                </tr>
            </table>
            <div class="pagination">
                <button :disabled="! prevPage" @click.prevent="goToPrev">Previous</button>
                {{ paginatonCount }}
                <button :disabled="! nextPage" @click.prevent="goToNext">Next</button>
            </div>
        </card>
    </div>
</template>

<script>
  export default {
    middleware: 'auth',
    head () {
      return {title: this.$t('pages.home.title')}
    },
    watchQuery: [
      'page'
    ],
    async asyncData ({app, route}) {
      const data = await app.$axios.$get('articles', {params: route.query})
      return {
        articles: data.data,
        meta: data.meta
      }
    },
    computed: {
      nextPage () {
        if (!this.meta || this.meta.current_page === this.meta.last_page) {
          return
        }
        return this.meta.current_page + 1
      },
      prevPage () {
        if (!this.meta || this.meta.current_page === 1) {
          return
        }
        return this.meta.current_page - 1
      },
      paginatonCount () {
        if (!this.meta) {
          return
        }
        const {current_page, last_page} = this.meta
        return `${current_page} of ${last_page}`
      },
    },
    methods: {
      goToNext () {
        this.$router.push({
          query: Object.assign({}, this.$route.query, {page: this.nextPage})
        })
      },
      goToPrev () {
        this.$router.push({
          query: Object.assign({}, this.$route.query, {page: this.prevPage})
        })
      }
    }
  }
</script>
