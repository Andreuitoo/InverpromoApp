<template>
  <div class="flex items-center">
    <div class="flex bg-white rounded shadow">
      <dropdown :auto-close="false"
        class="focus:z-10 px-4 hover:bg-gray-100 border-r focus:border-white rounded-l focus:ring md:px-6"
        placement="bottom-start">
        <template #default>
          <div class="flex items-baseline">
            <span class="hidden text-gray-700 md:inline">Filtros</span>
            <svg class="w-2 h-2 fill-gray-700 md:ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 961.243 599.998">
              <path
                d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z" />
            </svg>
          </div>
        </template>
        <template #dropdown>
          <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                <TextInput v-model="precioMin" type="number" placeholder="Precio mínimo" class="pb-8 pr-6 w-full lg:w-1/2"/>
                <TextInput v-model="precioMax" type="number" placeholder="Precio máximo" class="pb-8 pr-6 w-full lg:w-1/2"/>
                <TextInput v-model="precioMax" type="number" placeholder="Precio máximo" class="pb-8 pr-6 w-full lg:w-1/2"/>
                <TextInput v-model="precioMax" type="number" placeholder="Precio máximo" class="pb-8 pr-6 w-full lg:w-1/2"/>
                <TextInput v-model="precioMax" type="number" placeholder="Precio máximo" class="pb-8 pr-6 w-full lg:w-1/2"/>
                <TextInput v-model="precioMax" type="number" placeholder="Precio máximo" class="pb-8 pr-6 w-full lg:w-1/2"/>
            </div>
            <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100" type="button">
              <LoadingButton class="btn-indigo ml-auto" @click="aplicarFiltros">Aplicar filtros</LoadingButton>
            </div>
          </div>
        </template>
      </dropdown>
      <input class="relative px-6 py-3 w-full rounded focus:shadow-outline" autocomplete="off" type="text" name="search"
        placeholder="Buscar..." :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
    </div>
    <button class="ml-3 text-gray-500 hover:text-gray-700 focus:text-green-700 text-sm" type="button"
      @click="$emit('reset')">Borrar</button>
  </div>
</template>

<script>
import Dropdown from '@/Shared/Dropdown'
import TextInput from '@/Shared/TextInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    Dropdown,
    TextInput,
    LoadingButton
  },
  props: {
    modelValue: String,
    maxWidth: {
      type: Number,
      default: 300,
    },
  },
  emits: ['update:modelValue', 'reset'],
}
</script>