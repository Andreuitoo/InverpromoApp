<template>
  <div>
<!--     <div class="mb-4">
      <Link class="group flex items-center py-3" href="/">
        <icon name="dashboard" class="mr-2 w-4 h-4" :class="isUrl('') ? 'fill-cyan-200' : 'fill-white group-hover:fill-white'" />
        <div :class="isUrl('') ? 'text-cyan-200' : 'text-white group-hover:text-white'">Dashboard</div>
      </Link>
    </div> -->
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/pisos">
        <icon name="office" class="mr-2 w-4 h-4" :class="isUrl('pisos') ? 'fill-cyan-200' : 'fill-white group-hover:fill-white'" />
        <div :class="isUrl('pisos') ? 'text-cyan-200' : 'text-white group-hover:text-white'">Pisos</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/demandas">
        <icon name="printer" class="mr-2 w-4 h-4" :class="isUrl('demandas') ? 'fill-cyan-200' : 'fill-white group-hover:fill-white'" />
        <div :class="isUrl('demandas') ? 'text-cyan-200' : 'text-white group-hover:text-white'">Demandas</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/viviendas">
        <icon name="house" class="mr-2 w-4 h-4" :class="isUrl('viviendas') ? 'fill-cyan-200' : 'fill-white group-hover:fill-white'" />
        <div :class="isUrl('viviendas') ? 'text-cyan-200' : 'text-white group-hover:text-white'">Viviendas</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/clientes">
        <icon name="users" class="mr-2 w-4 h-4" :class="isUrl('clientes') ? 'fill-cyan-200' : 'fill-white group-hover:fill-white'" />
        <div :class="isUrl('clientes') ? 'text-cyan-200' : 'text-white group-hover:text-white'">Clientes</div>
      </Link>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'

export default {
  components: {
    Icon,
    Link,
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length
    },
  },
}
</script>
