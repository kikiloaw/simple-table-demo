<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import SimpleTable from '@kikiloaw/simple-table';

const columns = [
    { key: 'id', label: 'ID', width: '60px' },
    { key: 'name', label: 'Name' },
    { key: 'email', label: 'Email' },
    { key: 'role', label: 'Role' },
];

const data = [
    { id: 1, name: 'John Doe', email: 'john@example.com', role: 'Admin' },
    { id: 2, name: 'Jane Smith', email: 'jane@example.com', role: 'User' },
    { id: 3, name: 'Bob Johnson', email: 'bob@example.com', role: 'Editor' },
];
</script>

<template>
    <AppLayout title="Basic Usage - SimpleTable">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                SimpleTable Examples
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- DocsNav Removed -->

                <!-- Example -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium mb-4">Basic Usage</h3>
                    <p class="text-gray-500 mb-6">
                        The most basic implementation using static data passed via the <code>:data</code> prop.
                    </p>

                    <div class="border  mb-8 p-3">
                        <SimpleTable 
                            :data="data" 
                            :columns="columns" 
                        />
                    </div>

                    <!-- Documentation -->
                    <div class="bg-slate-900 text-slate-50 p-6 rounded-lg overflow-x-auto" v-pre>
                        <h4 class="text-sm font-bold uppercase text-slate-400 mb-2">Code Example</h4>
<pre><code class="language-vue">&lt;script setup&gt;
// Define columns
const columns = [
    { key: 'id', label: 'ID', sortable: true, width: '80px' },
    { key: 'name', label: 'Name', sortable: true },
    { key: 'email', label: 'Email', sortable: true },
    { key: 'role', label: 'Role' },
];
&lt;/script&gt;

&lt;template&gt;
    &lt;SimpleTable 
        :data="users" 
        :columns="columns" 
    /&gt;
&lt;/template&gt;</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
