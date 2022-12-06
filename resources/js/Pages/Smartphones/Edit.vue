<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const osInput = ref(null);
const brandInput = ref(null);
const manufacturerInput = ref(null);
const typeInput = ref(null);
const priceInput = ref(null);
const stockInput = ref(null);
const os = ref(null);
const brand = ref(null);
const manufacturer = ref(null);

const form = useForm({
    os: null,
    brand: null,
    manufacturer: null,
    type: null,
    price: null,
    stock: null,
});

const updateData = (smartphone) => {
    form.os = os.value ? os.value.id : smartphone.operating_system_id;
    form.brand = brand.value ? brand.value.id : smartphone.brand_id;
    form.manufacturer = manufacturer.value ? manufacturer.value.id : smartphone.manufacturer_id;
    form.type = smartphone.type;
    form.price = smartphone.price;
    form.stock = smartphone.stock;
    form.put(route("smartphones.update", smartphone.id), {
        errorBag: "updateData",
        preserveScroll: true,
        onError: () => {
            if (form.errors.os) {
                form.reset("os");
                osInput.value.focus();
            }
            if (form.errors.brand) {
                form.reset("brand");
                brandInput.value.focus();
            }
            if (form.errors.manufacturer) {
                form.reset("manufacturer");
                manufacturerInput.value.focus();
            }
            if (form.errors.type) {
                form.reset("type");
                typeInput.value.focus();
            }
            if (form.errors.price) {
                form.reset("price");
                priceInput.value.focus();
            }
            if (form.errors.stock) {
                form.reset("stock");
                stockInput.value.focus();
            }
        },
    });
};

const chooseOS = (smartphoneOs) => {
    os.value = smartphoneOs;
};

const chooseBrand = (smartphoneBrand) => {
    brand.value = smartphoneBrand;
};

const chooseManufacturer = (smartphoneManufacturer) => {
    manufacturer.value = smartphoneManufacturer;
};

defineProps({
    operatingsystems: Object,
    brands: Object,
    manufacturers: Object,
    smartphone: Object,
});
</script>

<template>
    <AppLayout title="Smartphone">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Smartphone Management
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <FormSection @submitted="updateData(smartphone)">
                <template #title>Edit Smartphone</template>

                <template #description>
                    Edit a smartphone data.
                </template>

                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="os" value="Smartphone Operating System" />
                        <div class="dropdown relative mt-2 w-full">
                            <button ref="osInput"
                                class="dropdown-toggle w-full px-6 py-3 bg-stone-200 text-gray-800 font-medium text-sm leading-tight capitalize rounded shadow-md hover:bg-stone-300 hover:shadow-lg focus:bg-stone-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-stone-200 active:shadow-lg transition duration-150 ease-in-out flex items-center whitespace-nowrap"
                                type="button" id="os" data-bs-toggle="dropdown" aria-expanded="false">
                                {{
                                        os ? os.name : smartphone.operating_system_name
                                }}
                                <div class="w-full flex justify-end">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down"
                                        class="w-2 ml-2" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512">
                                        <path fill="currentColor"
                                            d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                        </path>
                                    </svg>
                                </div>
                            </button>
                            <ul class="dropdown-menu min-w-max absolute w-full bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none"
                                aria-labelledby="dropdown_os">
                                <li class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                                    v-for="operatingsystem in operatingsystems" @click="chooseOS(operatingsystem)">
                                    {{ operatingsystem.name }}
                                </li>
                            </ul>
                        </div>
                        <InputError :message="form.errors.os" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="brand" value="Smartphone Brand" />
                        <div class="dropdown relative mt-2 w-full">
                            <button ref="brandInput"
                                class="dropdown-toggle w-full px-6 py-3 bg-stone-200 text-gray-800 font-medium text-sm leading-tight capitalize rounded shadow-md hover:bg-stone-300 hover:shadow-lg focus:bg-stone-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-stone-200 active:shadow-lg transition duration-150 ease-in-out flex items-center whitespace-nowrap"
                                type="button" id="brand" data-bs-toggle="dropdown" aria-expanded="false">
                                {{
                                        brand ? brand.name : smartphone.brand_name
                                }}
                                <div class="w-full flex justify-end">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down"
                                        class="w-2 ml-2" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512">
                                        <path fill="currentColor"
                                            d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                        </path>
                                    </svg>
                                </div>
                            </button>
                            <ul class="dropdown-menu min-w-max absolute w-full bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none"
                                aria-labelledby="dropdown_brand">
                                <li class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                                    v-for="brand in brands" @click="chooseBrand(brand)">
                                    {{ brand.name }}
                                </li>
                            </ul>
                        </div>
                        <InputError :message="form.errors.brand" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="manufacturer" value="Smartphone Manufacturer" />
                        <div class="dropdown relative mt-2 w-full">
                            <button ref="manufacturerInput"
                                class="dropdown-toggle w-full px-6 py-3 bg-stone-200 text-gray-800 font-medium text-sm leading-tight capitalize rounded shadow-md hover:bg-stone-300 hover:shadow-lg focus:bg-stone-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-stone-200 active:shadow-lg transition duration-150 ease-in-out flex items-center whitespace-nowrap"
                                type="button" id="manufacturer" data-bs-toggle="dropdown" aria-expanded="false">
                                {{
                                        manufacturer ? manufacturer.name : smartphone.manufacturer_name
                                }}
                                <div class="w-full flex justify-end">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down"
                                        class="w-2 ml-2" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512">
                                        <path fill="currentColor"
                                            d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                        </path>
                                    </svg>
                                </div>
                            </button>
                            <ul class="dropdown-menu min-w-max absolute w-full bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none"
                                aria-labelledby="dropdown_brand">
                                <li class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                                    v-for="manufacturer in manufacturers" @click="chooseManufacturer(manufacturer)">
                                    {{ manufacturer.name }}
                                </li>
                            </ul>
                        </div>
                        <InputError :message="form.errors.manufacturer" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="type" value="Smartphone Type" />
                        <TextInput id="type" ref="typeInput" v-model="smartphone.type" type="text"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.type" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="price" value="Smartphone Price" />
                        <TextInput id="price" ref="priceInput" v-model="smartphone.price" type="number"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.price" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="stock" value="Smartphone Stock" />
                        <TextInput id="stock" ref="stockInput" v-model="smartphone.stock" type="number"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.stock" class="mt-2" />
                    </div>
                </template>

                <template #actions>
                    <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </ActionMessage>

                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </PrimaryButton>
                </template>
            </FormSection>
        </div>
    </AppLayout>
</template>