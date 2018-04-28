<template>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ $i18n.locales.find(x => x.code === $i18n.locale).name }}
        </a>
        <div class="dropdown-menu">
            <nuxt-link v-for="(locale, idx) in $i18n.locales" class="dropdown-item"
                       v-if="locale.code !== $i18n.locale"
                       :key="idx"
                       :exact="true"
                       :to="switchLocalePath(locale.code)">
                {{ locale.name }}
            </nuxt-link>
        </div>
    </li>
</template>
