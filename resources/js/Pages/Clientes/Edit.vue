<template>
  <div>
    <Head :title="`${form.ref}`" />
    <div class="flex justify-start mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-green-700 hover:text-green-500" href="/clientes">Clientes</Link>
        <span class="text-green-700 font-medium">/</span>
        {{ form.ref }}
      </h1>
    </div>
    <trashed-message v-if="cliente.deleted_at" class="mb-6" @restore="restore"> Este cliente ha sido eliminado. </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.ref" :error="form.errors.ref" class="pb-8 pr-6 w-full lg:w-1/2" placeholder="CXXXX" label="Refrencia" />
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
          <button v-if="!cliente.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Eliminar cliente</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Actualizar cliente</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import FileInput from '@/Shared/FileInput'
import SelectInput from '@/Shared/SelectInput'
import TextAreaInput from '@/Shared/TextareaInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
    TextAreaInput,
  },
  layout: Layout,
  props: {
    cliente: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        ref: this.cliente.ref,
        nombre: this.cliente.nombre,
        telefono: this.cliente.telefono,
        telefono_2: this.cliente.telefono_2,
        zona: this.cliente.zona,
        zona_2: this.cliente.zona_2,
        num_hab: this.cliente.num_hab,
        num_hab_2: this.cliente.num_hab_2,
        precio: this.cliente.precio,
        precio_2: this.cliente.precio_2,
        fecha: this.cliente.fecha,
        descripcion: this.cliente.descripcion,
      }),
    }
  },
  methods: {
    update() {
      this.form.post(`/clientes/${this.cliente.id}`)
    },
    destroy() {
      if (confirm('Estas seguro que quieres borrar este cliente?')) {
        this.$inertia.delete(`/clientes/${this.cliente.id}`)
      }
    },
    restore() {
      if (confirm('Estas seguro que quieres restaurar este cliente?')) {
        this.$inertia.put(`/clientes/${this.cliente.id}/restore`)
      }
    },
  },
}
</script>
