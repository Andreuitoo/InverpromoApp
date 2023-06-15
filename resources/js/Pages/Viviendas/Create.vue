<template>
  <div>
    <Head title="Añadir vivienda" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-green-700 hover:text-green-500" href="/viviendas">Viviendas</Link>
      <span class="text-green-700 font-medium">/</span> Añadir vivienda
    </h1>
    <div class="max-w-8xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store" enctype="multipart/form-data">
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
          <FileInput2 v-model="form.fotos" :error="form.errors.fotos" class="pb-8 pr-6 w-full lg:w-1/3" label="Fotos" multiple />
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Añadir vivienda</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import FileInput2 from '@/Shared/FileInput2'
import TextInput from '@/Shared/TextInput'
import TextAreaInput from '@/Shared/TextareaInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    FileInput2,
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
        ref: null,
        fecha: null,
        nota: null,
        tipo: null,
        propietario: null,
        telefono: null,
        zona: null,
        zona_2: null,
        precio_prop: null,
        precio_venta: null,
        terraza: null,
        num_hab: null,
        num_banos: null,
        ascensor: null,
        altura_planta: null,
        coladuria: null,
        garaje: null,
        piscina: null,
        balcon: null,
        m2: null,
        estado: null,
        muebles: null,
        carpinteria_int: null,
        carpinteria_ext: null,
        zona_comunitaria: null,
        antiguedad: null,
        direccion: null,
        descripcion: null,
        fotos: [],
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/viviendas')
    },
  },
}
</script>
