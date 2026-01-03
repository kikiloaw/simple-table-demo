<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import SimpleTable from '@kikiloaw/simple-table';

const columns = [
    { key: 'id', label: 'ID', sortable: true, width: '60px' },
    { key: 'name', label: 'Name', sortable: true },
    { key: 'email', label: 'Email', sortable: true },
    { key: 'role', label: 'Role', sortable: true },
    { key: 'status', label: 'Status' },
    { key: 'created_at', label: 'Registered' },
];
</script>

<template>
    <AppLayout title="Server-Side Data - SimpleTable">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                SimpleTable Examples
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium mb-4">Server-Side Data</h3>
                    <p class="text-gray-500 mb-6">
                        Automatic fetching, searching, sorting, and pagination via API.
                        Simply provide the <code>fetch-url</code> prop.
                    </p>

                    <div class="border p-5 mb-8">
                        <!-- 
                            Note: We use the full route path for fetch-url.
                            Ensure your API returns { data: [], recordsTotal, recordsFiltered } 
                        -->
                        <SimpleTable 
                            fetch-url="/docs/simple-table/data"
                            :columns="columns" 
                            :searchable="true"
                            :per-page="10"
                            :page-sizes="[5, 10, 20]"
                        >
                            <template #cell-status="{ row }">
                                <span class="text-xs px-2 py-1 rounded bg-gray-100">
                                    {{ row.status }}
                                </span>
                            </template>
                        </SimpleTable>
                    </div>

                    <!-- Documentation -->
                    <div class="bg-slate-900 text-slate-50 p-6 rounded-lg overflow-x-auto" v-pre>
                        <h4 class="text-sm font-bold uppercase text-slate-400 mb-2">Code Example</h4>
<pre><code class="language-vue">&lt;SimpleTable 
    fetch-url="/api/users"
    :columns="columns"
    :searchable="true"
/&gt;</code></pre>
                        <div class="mt-4 text-sm text-slate-400">
                            <p class="mb-2 font-bold text-white">Expected API Response Format:</p>
<pre><code class="language-json">{
    "data": [...],
    "recordsTotal": 100,
    "recordsFiltered": 100
}</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
