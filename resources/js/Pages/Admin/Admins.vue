<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Custom/Pagination.vue";
import {Head} from '@inertiajs/vue3';

const props = defineProps({
    admins: {
        required: true,
        type: Object
    }
})

</script>

<template>
    <Head title="Admins">
        <title>
            Admins
        </title>
    </Head>
    <AdminLayout>
        <div class="ml-4 md:ml-16">
            <div class="mt-16 mb-8 text-xl flex items-center justify-between">
                <div>
                    Admins
                </div>
                <div class="text-sm">
                    Page: {{ props.admins.current_page }}
                    | total: {{ props.admins.total }}
                    | from: {{ props.admins.from }},
                    to: {{ props.admins.to }}
                </div>
            </div>


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3" scope="col">
                            Name
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Email
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Phone
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Country Code
                        </th>
                        <th class="px-6 py-3" scope="col">
                            IP Address
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Role
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="admin in props.admins.data" :key="admin.id"
                        class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                            {{ admin.first_name }} {{ admin.last_name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ admin.email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ admin.phone }}
                        </td>
                        <td class="px-6 py-4">
                            {{ admin.country }}
                        </td>
                        <td class="px-6 py-4">
                            {{ admin.ip_address }}
                        </td>
                        <td class="px-6 py-4">
                            {{ admin.role }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <Pagination :links="props.admins.links"/>
        </div>

    </AdminLayout>
</template>

<script>

export default {
    name: 'Admins'
}
</script>
