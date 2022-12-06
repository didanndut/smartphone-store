<script setup>
import { ref, onMounted } from 'vue';
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import TextInput from "@/Components/TextInput.vue";

const search = ref(null);

const onSearch = (search) => {
    location.href = `/brands?search=${search}`;
}

defineProps({
    brands: Object
});

onMounted(() => {
    const params = new URLSearchParams(window.location.search);
    const searchQuery = params.get('search');
    search.value = searchQuery;
});
</script>

<template>
    <AppLayout title="Brands">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Brand Management
            </h2>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full flex">
                    <div class="w-1/2">
                        <Link :href="route('brands.create')">
                        <PrimaryButton>
                            Add New Brand
                        </PrimaryButton>
                        </Link>
                        <Link :href="route('brands.trashed')">
                        <PrimaryButton class="ml-4">
                            Trashed Brand
                        </PrimaryButton>
                        </Link>
                    </div>
                    <div class="w-1/2">
                        <TextInput id="search" type="text" class="block w-full" placeholder="Search Brand..."
                            v-model="search" @keyup.enter="onSearch(search)" />
                    </div>
                </div>
                <div class="bg-stone-200 overflow-hidden shadow-xl sm:rounded-lg mt-8">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full">
                                        <thead class="bg-stone-200 border-b">
                                            <tr>
                                                <th scope="col"
                                                    class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                                    ID
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                                    Brand Name
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-stone-50 border-b transition duration-300 ease-in-out hover:bg-stone-100"
                                                v-if="(brands.length > 0)" v-for="brand in brands"
                                                :key="brand.id">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ brand.id }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ brand.name }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    <Link :href="
                                                        route(
                                                            'brands.edit',
                                                            brand.id
                                                        )
                                                    ">
                                                    <PrimaryButton>
                                                        Edit
                                                    </PrimaryButton>
                                                    </Link>
                                                    <Link :href="
    route(
        'brands.destroy',
        brand.id
    )
                                                    ">
                                                    <DangerButton class="ml-4">
                                                        Remove
                                                    </DangerButton>
                                                    </Link>
                                                </td>
                                            </tr>
                                            <tr class="bg-stone-50 border-b transition duration-300 ease-in-out hover:bg-stone-100"
                                                v-else>
                                                <td colspan="3"
                                                    class="text-sm text-center text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    There is no data available
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
