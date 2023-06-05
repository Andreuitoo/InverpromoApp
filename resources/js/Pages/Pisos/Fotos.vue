<template>
    <div>
      <Head title="Fotos" />
      <div class="flex justify-start mb-8 max-w-3xl">
        <h1 class="text-3xl font-bold">
          <Link class="text-green-700 hover:text-green-500" href="/pisos">Pisos</Link>
          <span class="text-green-700 font-medium">/</span>
          Fotos del piso {{ piso.ref }}
        </h1>
      </div>
      <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
        <template v-if="piso.fotos.length > 0">
          <div class="p-4" v-for="foto in piso.fotos" :key="foto.id">
            <img :src="foto.ruta" alt="Foto del piso" class="w-full h-auto" />
          </div>
        </template>
        <template v-else>
          <div class="p-4">
            <p>No hay fotos disponibles para este piso.</p>
          </div>
        </template>
      </div>
    </div>
  </template>
  
  <script>
  import { Head, Link } from '@inertiajs/inertia-vue3'
  import Icon from '@/Shared/Icon'
  import Layout from '@/Shared/Layout'
  import Pagination from '@/Shared/Pagination'
  
  export default {
    components: {
      Head,
      Icon,
      Link,
      Pagination,
    },
    layout: Layout,
    props: {
      piso: Object,
    },
  }
  </script>
  