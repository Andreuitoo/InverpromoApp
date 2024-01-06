<template>
  <div>
    <Head title="Pisos" />
    <h1 class="mb-8 text-3xl font-bold">Pisos</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset" />
      <Link class="btn-indigo" href="/pisos/create">
        <span>Añadir</span>
        <span class="hidden md:inline">&nbsp;piso</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Referencia</th>
          <th class="pb-4 pt-6 px-6">Fecha</th>
          <th class="pb-4 pt-6 px-6">Tipo de piso</th>
          <th class="pb-4 pt-6 px-6">Zona</th>
          <th class="pb-4 pt-6 px-6">Precio</th>
          <th class="pb-4 pt-6 px-6">Nº Habs</th>
          <th class="pb-4 pt-6 px-6">Muebles</th>
          <th class="pb-4 pt-6 px-6">Teléfono</th>
          <th class="pb-4 pt-6 px-6">Fotos</th>
          <th class="pb-4 pt-6 px-6">Propietario</th>
          <th class="pb-4 pt-6 px-6">Descripción</th>
        </tr>
        <tr v-for="piso in pisos.data" :key="piso.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/pisos/${piso.id}/edit`">
              {{ piso.ref }}
              <icon v-if="piso.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/pisos/${piso.id}/edit`" tabindex="-1">
              {{ piso.fecha }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/pisos/${piso.id}/edit`" tabindex="-1">
              {{ piso.tipo_piso }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/pisos/${piso.id}/edit`" tabindex="-1">
              {{ piso.zona }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/pisos/${piso.id}/edit`" tabindex="-1">
              {{ piso.precio }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/pisos/${piso.id}/edit`" tabindex="-1">
              {{ piso.num_hab }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/pisos/${piso.id}/edit`" tabindex="-1">
              {{ piso.muebles }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/pisos/${piso.id}/edit`" tabindex="-1">
              {{ piso.telefono }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/pisos/${piso.id}`" tabindex="-1">
              Fotos
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/pisos/${piso.id}/edit`" tabindex="-1">
              {{ piso.propietario }}
            </Link>
          </td>
          <td class="border-t">
            <div class="flex items-center px-6 py-4 focus:text-green-500">
              <div v-if="piso.descripcion && piso.descripcion.length > 100">
                {{ piso.descripcion.slice(0, 50) + '...' }}
                <a class="cursor-pointer text-green-500 underline" @click="mostrarDescripcionCompleta(piso)">Ver más</a>
              </div>
              <div v-else>
                {{ piso.descripcion }}
              </div>
            </div>
          </td>
        </tr>
        <tr v-if="pisos.data.length === 0">
          <td class="px-6 py-4 border-t" colspan="11">No se han encontrado pisos</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="pisos.links" />
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
import Swal from 'sweetalert2'

export default {
  components: {
    Head,
    Icon,
    Link,
    SearchFilter,
    Pagination,
  },
  layout: Layout,
  props: {
    filters: Object,
    pisos: Object,
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
        this.$inertia.get('/pisos', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
    mostrarDescripcionCompleta(piso) {
      Swal.fire({
        title: 'Descripción completa',
        text: piso.descripcion,
        icon: 'info',
        confirmButtonText: 'Cerrar'
      });
    }
  },
}
</script>
