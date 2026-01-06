<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import SimpleTable from '@kikiloaw/simple-table';
import { ref } from 'vue';

// 1. Initialize columns as empty array
const columns = ref([]);
const isLoadingHeaders = ref(true);

// 2. Handler for when data (and columns) are fetched
const handleDataFetched = (response) => {
    // Check if backend provided columns
    if (response.columns && Array.isArray(response.columns)) {
        columns.value = response.columns;
        isLoadingHeaders.value = false;
    }
}
</script>

<template>
    <AppLayout title="Dynamic Columns - SimpleTable">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                SimpleTable Examples
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium">Dynamic Columns from Backend</h3>
                        <span v-if="isLoadingHeaders" class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">
                            Waiting for column definitions...
                        </span>
                        <span v-else class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">
                            Columns Loaded
                        </span>
                    </div>

                    <p class="text-gray-500 mb-6">
                        In this example, the <code>columns</code> prop starts empty. The backend response includes a <code>columns</code> array alongside the <code>data</code>.
                        We capture this in the <code>@fetched</code> event and update the table columns dynamically.
                    </p>

                    <div class="border p-5 rounded-lg mb-8">
                        <!-- 
                            We simply bind :columns="columns". 
                            Initially it is [], so the table renders with no headers.
                            Once data triggers @fetched, we update columns.
                        -->
                        <SimpleTable 
                            fetch-url="/docs/simple-table/dynamic-columns-data"
                            :columns="columns" 
                            :searchable="true"
                            @fetched="handleDataFetched"
                        >
                            <!-- We can still use slots if we know the column keys, 
                                 or use a dynamic slot approach if needed. 
                                 Here we assume we know 'status' might exist. 
                            -->
                             <template #cell-status="{ row }">
                                <span class="px-2 py-1 rounded text-xs font-semibold bg-gray-100">
                                    {{ row.status }}
                                </span>
                            </template>
                        </SimpleTable>
                    </div>

                    <!-- Documentation -->
                    <div class="bg-slate-900 text-slate-50 p-6 rounded-lg overflow-x-auto" v-pre>
                        <h4 class="text-sm font-bold uppercase text-slate-400 mb-2">Frontend Code (Vue)</h4>
<pre><code class="language-js">const columns = ref([]);

const handleFetched = (response) => {
    // Update columns if provided by backend
    if (response.columns) {
        columns.value = response.columns;
    }
}

// Template
&lt;SimpleTable 
    fetch-url="/api/data"
    :columns="columns"
    @fetched="handleFetched"
/&gt;</code></pre>

                        <h4 class="text-sm font-bold uppercase text-slate-400 mb-2 mt-6">Backend Code (Laravel)</h4>
<pre><code class="language-php">return response()->json([
    'data' => $rows,
    'columns' => [
        ['key' => 'id', 'label' => 'ID'],
        ['key' => 'name', 'label' => 'Name', 'sortable' => true],
        // ...
    ],
    'total' => 100,
    // ... standard pagination meta
]);</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
