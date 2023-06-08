<template>
  <div>
    <Head :title="`${form.ref}`" />
    <div class="flex justify-start mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-green-700 hover:text-green-500" href="/pisos">Pisos</Link>
        <span class="text-green-700 font-medium">/</span>
        {{ form.ref }}
      </h1>
    </div>
    <trashed-message v-if="piso.deleted_at" class="mb-6" @restore="restore"> Este piso ha sido eliminado. </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.ref" :error="form.errors.ref" class="pb-8 pr-6 w-full lg:w-1/2" label="Referencia" />
          <text-input v-model="form.fecha" :error="form.errors.fecha" class="pb-8 pr-6 w-full lg:w-1/2" type="date" label="Fecha" />
          <select-input v-model="form.tipo_piso" :error="form.errors.tipo_piso" class="pb-8 pr-6 w-full lg:w-1/2" label="Tipo de piso">
            <option value="APAR">APAR</option>
            <option value="TICO">TICO</option>
            <option value="PISO">PISO</option>
            <option value="ESTU">ESTU</option>
            <option value="BAJA">BAJA</option>
            <option value="ZOTI">ZOTI</option>
            <option value="CASA">CASA</option>
            <option value="DUPL">DUPL</option>
            <option value="RUST">RUST</option>
            <option value="XALE">XALE</option>
            <option value="SADO">SADO</option>
            <option value="LOFT">LOFT</option>
            <option value="FINC">FINC</option>
          </select-input>
          <text-input v-model="form.zona" :error="form.errors.zona" class="pb-8 pr-6 w-full lg:w-1/2" label="Zona" />
          <text-input v-model="form.precio" :error="form.errors.precio" class="pb-8 pr-6 w-full lg:w-1/2" type="number" label="Precio" />
          <text-input v-model="form.num_hab" :error="form.errors.num_hab" class="pb-8 pr-6 w-full lg:w-1/2" type="number" label="Número de habitaciones" />
          <select-input v-model="form.muebles" :error="form.errors.muebles" class="pb-8 pr-6 w-full lg:w-1/2" label="Muebles">
            <option value="SIN">SIN</option>
            <option value="CON">CON</option>
            <option value="SEMI">SEMI</option>
            <option value="EQUI">EQUI</option>
          </select-input>
          <text-area-input v-model="form.descripcion" :error="form.errors.descripcion" class="pb-8 pr-6 w-full lg:w-1/2" label="Descripción" />
          <text-input v-model="form.telefono" :error="form.errors.telefono" class="pb-8 pr-6 w-full lg:w-1/2" type="number" label="Teléfono" />
          <text-input v-model="form.propietario" :error="form.errors.propietario" class="pb-8 pr-6 w-full lg:w-1/2" label="Propietario" />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!piso.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Eliminar piso</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Actualizar piso</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import TextAreaInput from '@/Shared/TextAreaInput'
import FileInput2 from '@/Shared/FileInput2'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    FileInput2,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TextAreaInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    piso: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        ref: this.piso.ref,
        fecha: this.piso.fecha,
        tipo_piso: this.piso.tipo_piso,
        zona: this.piso.zona,
        precio: this.piso.precio,
        num_hab: this.piso.num_hab,
        muebles: this.piso.muebles,
        descripcion: this.piso.descripcion,
        telefono: this.piso.telefono,
        propietario: this.piso.propietario,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/pisos/${this.piso.id}`, {
      })
    },
    destroy() {
      if (confirm('Estas seguro que quieres borrar este piso?')) {
        this.$inertia.delete(`/pisos/${this.piso.id}`)
      }
    },
    restore() {
      if (confirm('Estas seguro que quieres restaurar este piso?')) {
        this.$inertia.put(`/pisos/${this.piso.id}/restore`)
      }
    },
  },
}
</script>
