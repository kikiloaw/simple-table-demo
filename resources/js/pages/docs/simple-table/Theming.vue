<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import SimpleTable from '@kikiloaw/simple-table';

const columns = [
    { key: 'id', label: 'ID', sortable: true, width: '80px' },
    { key: 'name', label: 'Name', sortable: true },
    { key: 'role', label: 'Role' },
    { key: 'status', label: 'Status' },
];

const data = [
    { id: 1, name: 'John Doe', role: 'Admin', status: 'Active' },
    { id: 2, name: 'Jane Smith', role: 'User', status: 'Inactive' },
    { id: 3, name: 'Bob Johnson', role: 'Editor', status: 'Active' },
    { id: 4, name: 'Alice Williams', role: 'User', status: 'Active' },
    { id: 5, name: 'Charlie Brown', role: 'Admin', status: 'Active' },
];
</script>

<template>
    <AppLayout title="Theming - SimpleTable">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                SimpleTable Examples
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium mb-4">Theming & Colors</h3>
                    <p class="text-gray-500 mb-6">
                        Customize the row colors using Tailwind CSS classes.
                    </p>

                    <!-- Example 1: Blue Theme -->
                    <h4 class="font-medium mb-3">Blue Theme</h4>
                    <div class="border p-5 rounded-lg mb-8">
                        <SimpleTable 
                            :data="data" 
                            :columns="columns"
                            odd-row-color="bg-blue-50/50"
                            even-row-color="bg-white"
                            hover-color="hover:bg-blue-100"
                        />
                    </div>

                     <!-- Example 2: Darker Striping -->
                    <h4 class="font-medium mb-3">High Contrast</h4>
                    <div class="border p-5 rounded-lg mb-8">
                        <SimpleTable 
                            :data="data" 
                            :columns="columns"
                            odd-row-color="bg-zinc-100"
                            even-row-color="bg-white"
                            hover-color="hover:bg-zinc-200"
                        />
                    </div>

                    <!-- Example 3: Pink Theme & Custom Pagination -->
                    <h4 class="font-medium mb-3">Custom Pagination Color (Pink)</h4>
                    <div class="border p-5 rounded-lg mb-8">
                        <SimpleTable 
                            :data="data" 
                            :columns="columns"
                            odd-row-color="bg-pink-50/50"
                            even-row-color="bg-white"
                            hover-color="hover:bg-pink-100"
                            pagination-color="#ec4899"
                            :per-page="2"
                        />
                    </div>

                    <!-- Documentation -->
                    <div class="bg-slate-900 text-slate-50 p-6 rounded-lg overflow-x-auto" v-pre>
                        <h4 class="text-sm font-bold uppercase text-slate-400 mb-2">Code Example</h4>
<pre><code class="language-vue">&lt;SimpleTable 
    :data="users" 
    :columns="columns"
    odd-row-color="bg-pink-50/50"
    pagination-color="#ec4899"
/&gt;</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
