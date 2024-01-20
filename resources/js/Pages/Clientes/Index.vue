<template>
  <div>

    <Head title="Clientes" />
    <h1 class="mb-8 text-3xl font-bold">Clientes</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset" >
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
            <TextInput v-model="form.precio" type="number" placeholder="Precio desde" class="pb-8 pr-6 w-full lg:w-1/2"/>
            <TextInput v-model="form.precio_2" type="number" placeholder="Precio hasta" class="pb-8 pr-6 w-full lg:w-1/2"/>
        </div>
      </search-filter>
      <Link class="btn-indigo" href="/clientes/create">
      <span>Añadir</span>
      <span class="hidden md:inline">&nbsp;cliente</span>
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
        <tr v-for="cliente in clientes.data" :key="cliente.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-green-500" :href="`/clientes/${cliente.id}/edit`">
            {{ cliente.ref }}
            <icon v-if="cliente.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
            </Link>
          </td>
          <td class="border-t">
            <div class="flex items-center px-2 py-4 focus:text-green-500">
              {{ cliente.nombre }}
            </div>
          </td>
          <td class="border-t">
            <div class="flex items-center px-6 py-4 focus:text-green-500">
              {{ cliente.fecha }}
            </div>
          </td>
          <td class="border-t">
            <dropdown2 class="mt-1" placement="bottom-end">
              <template #default>
                <div class="group flex items-center cursor-pointer select-none">
                  <div class="flex items-center px-2 py-4 focus:text-green-500">
                    {{ cliente.telefono }}
                  </div>
                  <icon class="w-5 h-5 fill-gray-700 group-hover:fill-green-600 focus:fill-green-600" name="cheveron-down" />
                </div>
              </template>
              <template #dropdown>
                <div class="mt-2 py-2 text-sm bg-white rounded shadow-xl">
                  <div class="flex items-center px-6 py-4 focus:text-green-500">
                    {{ cliente.telefono_2 ? cliente.telefono_2 : 'No tiene otro teléfono' }}
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
                    {{ cliente.zona }}
                  </div>
                  <icon class="w-5 h-5 fill-gray-700 group-hover:fill-green-600 focus:fill-green-600" name="cheveron-down" />
                </div>
              </template>
              <template #dropdown>
                <div class="mt-2 py-2 text-sm bg-white rounded shadow-xl">
                  <div class="flex items-center px-6 py-4 focus:text-green-500">
                    {{ cliente.zona_2 ? cliente.zona_2 : 'No tiene otra zona' }}
                  </div>
                </div>
              </template>
            </dropdown2>
          </td>
          <td class="border-t">
            <div class="flex items-center px-6 py-4 focus:text-green-500">
              De {{ cliente.num_hab }} a {{ cliente.num_hab_2 ? cliente.num_hab_2 : 'No tiene otro nº habs' }}
            </div>
          </td>
          <td class="border-t">
            <div class="flex items-center px-6 py-4 focus:text-green-500">
              Desde {{ cliente.precio }} hasta {{ cliente.precio_2 ? cliente.precio_2 : 'No tiene precio maximo' }}
            </div>
          </td>
          <td class="border-t">
            <div class="flex items-center px-6 py-4 focus:text-green-500">
              <div v-if="cliente.descripcion && cliente.descripcion.length > 30">
                {{ cliente.descripcion.slice(0, 20) + '...' }}
                <a class="cursor-pointer text-green-500 hover:underline" @click="mostrarDescripcionCompleta(cliente)">Ver más</a>
              </div>
              <div v-else>
                {{ cliente.descripcion }}
              </div>
            </div>
          </td>
        </tr>
        <tr v-if="clientes.data.length === 0">
          <td class="px-6 py-4 border-t" colspan="8">No se han encontrado clientes</td>
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
import TextInput from '@/Shared/TextInput'

export default {
  components: {
    Head,
    Icon,
    Link,
    SearchFilter,
    Dropdown2,
    TextInput,
  },
  layout: Layout,
  props: {
    filters: Object,
    clientes: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        precio: this.filters.precio,
        precio_2: this.filters.precio_2,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/clientes', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
    mostrarDescripcionCompleta(cliente) {
      Swal.fire({
        title: 'Descripción completa',
        text: cliente.descripcion,
        icon: 'info',
        confirmButtonText: 'Cerrar'
      });
    }
  },
}
</script>
