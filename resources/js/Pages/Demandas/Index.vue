<template>
  <div>
    <Head title="Demandas" />
    <h1 class="mb-8 text-3xl font-bold">Demandas</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset" />
      <Link class="btn-indigo" href="/demandas/create">
        <span>Añadir</span>
        <span class="hidden md:inline">&nbsp;demanda</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Referencia</th>
          <th class="pb-4 pt-6 px-6">Nombre</th>
          <th class="pb-4 pt-6 px-6">Fecha</th>
          <th class="pb-4 pt-6 px-6">Nº Tel.</th>
          <th class="pb-4 pt-6 px-6">Zona</th>
          <th class="pb-4 pt-6 px-6">Nº Habs</th>
          <th class="pb-4 pt-6 px-6">Precio</th>
          <th class="pb-4 pt-6 px-6">Descripción</th>
        </tr>
        <tr v-for="demanda in demandas.data" :key="demanda.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/demandas/${demanda.id}/edit`">
              {{ demanda.ref }}
              <icon v-if="demanda.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
            </Link>
          </td>
          <td class="border-t">
            <div class="flex items-center px-2 py-4 focus:text-green-500">
              {{ demanda.nombre }}
            </div>
          </td>
          <td class="border-t">
            <div class="flex items-center px-6 py-4 focus:text-green-500">
              {{ demanda.fecha }}
            </div>
          </td>
          <td class="border-t">
            <dropdown2 class="mt-1" placement="bottom-end">
              <template #default>
                <div class="group flex items-center cursor-pointer select-none">
                  <div class="flex items-center px-2 py-4 focus:text-green-500">
                    {{ demanda.telefono }}
                  </div>
                  <icon class="w-5 h-5 fill-gray-700 group-hover:fill-green-600 focus:fill-green-600" name="cheveron-down" />
                </div>
              </template>
              <template #dropdown>
                <div class="mt-2 py-2 text-sm bg-white rounded shadow-xl">
                  <div class="flex items-center px-6 py-4 focus:text-green-500">
                    {{ demanda.telefono_2 ? demanda.telefono_2 : 'No tiene otro teléfono' }}
                  </div>
                </div>
              </template>
            </dropdown2>
          </td>
          <td class="border-t">
            <dropdown2 class="mt-1" placement="bottom-end">
              <template #default>
                <div class="group flex items-center cursor-pointer select-none">
                  <div class="flex items-center px-2 py-4 focus:text-green-500">
                    {{ demanda.zona }}
                  </div>
                  <icon class="w-5 h-5 fill-gray-700 group-hover:fill-green-600 focus:fill-green-600" name="cheveron-down" />
                </div>
              </template>
              <template #dropdown>
                <div class="mt-2 py-2 text-sm bg-white rounded shadow-xl">
                  <div class="flex items-center px-6 py-4 focus:text-green-500">
                    {{ demanda.zona_2 ? demanda.zona_2 : 'No tiene otra zona' }}
                  </div>
                </div>
              </template>
            </dropdown2>
          </td>
          <td class="border-t">
            <div class="flex items-center px-6 py-4 focus:text-green-500">
              De {{ demanda.num_hab}} a {{ demanda.num_hab_2 ? demanda.num_hab_2 : 'No tiene otro nº habs' }}
            </div>
          </td>
          <td class="border-t">
            <div class="flex items-center px-6 py-4 focus:text-green-500">
              Desde {{ demanda.precio }} hasta {{ demanda.precio_2 }}
            </div>
          </td>
          <td class="border-t">
            <div class="flex items-center px-6 py-4 focus:text-green-500">
              <div v-if="demanda.descripcion && demanda.descripcion.length > 100">
                {{ demanda.descripcion.slice(0, 50) + '...' }}
                <a class="cursor-pointer text-green-500 underline" @click="mostrarDescripcionCompleta(demanda)">Ver más</a>
              </div>
              <div v-else>
                {{ demanda.descripcion }}
              </div>
            </div>
          </td>
        </tr>
        <tr v-if="demandas.data.length === 0">
          <td class="px-6 py-4 border-t" colspan="8">No se han encontrado demandas</td>
        </tr>
      </table>
    </div>
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
import Dropdown2 from '@/Shared/Dropdown2'
import Swal from 'sweetalert2'

export default {
  components: {
    Head,
    Icon,
    Link,
    SearchFilter,
    Dropdown2,
  },
  layout: Layout,
  props: {
    filters: Object,
    demandas: Object,
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
        this.$inertia.get('/demandas', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
    mostrarDescripcionCompleta(demanda) {
      Swal.fire({
        title: 'Descripción completa',
        text: demanda.descripcion,
        icon: 'info',
        confirmButtonText: 'Cerrar'
      });
    }
  },
}
</script>

