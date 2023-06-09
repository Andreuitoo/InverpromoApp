<template>
  <div>
    <Head title="Viviendas" />
    <h1 class="mb-8 text-3xl font-bold">Viviendas</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset" />
      <Link class="btn-indigo" href="/viviendas/create">
        <span>Añadir</span>
        <span class="hidden md:inline">&nbsp;vivienda</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Referencia</th>
          <th class="pb-4 pt-6 px-6">Fecha</th>
          <th class="pb-4 pt-6 px-6">Nota</th>
          <th class="pb-4 pt-6 px-6">Tipo de vivienda</th>
          <th class="pb-4 pt-6 px-6">Propietario</th>
          <th class="pb-4 pt-6 px-6">Teléfono</th>
          <th class="pb-4 pt-6 px-6">Zona</th>
          <th class="pb-4 pt-6 px-6">Precio</th>
          <th class="pb-4 pt-6 px-6">Fotos</th>
        </tr>
        <tr v-for="vivienda in viviendas.data" :key="vivienda.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/viviendas/${vivienda.id}/edit`">
              {{ vivienda.ref }}
              <icon v-if="vivienda.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/viviendas/${vivienda.id}/edit`" tabindex="-1">
              {{ vivienda.fecha }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/viviendas/${vivienda.id}/edit`" tabindex="-1">
              {{ vivienda.nota }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/viviendas/${vivienda.id}/edit`" tabindex="-1">
              {{ vivienda.tipo }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/viviendas/${vivienda.id}/edit`" tabindex="-1">
              {{ vivienda.propietario }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/viviendas/${vivienda.id}/edit`" tabindex="-1">
              {{ vivienda.telefono }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/viviendas/${vivienda.id}/edit`" tabindex="-1">
              {{ vivienda.muebles }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/viviendas/${vivienda.id}/edit`" tabindex="-1">
              {{ vivienda.telefono }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/viviendas/${vivienda.id}/edit`" tabindex="-1">
              {{ vivienda.propietario }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/viviendas/${vivienda.id}/edit`" tabindex="-1">
              {{ vivienda.descripcion }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/viviendas/${vivienda.id}`" tabindex="-1">
              Fotos
            </Link>
          </td>
        </tr>
        <tr v-if="viviendas.data.length === 0">
          <td class="px-6 py-4 border-t" colspan="11">No se han encontrado viviendas</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="viviendas.links" />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import SearchFilter from '@/Shared/SearchFilter'
import Pagination from '@/Shared/Pagination'
import Dropdown from '@/Shared/Dropdown'

export default {
  components: {
    Head,
    Icon,
    Link,
    SearchFilter,
    Pagination,
    Dropdown,
  },
  layout: Layout,
  props: {
    filters: Object,
    viviendas: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/viviendas', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>

