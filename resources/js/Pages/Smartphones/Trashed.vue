<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

defineProps({
    trashed_smartphones: Object
});
</script>

<template>
    <AppLayout title="Smartphones">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Trashed Smartphones
            </h2>
        </template>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                                    Type
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                                    Price
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                                    Stock
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-stone-50 border-b transition duration-300 ease-in-out hover:bg-stone-100"
                                                v-if="(trashed_smartphones.length > 0)"
                                                v-for="trashed_smartphone in trashed_smartphones"
                                                :key="trashed_smartphone.id">
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ trashed_smartphone.id }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ trashed_smartphone.type }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ trashed_smartphone.price }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ trashed_smartphone.stock }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    <Link :href="
                                                        route(
                                                            'smartphones.restore',
                                                            trashed_smartphone.id
                                                        )
                                                    ">
                                                    <PrimaryButton>
                                                        Restore
                                                    </PrimaryButton>
                                                    </Link>
                                                    <Link :href="
    route(
        'smartphones.destroy_permanent',
        trashed_smartphone.id
    )
                                                    ">
                                                    <DangerButton class="ml-4">
                                                        Permanently Remove
                                                    </DangerButton>
                                                    </Link>
                                                </td>
                                            </tr>
                                            <tr class="bg-stone-50 border-b transition duration-300 ease-in-out hover:bg-stone-100"
                                                v-else>
                                                <td colspan="5"
                                                    class="text-sm text-center text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    There is no trashed data available
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
