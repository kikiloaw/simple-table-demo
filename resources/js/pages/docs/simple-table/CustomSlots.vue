<script setup>
import { computed, ref } from 'vue';
import { Download, Trash2, Plus } from 'lucide-vue-next'; 
import AppLayout from '@/layouts/AppLayout.vue';
import SimpleTable from '@kikiloaw/simple-table';
import { Button } from '@/components/ui/button';

const columns = [
    { key: 'id', label: 'ID', sortable: true, width: '80px' },
    { key: 'avatar', label: 'Avatar', width: '80px' }, // Custom slot
    { key: 'name', label: 'Name', sortable: true },
    { key: 'email', label: 'Email', sortable: true },
    { key: 'role', label: 'Role' },
    { key: 'status', label: 'Status' }, // Custom slot (badges)
    { key: 'actions', label: 'Actions' } // Custom slot
];

const data = Array.from({ length: 5 }, (_, i) => ({
    id: i + 1,
    name: `User ${i + 1}`,
    email: `user${i+1}@example.com`,
    role: i % 2 === 0 ? 'Admin' : 'User',
    status: i % 3 === 0 ? 'Active' : 'Inactive',
    avatar: `https://i.pravatar.cc/150?u=${i}`
}));

const getRoleColor = (role) => {
    switch (role) {
        case 'Admin': return 'bg-purple-100 text-purple-700';
        case 'Editor': return 'bg-blue-100 text-blue-700';
        default: return 'bg-gray-100 text-gray-700';
    }
};

const getStatusColor = (status) => {
    return status === 'Active' 
        ? 'bg-green-100 text-green-700 border-green-200' 
        : 'bg-red-100 text-red-700 border-red-200';
};

const handleExport = (format, rows) => {
    alert(`Exporting ${rows.length} rows as ${format.toUpperCase()}...`);
};

const handleBulkDelete = (rows) => {
    if (confirm(`Are you sure you want to delete ${rows.length} items?`)) {
        alert('Deleted!');
    }
};
</script>

<template>
    <AppLayout title="Custom Slots - SimpleTable">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                SimpleTable Examples
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium mb-4">Custom Slots & Actions</h3>
                    <p class="text-gray-500 mb-6">
                        Use cell slots for data rendering and the <code>#actions</code> slot for table-level operations (exports, bulk actions).
                    </p>

                    <div class="border p-5 rounded-lg mb-8">
                        <SimpleTable 
                            :data="data" 
                            :columns="columns" 
                        >    <!-- Table Level Actions (Top Right) -->
                            <template #actions="{ rows }">
                                <div class="flex gap-2">
                                    <Button variant="outline" size="sm" @click="handleExport('csv', rows)">
                                        <Download class="mr-2 h-4 w-4" />
                                        Export CSV
                                    </Button>
                                    
                                    <Button variant="destructive" size="sm" @click="handleBulkDelete(rows)">
                                        <Trash2 class="mr-2 h-4 w-4" />
                                        Batch Delete
                                    </Button>
                                </div>
                            </template>

                            <!-- Avatar Column -->
                            <template #cell-avatar="{ row }">
                                <img :src="row.avatar" alt="Avatar" class="w-8 h-8 rounded-full bg-gray-200" />
                            </template>

                            <!-- Custom User Column -->
                            <template #cell-name="{ row }">
                                <div>
                                    <div class="font-medium">{{ row.name }}</div>
                                    <div class="text-xs text-gray-400">{{ row.email }}</div>
                                </div>
                            </template>

                            <!-- Role Badge -->
                            <template #cell-role="{ row }">
                                <span 
                                    class="px-2 py-1 rounded text-xs font-semibold"
                                    :class="getRoleColor(row.role)"
                                >
                                    {{ row.role }}
                                </span>
                            </template>

                            <!-- Status Badge -->
                            <template #cell-status="{ row }">
                                <span 
                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium border"
                                    :class="getStatusColor(row.status)"
                                >
                                    {{ row.status }}
                                </span>
                            </template>

                            <!-- Row Actions -->
                            <template #cell-actions="{ row }">
                                <div class="flex items-center gap-2">
                                    <Button variant="ghost" size="sm" class="h-8 px-2">
                                        View
                                    </Button>
                                </div>
                            </template>

                        </SimpleTable>
                    </div>

                    <!-- Documentation -->
                    <div class="bg-slate-900 text-slate-50 p-6 rounded-lg overflow-x-auto" v-pre>
                        <h4 class="text-sm font-bold uppercase text-slate-400 mb-2">Code Example</h4>
<pre><code class="language-vue">&lt;SimpleTable :data="users" :columns="columns"&gt;
    <!-- Top Actions Bar -->
    &lt;template #actions="{ rows }"&gt;
        &lt;Button @click="export(rows)"&gt;
            &lt;Download class="mr-2 h-4 w-4" /&gt; Export
        &lt;/Button&gt;
    &lt;/template&gt;

    <!-- Custom Cell Rendering -->
    &lt;template #cell-status="{ row }"&gt;
        &lt;span :class="..."&gt;{{ row.status }}&lt;/span&gt;
    &lt;/template&gt;
&lt;/SimpleTable&gt;</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
