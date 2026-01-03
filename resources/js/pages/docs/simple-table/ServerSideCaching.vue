<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import SimpleTable from '@kikiloaw/simple-table';
import { ref } from 'vue';

const columns = [
    { key: 'id', label: 'ID', width: '60px' },
    { key: 'name', label: 'Name' },
    { key: 'email', label: 'Email' },
    { key: 'role', label: 'Role' },
    { key: 'created_at', label: 'Created At' },
];

const tableRef = ref(null);

const handleClearCache = () => {
    if (tableRef.value) {
        tableRef.value.clearCache();
        tableRef.value.fetchData();
        // We use fetchData() to reload current view. refresh() would reset to page 1.
    }
};
</script>

<template>
    <AppLayout title="Server-Side Caching - SimpleTable">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                SimpleTable Examples
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium">Server-Side Caching</h3>
                        <button
                            @click="handleClearCache"
                            class="px-3 py-1 text-xs font-semibold uppercase tracking-wider text-red-600 border border-red-200 bg-red-50 hover:bg-red-100 rounded transition-colors"
                        >
                            Clear Cache & Refresh
                        </button>
                    </div>

                    <p class="text-gray-500 mb-6">
                        This table uses <code>enable-cache</code> and <code>cache-ttl="30000"</code> (30 seconds).
                        <br>
                        Requests for the same page/sort/search will be served from client-side cache until it expires.
                        Open your Network tab to verify that repeated actions don't trigger new API calls.
                    </p>

                    <div class="border p-5 rounded-lg mb-8">
                        <SimpleTable
                            ref="tableRef"
                            fetch-url="/docs/simple-table/data"
                            :columns="columns"
                            :searchable="true"
                            :per-page="10"
                            :enable-cache="true"
                            :cache-ttl="30000"
                        />
                        <p class="text-xs text-muted-foreground mt-2">
                            <em>Try navigating to page 2, then back to page 1. The request indicator won't spin the second time!</em>
                        </p>
                    </div>

                    <!-- Documentation -->
                    <div class="bg-slate-900 text-slate-50 p-6 rounded-lg overflow-x-auto" v-pre>
                        <h4 class="text-sm font-bold uppercase text-slate-400 mb-2">Code Example</h4>
<pre><code class="language-vue">&lt;SimpleTable 
    fetch-url="/api/users"
    :columns="columns"
    :enable-cache="true"
    :cache-ttl="60" 
/&gt;</code></pre>
                        <div class="mt-4 text-sm text-slate-400">
                            <ul class="list-disc ml-5 space-y-1">
                                <li><code>enable-cache</code>: Boolean. Turns on the response cache.</li>
                                <li><code>cache-ttl</code>: Number (Seconds). How long to keep data valid (Default: 300s).</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
