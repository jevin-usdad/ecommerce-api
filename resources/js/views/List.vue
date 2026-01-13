<template>
    <section>
        <Topbar />

        <!-- SIDEBAR -->
        <aside class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 bg-[#250f4f]">
            <ul class="space-y-2 px-3">
                <li>
                    <router-link to="/list" class="flex items-center p-2 text-gray-200 rounded-lg hover:bg-[#432b73]">
                        <span class="ml-3">Sellers</span>
                    </router-link>
                </li>
            </ul>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="p-4 sm:ml-64 mt-20">
            <!-- HEADER -->
            <div class="bg-white p-4 rounded-lg mb-4">
                <h3 class="text-lg font-semibold">Seller List</h3>
            </div>

            <!-- TABLE CARD -->
            <div class="bg-white p-4 rounded-lg">
                <div class="flex justify-end mb-4">
                    <router-link to="/stepperform"
                        class="rounded-lg px-4 py-2 bg-green-700 text-white hover:bg-green-800">
                        Add Seller
                    </router-link>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-center text-xs font-semibold">#</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold">Name</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold">Email</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold">Mobile</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold">Country</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold">State</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            <tr v-for="(seller, index) in sellers" :key="seller.id">
                                <td class="px-6 py-4 text-center text-sm">
                                    {{ index + 1 }}
                                </td>
                                <td class="px-6 py-4 text-center text-sm">
                                    {{ seller.name }}
                                </td>
                                <td class="px-6 py-4 text-center text-sm">
                                    {{ seller.email }}
                                </td>
                                <td class="px-6 py-4 text-center text-sm">
                                    {{ seller.mobile_no }}
                                </td>
                                <td class="px-6 py-4 text-center text-sm">
                                    {{ seller.country }}
                                </td>
                                <td class="px-6 py-4 text-center text-sm">
                                    {{ seller.state }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button class="text-red-600 hover:text-red-800" @click="deleteSeller(seller.id)">
                                        🗑
                                    </button>
                                </td>
                            </tr>

                            <tr v-if="!loading && sellers.length === 0">
                                <td colspan="7" class="text-center py-4 text-gray-500">
                                    No sellers found
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- LOADING -->
                <div v-if="loading" class="text-center py-4">
                    Loading sellers...
                </div>
            </div>
        </main>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../services/api';
import Topbar from '../components/Topbar.vue';

const sellers = ref([]);
const loading = ref(false);

const fetchSellers = async () => {
    loading.value = true;
    try {
        const res = await api.get('/admin/sellers');
        sellers.value = res.data.data.data;
    } catch (e) {
        console.error('Failed to load sellers');
    } finally {
        loading.value = false;
    }
};

const deleteSeller = (id) => {
    alert(`Delete seller ID: ${id}`);
};

onMounted(fetchSellers);
</script>
