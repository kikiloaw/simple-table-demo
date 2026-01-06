<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { ref } from 'vue';
import FahadSelect from 'fahad-select';
import 'fahad-select/dist/style.css';

const selectedUser = ref(null);
const selectedUsers = ref([]);
const selectedItemGrouped = ref(null);
const selectedItemsGrouped = ref([]);
const selectedCar = ref(null);

// Static options example if supported
const staticValue = ref(null);
const staticOptions = [
    { id: 1, name: 'Option 1' },
    { id: 2, name: 'Option 2' },
    { id: 3, name: 'Option 3' },
];

const apiUrl = window.location.pathname.replace(/\/$/, '') + '/users';
const itemsUrl = window.location.pathname.replace(/\/$/, '') + '/clearance-items-grouped';
const carsUrl = window.location.pathname.replace(/\/$/, '') + '/cars';
</script>

<template>
    <AppLayout title="Fahad Select Demo">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Fahad Select Examples
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                
                <!-- Single Select Example -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium mb-4">Single Select</h3>
                    <p class="text-gray-500 mb-6">
                        Standard single selection mode fetching data from the server.
                    </p>
                    
                    <div class="border p-4 rounded bg-gray-50">
                        <label class="block mb-2 text-sm font-bold text-gray-700">Select User</label>
                        <FahadSelect 
                            v-model="selectedUser"
                            :searchUrl="apiUrl"
                            label="name"
                            placeholder="Search users..."
                        />
                        <div class="mt-4 text-sm text-gray-600">
                            Selected: <code class="bg-gray-200 px-1 py-0.5 rounded">{{ selectedUser }}</code>
                        </div>
                    </div>
                </div>

                <!-- Multi Select Example -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium mb-4">Multi Select</h3>
                    <p class="text-gray-500 mb-6">
                        Multiple selection mode enabled by adding the <code>multiple</code> prop.
                    </p>

                    <div class="border p-4 rounded bg-gray-50">
                        <label class="block mb-2 text-sm font-bold text-gray-700">Select Users</label>
                        <FahadSelect 
                            v-model="selectedUsers"
                            :searchUrl="apiUrl"
                            label="name"
                            placeholder="Search multiple users..."
                            multiple
                        />
                    </div>
                </div>

                <!-- Single Select Grouped Example -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium mb-4">Single Select School Clearance</h3>
                    <p class="text-gray-500 mb-6">
                        Select a school liability/requirement grouped by Department/Office (e.g. Library, Registrar).
                    </p>

                    <div class="border p-4 rounded bg-gray-50">
                        <label class="block mb-2 text-sm font-bold text-gray-700">Select Clearance Requirement</label>
                        <FahadSelect 
                            v-model="selectedItemGrouped"
                            :searchUrl="itemsUrl"
                            label="label"
                            placeholder="Search liabilities (e.g. 'Book', 'Form 137')..."
                        />
                        <div class="mt-4 text-sm text-gray-600">
                            Selected: <code class="bg-gray-200 px-1 py-0.5 rounded">{{ selectedItemGrouped }}</code>
                        </div>
                    </div>
                </div>

                <!-- Multi Select Grouped Example -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium mb-4">Multi Select School Clearance</h3>
                    <p class="text-gray-500 mb-6">
                        Select multiple liabilities grouped by Department.
                    </p>

                    <div class="border p-4 rounded bg-gray-50">
                        <label class="block mb-2 text-sm font-bold text-gray-700">Select Clearance Requirements</label>
                        <FahadSelect 
                            v-model="selectedItemsGrouped"
                            :searchUrl="itemsUrl"
                            label="label"
                            placeholder="Search multiple liabilities..."
                            multiple
                        />
                        <div class="mt-4 text-sm text-gray-600">
                            Selected: <code class="bg-gray-200 px-1 py-0.5 rounded">{{ selectedItemsGrouped }}</code>
                        </div>
                    </div>
                </div>

                <!-- Pre-grouped Example -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium mb-4">Pre-grouped Data Structure</h3>
                    <p class="text-gray-500 mb-6">
                        Data already grouped from the server (e.g. nested structure).
                    </p>

                    <div class="border p-4 rounded bg-gray-50">
                        <label class="block mb-2 text-sm font-bold text-gray-700">Select Car</label>
                        <FahadSelect 
                            v-model="selectedCar"
                            :searchUrl="carsUrl"
                            label="label"
                            placeholder="Search cars..."
                        />
                        <div class="mt-4 text-sm text-gray-600">
                            Selected: <code class="bg-gray-200 px-1 py-0.5 rounded">{{ selectedCar }}</code>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
