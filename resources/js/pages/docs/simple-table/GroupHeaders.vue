<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import SimpleTable from '@kikiloaw/simple-table';

const columns = [
    { key: 'id', label: 'ID', width: '60px' },
    { key: 'name', label: 'Name' },
    { key: 'role', label: 'Role' },
    { key: 'email', label: 'Email' },
];

const data = [
    { _isGroupHeader: true, _groupTitle: 'Admins', _groupTitleClass: 'bg-indigo-50 text-indigo-700' },
    { id: 1, name: 'John Doe', role: 'Admin', email: 'john@example.com' },
    { id: 4, name: 'Alice Williams', role: 'Admin', email: 'alice@example.com' },
    
    { _isGroupHeader: true, _groupTitle: 'Users', _groupTitleClass: 'bg-green-50 text-green-700' },
    { id: 2, name: 'Jane Smith', role: 'User', email: 'jane@example.com' },
];
</script>

<template>
    <AppLayout title="Group Headers - SimpleTable">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                SimpleTable Examples
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium mb-4">Group Headers</h3>
                    <p class="text-gray-500 mb-6">
                        Insert objects with <code>_isGroupHeader: true</code> and <code>_groupTitle</code> into your data array to create divider rows.
                    </p>

                    <div class="border p-5 rounded-lg mb-8">
                        <SimpleTable 
                            :data="data" 
                            :columns="columns"
                        />
                    </div>

                    <!-- Documentation -->
                    <div class="bg-slate-900 text-slate-50 p-6 rounded-lg overflow-x-auto" v-pre>
                        <h4 class="text-sm font-bold uppercase text-slate-400 mb-2">Data Structure Example</h4>
<pre><code class="language-javascript">const data = [
    // Group Header 1
    { _isGroupHeader: true, _groupTitle: 'Engineering Dept' },
    { id: 1, name: 'Alice', role: 'Dev' },
    { id: 2, name: 'Bob', role: 'Dev' },

    // Group Header 2
    { _isGroupHeader: true, _groupTitle: 'HR Dept' },
    { id: 3, name: 'Charlie', role: 'HR' },
];</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
