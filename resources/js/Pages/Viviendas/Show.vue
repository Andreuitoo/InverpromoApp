<template>
  <div>
    <Head :title="`${vivienda.ref}`" />
    <div class="flex justify-start mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-green-700 hover:text-green-500" href="/viviendas">Viviendas</Link>
        <span class="text-green-700 font-medium">/</span>
        {{ vivienda.ref }}
      </h1>
    </div>
    <div class="max-w-8xl bg-white rounded-md shadow overflow-hidden">
      <div class="flex flex-wrap -mb-8 -mr-6 p-8">
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Fecha: {{ vivienda.fecha }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Nota: {{ vivienda.nota ? vivienda.nota : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Tipo vivienda: {{ vivienda.tipo ? vivienda.tipo : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Propietario: {{ vivienda.propietario ? vivienda.propietario : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Teléfono: {{ vivienda.telefono ? vivienda.telefono : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Zona 1: {{ vivienda.zona ? vivienda.zona : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Zona 2: {{ vivienda.zona_2 ? vivienda.zona_2 : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Precio propietario: {{ vivienda.precio_prop ? vivienda.precio_prop : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Precio venta: {{ vivienda.precio_venta ? vivienda.precio_venta : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Terraza: {{ vivienda.terraza ? vivienda.terraza : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Número de habitaciones: {{ vivienda.num_hab ? vivienda.num_hab : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Número de baños: {{ vivienda.num_banos ? vivienda.num_banos : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Ascensor: {{ vivienda.ascensor ? vivienda.ascensor : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Altura vivienda: {{ vivienda.altura_planta ? vivienda.altura_planta : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Coladuría: {{ vivienda.coladuria ? vivienda.coladuria : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Garaje: {{ vivienda.garaje ? vivienda.garaje : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Piscina: {{ vivienda.piscina  ? vivienda.piscina : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Balcón: {{ vivienda.balcon ? vivienda.balcon : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Metros cuadrados: {{ vivienda.m2 ? vivienda.m2 : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Estado de la vivienda: {{ vivienda.estado ? vivienda.estado : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Muebles: {{ vivienda.muebles ? vivienda.muebles : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Carpintería interior: {{ vivienda.carpinteria_int  ? vivienda.carpinteria_int : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Carpintería exterior: {{ vivienda.carpinteria_ext ? vivienda.carpinteria_ext : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Zona comunitaria: {{ vivienda.zona_comunitaria ? vivienda.zona_comunitaria : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Antiguedad: {{ vivienda.antiguedad ? vivienda.antiguedad : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Dirección: {{ vivienda.direccion ? vivienda.direccion : 'No hay nada apuntado' }}
        </div>
        <div class="pb-8 pr-6 w-full lg:w-1/3">
          Descripción: {{ vivienda.descripcion ? vivienda.descripcion : 'No hay nada apuntado' }}
        </div>
      </div>
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
}
</script>