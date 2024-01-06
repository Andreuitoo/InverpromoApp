<template>
  <div>
    <Head :title="`${form.ref}`" />
    <div class="flex justify-start mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-green-700 hover:text-green-500" href="/viviendas">Viviendas</Link>
        <span class="text-green-700 font-medium">/</span>
        {{ form.ref }}
      </h1>
    </div>
    <trashed-message v-if="vivienda.deleted_at" class="mb-6" @restore="restore"> Esta vivienda ha sido eliminada. </trashed-message>
    <div class="max-w-8xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.ref" :error="form.errors.ref" class="pb-8 pr-6 w-full lg:w-1/3" placeholder="VXXXX" label="Referencia" />
          <text-input v-model="form.fecha" :error="form.errors.fecha" class="pb-8 pr-6 w-full lg:w-1/3" type="date" label="Fecha" />
          <text-input v-model="form.nota" :error="form.errors.nota" class="pb-8 pr-6 w-full lg:w-1/3" label="Nota" />
          <select-input v-model="form.tipo" :error="form.errors.tipo" class="pb-8 pr-6 w-full lg:w-1/3" label="Tipo de vivienda">
            <option value="APAR">Apartamento</option>
            <option value="TICO">Atico</option>
            <option value="VIVI">Vivienda</option>
            <option value="ESTU">Estudio</option>
            <option value="BAJA">Planta baja</option>
            <option value="ZOTI">ZOTI</option>
            <option value="CASA">Casa</option>
            <option value="DUPL">Dúplex</option>
            <option value="RUST">Rústica</option>
            <option value="XALE">Chalet</option>
            <option value="SADO">Adosado</option>
            <option value="LOFT">Loft</option>
            <option value="FINC">Finca</option>
            <option value="PISO">Piso</option>
          </select-input>
          <text-input v-model="form.propietario" :error="form.errors.propietario" class="pb-8 pr-6 w-full lg:w-1/3" label="Propietario" />
          <text-input v-model="form.telefono" :error="form.errors.telefono" class="pb-8 pr-6 w-full lg:w-1/3" type="number" label="Teléfono" />
          <text-input v-model="form.zona" :error="form.errors.zona" class="pb-8 pr-6 w-full lg:w-1/3" label="Zona 1" />
          <text-input v-model="form.zona_2" :error="form.errors.zona_2" class="pb-8 pr-6 w-full lg:w-1/3" label="Zona 2" />
          <text-input v-model="form.precio_prop" :error="form.errors.precio_prop" class="pb-8 pr-6 w-full lg:w-1/3" type="number" label="Precio propietario" />
          <text-input v-model="form.precio_venta" :error="form.errors.precio_venta" class="pb-8 pr-6 w-full lg:w-1/3" type="number" label="Precio venta" />
          <text-input v-model="form.terraza" :error="form.errors.terraza" class="pb-8 pr-6 w-full lg:w-1/3" label="Terraza" />
          <text-input v-model="form.num_hab" :error="form.errors.num_hab" class="pb-8 pr-6 w-full lg:w-1/3" type="number" label="Número de habitaciones" />
          <text-input v-model="form.num_banos" :error="form.errors.num_banos" class="pb-8 pr-6 w-full lg:w-1/3" type="number" label="Número de baños" />
          <select-input v-model="form.ascensor" :error="form.errors.ascensor" class="pb-8 pr-6 w-full lg:w-1/3" label="Ascensor">
            <option value="SI">Con ascensor</option>
            <option value="NO">Sin ascensor</option>
          </select-input> 
          <text-input v-model="form.altura_planta" :error="form.errors.altura_planta" class="pb-8 pr-6 w-full lg:w-1/3" label="Altura vivienda" />
          <select-input v-model="form.coladuria" :error="form.errors.coladuria" class="pb-8 pr-6 w-full lg:w-1/3" label="Coladuria">
            <option value="SI">Con coladuria</option>
            <option value="NO">Sin coladuria</option>
          </select-input>
          <select-input v-model="form.garaje" :error="form.errors.garaje" class="pb-8 pr-6 w-full lg:w-1/3" label="Garaje">
            <option value="SI">Con garaje</option>
            <option value="NO">Sin garaje</option>
          </select-input>
          <select-input v-model="form.piscina" :error="form.errors.piscina" class="pb-8 pr-6 w-full lg:w-1/3" label="Piscina">
            <option value="SI">Con piscina</option>
            <option value="NO">Sin piscina</option>
          </select-input>
          <text-input v-model="form.balcon" :error="form.errors.balcon" class="pb-8 pr-6 w-full lg:w-1/3" label="Balcón" />
          <text-input v-model="form.m2" :error="form.errors.m2" class="pb-8 pr-6 w-full lg:w-1/3" type="number" label="M2 de la vivienda" />
          <select-input v-model="form.estado" :error="form.errors.estado" class="pb-8 pr-6 w-full lg:w-1/3" label="Estado de la vivienda">
            <option value="NUEV">Nuevo</option>
            <option value="BUEN">Bueno</option>
            <option value="REGU">Regular</option>
            <option value="MALA">Malo</option>
            <option value="NS">No sabe no contesta</option>
          </select-input>
          <select-input v-model="form.muebles" :error="form.errors.muebles" class="pb-8 pr-6 w-full lg:w-1/3" label="Muebles">
            <option value="SIN">Sin muebles</option>
            <option value="CON">Con muebles</option>
            <option value="SEMI">Semi equipado</option>
            <option value="EQUI">Equipado</option>
          </select-input>
          <text-input v-model="form.carpinteria_int" :error="form.errors.carpinteria_int" class="pb-8 pr-6 w-full lg:w-1/3" label="Carpintería interior" />
          <text-input v-model="form.carpinteria_ext" :error="form.errors.carpinteria_ext" class="pb-8 pr-6 w-full lg:w-1/3" label="Carpintería exterior" />
          <text-input v-model="form.zona_comunitaria" :error="form.errors.zona_comunitaria" class="pb-8 pr-6 w-full lg:w-1/3" label="Zona comunitaria" />
          <text-input v-model="form.antiguedad" :error="form.errors.antiguedad" class="pb-8 pr-6 w-full lg:w-1/3" label="Antiguedad" />
          <text-input v-model="form.direccion" :error="form.errors.direccion" class="pb-8 pr-6 w-full lg:w-1/3" label="Dirección" />
          <text-area-input v-model="form.descripcion" :error="form.errors.descripcion" class="pb-8 pr-6 w-full lg:w-1/3" label="Descripción" />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!vivienda.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Eliminar vivienda</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Actualizar vivienda</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import TextAreaInput from '@/Shared/TextareaInput'
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
    vivienda: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        ref: this.vivienda.ref,
        fecha: this.vivienda.fecha,
        nota: this.vivienda.nota,
        tipo: this.vivienda.tipo,
        propietario: this.vivienda.propietario,
        telefono: this.vivienda.telefono,
        zona: this.vivienda.zona,
        zona_2: this.vivienda.zona_2,
        precio_prop: this.vivienda.precio_prop,
        precio_venta: this.vivienda.precio_venta,
        terraza: this.vivienda.terraza,
        num_hab: this.vivienda.num_hab,
        num_banos: this.vivienda.num_banos,
        ascensor: this.vivienda.ascensor,
        altura_planta: this.vivienda.altura_planta,
        coladuria: this.vivienda.coladuria,
        garaje: this.vivienda.garaje,
        piscina: this.vivienda.piscina,
        balcon: this.vivienda.balcon,
        m2: this.vivienda.m2,
        estado: this.vivienda.estado,
        muebles: this.vivienda.muebles,
        carpinteria_int: this.vivienda.carpinteria_int,
        carpinteria_ext: this.vivienda.carpinteria_ext,
        zona_comunitaria: this.vivienda.zona_comunitaria,
        antiguedad: this.vivienda.antiguedad,
        direccion: this.vivienda.direccion,
        descripcion: this.vivienda.descripcion,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/viviendas/${this.vivienda.id}`, {
      })
    },
    destroy() {
      if (confirm('Estas seguro que quieres borrar esta vivienda?')) {
        this.$inertia.delete(`/viviendas/${this.vivienda.id}`)
      }
    },
    restore() {
      if (confirm('Estas seguro que quieres restaurar esta vivienda?')) {
        this.$inertia.put(`/viviendas/${this.vivienda.id}/restore`)
      }
    },
  },
}
</script>
