<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Custom/Pagination.vue";
import {Head, Link} from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import {useSortingStore} from "@/stores/sorting";

const props = defineProps({
    receivers: {
        required: true,
        type: Object
    }
})

// sorting
const store = useSortingStore();
const sort = (column) => {
  store.sortValues(column);
  router.visit(`?column=${store.column}&type=${store.type}`);
};
</script>

<template>

    <Head title="Receivers">
        <title>
            Receivers
        </title>
    </Head>

    <AdminLayout>
        <div class="ml-4 md:ml-16">
            <div class="mt-16 mb-8 text-xl flex items-center justify-between">
                <div>
                    Receivers
                </div>
                <div class="text-sm">
                    Page: {{ props.receivers.current_page }}
                    | total: {{ props.receivers.total }}
                    | from: {{ props.receivers.from }},
                    to: {{ props.receivers.to }}
                </div>
            </div>


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3" scope="col" @click="sort('first_name')">
                            Name
                        </th>
                        <th class="px-6 py-3" scope="col" @click="sort('email')">
                            Email
                        </th>
                        <th class="px-6 py-3" scope="col" @click="sort('phone')">
                            Phone
                        </th>
                        <th class="px-6 py-3" scope="col" @click="sort('country')">
                            Country Code
                        </th>
                        <th class="px-6 py-3" scope="col" @click="sort('label')">
                            Bank
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="receiver in props.receivers.data" :key="receiver.id"
                        class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                            <Link :href="route('single.receiver.page', receiver.id)"
                                  class="text-blue-700 hover:text-blue-900 hover:underline">
                                {{ receiver.first_name }} {{ receiver.last_name }}
                            </Link>
                        </th>
                        <td class="px-6 py-4">
                            {{ receiver.email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ receiver.phone }}
                        </td>
                        <td class="px-6 py-4">
                            {{ receiver.country }}
                        </td>
                        <td class="px-6 py-4">
                            {{ receiver.bank.label }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <Pagination :links="props.receivers.links"/>
        </div>

    </AdminLayout>
</template>

<script>

export default {
    name: 'Receivers'
}
</script>
<style scoped>
th:not(:last-child) {
    cursor: pointer;
}
</style>
