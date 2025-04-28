<script setup>
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import CategorieService from '@/Pages/services/CategorieService';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
  show: {
    type: Boolean,
    required: true
  },
  category: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['update:show', 'categoryEdited']);

const name = ref(props.category?.name || '');
const error = ref('');

const updateCategory = async () => {
  try {
    await CategorieService.update(props.category.id, { name: name.value });
    emit('categoryEdited');
    error.value = '';
    close();
  } catch (err) {
    error.value = err.response?.data?.message || 'Une erreur est survenue';
  }
};

const close = () => {
  emit('update:show', false);
};
</script>

<template>
  <Modal :show="show" @update:show="emit('update:show', $event)" @close="close">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        Modifier la catégorie
      </h2>
    </template>

    <div class="p-6">
      <div class="grid gap-4">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Nom
          </label>
          <input
            v-model="name"
            type="text"
            id="name"
            name="name"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          />
          <InputError v-if="error" :message="error" />
        </div>

        <div>
          <button
            @click="updateCategory"
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            Mettre à jour
          </button>
        </div>
      </div>
    </div>
  </Modal>
</template>
