<template>
  <div>
    <label v-if="label" class="form-label">{{ label }}:</label>
    <div class="form-input p-0" :class="{ error: errors.length }">
      <input ref="file" type="file" :accept="accept" class="hidden" @change="change" multiple />
      <div v-if="!modelValue.length" class="p-2">
        <button type="button" class="px-4 py-1 text-white text-xs font-medium bg-gray-500 hover:bg-gray-700 rounded-sm" @click="browse">Browse</button>
      </div>
      <div v-else class="flex flex-col space-y-2">
        <div v-for="file in modelValue" :key="file.name" class="flex items-center justify-between p-2">
          <div class="flex-1 pr-1">
            {{ file.name }} <span class="text-gray-500 text-xs">({{ filesize(file.size) }})</span>
          </div>
          <button type="button" class="px-4 py-1 text-white text-xs font-medium bg-gray-500 hover:bg-gray-700 rounded-sm" @click="remove(file)">Remove</button>
        </div>
      </div>
    </div>
    <div v-if="errors.length" class="form-error">{{ errors[0] }}</div>
  </div>
</template>

<script>
export default {
  props: {
    modelValue: {
      type: Array,
      default: () => [],
    },
    label: String,
    accept: String,
    errors: {
      type: Array,
      default: () => [],
    },
  },
  emits: ['update:modelValue'],
  watch: {
    modelValue: {
      handler(value) {
        if (!Array.isArray(value)) {
          this.$emit('update:modelValue', []);
        }
      },
      immediate: true,
    },
  },
  methods: {
    filesize(size) {
      const i = Math.floor(Math.log(size) / Math.log(1024))
      return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i]
    },
    browse() {
      this.$refs.file.click()
    },
    change(e) {
      const files = Array.from(e.target.files);
      const validFiles = files.filter(file => file instanceof File); // Filtrar solo los archivos del tipo File

      this.$emit('update:modelValue', validFiles);
    },
    remove(file) {
      const updatedFiles = this.modelValue.filter(f => f !== file);
      this.$emit('update:modelValue', updatedFiles);
    },
  },
}
</script>

