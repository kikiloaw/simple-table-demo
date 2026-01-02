<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import SimpleTable from '@/package/SimpleTable/src/SimpleTable.vue';

// Adding extra columns to force scrolling
const columns = [
    { key: 'id', label: 'ID (Fixed)', sortable: true, width: '80px', fixed: true },
    { key: 'name', label: 'Name (Fixed)', sortable: true, width: '180px', fixed: true },
    { key: 'email', label: 'Email', width: '250px' },
    { key: 'address', label: 'Address', width: '300px' }, 
    { key: 'phone', label: 'Phone', width: '200px' },
    { key: 'company', label: 'Company', width: '200px' },
    { key: 'role', label: 'Role', width: '150px' },
    { key: 'notes', label: 'Notes', width: '400px' },
    { key: 'status', label: 'Status' },
    { key: 'actions', label: 'Actions (Right Fixed)', fixed: true } // Auto-width!
];

// Generate static data
const enrichedUsers = Array.from({ length: 20 }, (_, i) => ({
    id: i + 1,
    name: `User ${i + 1}`,
    email: `user${i+1}@example.com`,
    address: '1234 Long Street Name, City, Country, Earth',
    phone: '+1 234 567 8900',
    company: 'Acme Corp International Ltd.',
    notes: 'This is a very long note to force the table to scroll horizontally so you can see the sticky columns in action.',
    role: 'User',
    status: 'Active'
}));
</script>

<template>
    <AppLayout title="Fixed Columns - SimpleTable">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                SimpleTable Examples
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium mb-4">Fixed Columns</h3>
                    <p class="text-gray-500 mb-6">
                        Sticky columns allow you to keep key information visible while scrolling.
                        <ul class="list-disc ml-5 mt-2 space-y-1">
                            <li><strong>Left Sticky:</strong> Use <code>fixed: true</code> on the first columns.</li>
                            <li><strong>Right Sticky:</strong> Use <code>fixed: true</code> on the last column.</li>
                            <li><strong>Auto-Width:</strong> Sticky columns typically need a defined <code>width</code>, but <code>table-auto</code> allows "Actions" to fit buttons automatically!</li>
                        </ul>
                    </p>

                    <div class="border p-5 mb-8">
                        <SimpleTable 
                            :data="enrichedUsers" 
                            :columns="columns" 
                        >
                             <template #cell-actions>
                                <button class="text-blue-600 hover:underline font-medium">Edit</button>
                                <span class="mx-2 text-gray-300">|</span>
                                <button class="text-red-600 hover:underline font-medium">Delete</button>
                             </template>
                        </SimpleTable>
                    </div>

                    <!-- Documentation -->
                    <div class="bg-slate-900 text-slate-50 p-6 rounded-lg overflow-x-auto" v-pre>
                        <h4 class="text-sm font-bold uppercase text-slate-400 mb-2">Code Example</h4>
<pre><code class="language-javascript">const columns = [
    // Left Sticky (explicit width recommended)
    { key: 'id', label: 'ID', width: '80px', fixed: true },
    
    // Middle Scrolling Columns
    { key: 'email', label: 'Email', width: '250px' },
    { key: 'notes', label: 'Notes', width: '400px' },
    
    // Right Sticky (Auto-width works for buttons!)
    { key: 'actions', label: 'Actions', fixed: true } 
];</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
