<template>
    <div>

        <Head title="Fotos" />
        <div class="flex justify-start mb-8 max-w-3xl">
            <h1 class="text-3xl font-bold">
                <Link class="text-green-700 hover:text-green-500" href="/viviendas">Viviendas</Link>
                <span class="text-green-700 font-medium">/</span>
                Fotos de la vivienda {{ vivienda.ref }}
            </h1>
        </div>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <template v-if="vivienda.fotos.length > 0">
                <div class="p-4 relative" v-for="foto in vivienda.fotos" :key="foto.id">
                    <img :src="foto.ruta" alt="Foto del vivienda" class="w-full h-auto" />
                    <icon
                        class="absolute top-0 right-0 m-2 w-5 h-5 cursor-pointer border-4 border-red-500 bg-red-500 rounded-sm fill-white flex items-center justify-center"
                        name="trash" @click="deletePhotos(foto.id)" />
                </div>
            </template>
            <template v-else>
                <div class="p-4">
                    <p>No hay fotos disponibles para este vivienda.</p>
                </div>
            </template>
        </div>
        <form @submit.prevent="uploadPhotos" class="max-w-3xl bg-white rounded-md shadow p-4 mt-4 mb-4">
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                <file-input2 v-model="form.fotos" :error="form.errors.fotos" class="pb-8 pr-6 w-full lg:w-1/2" label="Fotos"
                    multiple />
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                <loading-button :loading="form.processing" class="btn-indigo" type="submit">Añadir fotos</loading-button>
            </div>
        </form>
    </div>
</template>
  
<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import Pagination from '@/Shared/Pagination'
import FileInput2 from '@/Shared/FileInput2'
import LoadingButton from '@/Shared/LoadingButton'

export default {
    components: {
        Head,
        Icon,
        Link,
        Pagination,
        FileInput2,
        LoadingButton,
        Icon
    },
    layout: Layout,
    props: {
        vivienda: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                fotos: [],
            }),
        }
    },
    methods: {
        uploadPhotos() {
            this.form.post(`/viviendas/${this.vivienda.id}/add-photos`);
        },
        deletePhotos(id) {
            if (confirm('¿Estás seguro de que quieres eliminar esta foto?')) {
                this.form.delete(`/viviendas/${this.vivienda.id}/delete-photo/${id}`);
            }
        }
    },
}
</script>