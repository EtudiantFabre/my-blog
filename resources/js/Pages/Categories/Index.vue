<script setup lang="ts">
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/Components/ui/table";
import { ref, onMounted } from "vue";
import { Button } from "@/Components/ui/button";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CategorieService from "@/Pages/services/CategorieService";

import CreateCategory from '@/Components/Categories/Create.vue';
import EditCategory from '@/Components/Categories/Edit.vue';

const categories = ref([]);
const showCreateModal = ref(false);
const showEditModal = ref(false);
const selectedCategory = ref(null);

const fetchCategories = async () => {
    try {
        const response = await CategorieService.getAll();
        categories.value = response.data;
    } catch (error) {
        console.error("Erreur lors de la récupération des catégories:", error);
    }
};

const openCreateModal = () => {
    showCreateModal.value = true;
};

const openEditModal = (category) => {
    selectedCategory.value = category;
    showEditModal.value = true;
};

const deleteCategory = async (id) => {
    try {
        await CategorieService.delete(id);
        fetchCategories();
    } catch (error) {
        console.error("Erreur lors de la suppression de la catégorie:", error);
    }
};

const handleCategoryCreated = () => {
    showCreateModal.value = false;
    fetchCategories();
};

const handleCategoryEdited = () => {
    showEditModal.value = false;
    fetchCategories();
};

onMounted(() => {
    fetchCategories();
});
</script>

<template>
    <Head title="Catégories" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Catégories
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 p-6"
                >
                    <div class="gap-4">
                        <Button
                            @click="openCreateModal"
                            class="bg-amber-300 mb-4"
                            >Créer
                        </Button>

                        <Table class="">
                            <TableCaption
                                >A list of your recent invoices.</TableCaption
                            >
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Nom</TableHead>
                                    <TableHead>Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow
                                    v-for="category in categories"
                                    :key="category.id"
                                >
                                    <TableCell>{{ category.name }}</TableCell>
                                    <TableCell>
                                        <Button
                                            @click="openEditModal(category)"
                                            class="bg-blue-500 text-white"
                                            >Modifier</Button
                                        >
                                        <Button
                                            @click="deleteCategory(category.id)"
                                            class="bg-red-500 text-white ml-2"
                                            >Supprimer</Button
                                        >
                                    </TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    </div>
                </div>
            </div>
        </div>

        <CreateCategory 
            v-if="showCreateModal" 
            v-model:show="showCreateModal"
            @category-created="handleCategoryCreated" 
        />
        
        <EditCategory 
            v-if="showEditModal" 
            v-model:show="showEditModal"
            :category="selectedCategory"
            @category-edited="handleCategoryEdited"
        />
    </AuthenticatedLayout>
</template>
