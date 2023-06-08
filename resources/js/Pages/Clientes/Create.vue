<template>
  <div>
    <Head title="Añadir demanda" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-green-700 hover:text-green-500" href="/clientes">Demandas</Link>
      <span class="text-green-700 font-medium">/</span> Crear una nueva demanda
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.ref" :error="form.errors.ref" class="pb-8 pr-6 w-full lg:w-1/2" placeholder="D-XXXX" label="Refrencia" />
          <text-input v-model="form.nombre" :error="form.errors.nombre" class="pb-8 pr-6 w-full lg:w-1/2" label="Nombre" />
          <text-input v-model="form.telefono" :error="form.errors.telefono" class="pb-8 pr-6 w-full lg:w-1/2" type="number" label="Teléfono" />
          <text-input v-model="form.telefono_2" :error="form.errors.telefono_2" class="pb-8 pr-6 w-full lg:w-1/2" type="number" label="Segundo teléfono" />
          <text-input v-model="form.zona" :error="form.errors.zona" class="pb-8 pr-6 w-full lg:w-1/2" label="Zona" />
          <text-input v-model="form.zona_2" :error="form.errors.zona_2" class="pb-8 pr-6 w-full lg:w-1/2" label="Segunda zona" />
          <text-input v-model="form.num_hab" :error="form.errors.num_hab" class="pb-8 pr-6 w-full lg:w-1/2" type="number" label="Nº Habitaciones mínimo" />
          <text-input v-model="form.num_hab_2" :error="form.errors.num_hab_2" class="pb-8 pr-6 w-full lg:w-1/2" type="number" label="Nº Habitaciones máximo" />
          <text-input v-model="form.precio" :error="form.errors.precio" class="pb-8 pr-6 w-full lg:w-1/2" type="number" label="Precio mínimo" />
          <text-input v-model="form.precio_2" :error="form.errors.precio_2" class="pb-8 pr-6 w-full lg:w-1/2" type="number" label="Precio máximo" />
          <text-input v-model="form.fecha" :error="form.errors.fecha" class="pb-8 pr-6 w-full lg:w-1/2" type="date" label="Fecha" />
          <text-area-input v-model="form.descripcion" :error="form.errors.descripcion" class="pb-8 pr-6 w-full lg:w-1/2" label="Descripción" />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Añadir demanda</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import FileInput from '@/Shared/FileInput'
import TextInput from '@/Shared/TextInput'
import TextAreaInput from '@/Shared/TextAreaInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TextAreaInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        ref: '',
        nombre: '',
        fecha: '',
        telefono: '',
        telefono_2: '',
        zona: '',
        zona_2: '',
        num_hab: '',
        num_hab_2: '',
        precio: '',
        precio_2: '',
        descripcion: '',
      }),
    }
  },
  methods: {
    store() {
      console.log(this.form)
      this.form.post('/clientes')
    },
  },
}
</script>
