<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import SimpleTable from '@/package/SimpleTable/src/SimpleTable.vue';
import { ref } from 'vue';

const columns = [
    { key: 'id', label: 'ID', width: '60px' },
    { key: 'name', label: 'Name' },
    { key: 'role', label: 'Role' },
    { key: 'department', label: 'Department' }, // We sort by this
    { key: 'status', label: 'Status' },
];

const showDebug = ref(false);
const rawData = ref(null);

// Transform: Inject Group Headers on the client side
const injectGroupHeaders = (rows) => {
    const result = [];
    let lastGroup = null;

    rows.forEach(row => {
        // Check group change (Department)
        if (row.department !== lastGroup) {
            result.push({
                _isGroupHeader: true,
                _groupTitle: row.department,
                _groupTitleClass: 'bg-indigo-50 text-indigo-700 font-bold'
            });
            lastGroup = row.department;
        }
        result.push(row);
    });

    return result;
};

const handleDataFetched = (data) => {
    rawData.value = data;
}
</script>

<template>
    <AppLayout title="Group Headers (Client Transform) - SimpleTable">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                SimpleTable Examples
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium mb-4">Group Headers using <code>before-render</code></h3>
                    <p class="text-gray-500 mb-6">
                        The API returns standard pure data rows. We use the <code>before-render</code> prop to inject group headers on the client side just before the table draws.
                        <br>
                        <strong>Note:</strong> We request the server to <em>sort by Department</em> so the grouping works correctly.
                        <br>
                        <button @click="showDebug = !showDebug" class="text-sm text-blue-600 underline mt-2 hover:text-blue-800">
                            {{ showDebug ? 'Hide' : 'Inspect' }} Raw API Response
                        </button>
                    </p>

                    <div v-if="showDebug" class="bg-gray-100 p-4 rounded mb-6 text-xs font-mono overflow-auto max-h-96 border">
                        <pre v-if="rawData">{{ JSON.stringify(rawData.data.slice(0, 5), null, 2) }} ... (truncated)</pre>
                        <span v-else class="text-gray-400">Loading data...</span>
                    </div>

                    <div class="border p-5 rounded-lg mb-8">
                        <SimpleTable 
                            fetch-url="/docs/simple-table/data"
                            :query-params="{ sort: 'department', order: 'asc' }"
                            :columns="columns" 
                            :searchable="true"
                            :per-page="100"
                            :before-render="injectGroupHeaders"
                            @fetched="handleDataFetched"
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
                        <h4 class="text-sm font-bold uppercase text-slate-400 mb-2">Client-Side Logic (Vue)</h4>
                        <p class="text-xs text-slate-400 mb-4">The `injectGroupHeaders` function processes the rows array.</p>
<pre><code class="language-javascript">const injectGroupHeaders = (rows) => {
    const result = [];
    let lastGroup = null;

    rows.forEach(row => {
        if (row.department !== lastGroup) {
            result.push({
                _isGroupHeader: true,
                _groupTitle: row.department,
                _groupTitleClass: 'bg-indigo-50 text-indigo-700'
            });
            lastGroup = row.department;
        }
        result.push(row);
    });

    return result;
};

// Pass to component
// &lt;SimpleTable :before-render="injectGroupHeaders" ... /&gt;</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
