<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import SimpleTable from '@/package/SimpleTable/src/SimpleTable.vue';
import { ref } from 'vue';

const columns = [
    { key: 'id', label: 'ID', width: '60px' },
    { key: 'name', label: 'Name' },
    { key: 'department', label: 'Department' },
    { key: 'email', label: 'Email' },
    { key: 'status', label: 'Status' },
];

const showDebug = ref(false);
const rawData = ref(null);

const handleDataFetched = (data) => {
    rawData.value = data;
}
</script>

<template>
    <AppLayout title="Group Headers (Server) - SimpleTable">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                SimpleTable Examples
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium mb-4">Server-Side Group Headers (Response Injection)</h3>
                    <p class="text-gray-500 mb-6">
                        Data is grouped by <strong>Department</strong> on the server. The backend actually inserts the header objects into the JSON response array.
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
                            fetch-url="/docs/simple-table/data-grouped"
                            :columns="columns" 
                            :searchable="true"
                            :per-page="100"
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
                        <h4 class="text-sm font-bold uppercase text-slate-400 mb-2">Backend Logic (PHP)</h4>
                        <p class="text-xs text-slate-400 mb-4">The API response includes the headers.</p>
<pre><code class="language-php">// 1. Sort by Grouping Key (Department)
$query = $query->sortBy('department');

$chunk = $query->forPage($page, $perPage);

foreach ($chunk as $item) {
    if ($item['department'] !== $lastGroup) {
        $resultWithHeaders[] = [
            '_isGroupHeader' => true, 
            '_groupTitle' => $item['department'],
            '_groupTitleClass' => 'bg-blue-50 text-blue-700'
        ];
        $lastGroup = $item['department'];
    }
    $resultWithHeaders[] = $item;
}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
