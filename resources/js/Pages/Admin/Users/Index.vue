<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Custom/Pagination.vue";
import {Head, Link} from '@inertiajs/vue3';

const props = defineProps({
    users: {
        required: true,
        type: Object
    }
})

</script>

<template>

    <Head title="Users">
        <title>
            Users
        </title>
    </Head>

    <AdminLayout>
        <div class="ml-4 md:ml-16">
            <div class="mt-16 mb-8 text-xl flex items-center justify-between">
                <div>
                    Users
                </div>
                <div class="text-sm">
                    Page: {{ props.users.current_page }}
                    | total: {{ props.users.total }}
                    | from: {{ props.users.from }},
                    to: {{ props.users.to }}
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
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in props.users.data" :key="user.id"
                        class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                            <Link :href="route('single.user.page', user.id)"
                                  class="text-blue-700 hover:text-blue-900 hover:underline">
                                {{ user.first_name }} {{ user.last_name }}
                            </Link>
                        </th>
                        <td class="px-6 py-4">
                            {{ user.email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ user.phone }}
                        </td>
                        <td class="px-6 py-4">
                            {{ user.country }}
                        </td>
                        <td class="px-6 py-4">
                            {{ user.ip_address }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <Pagination :links="props.users.links"/>
        </div>

    </AdminLayout>
</template>

<script>

export default {
    name: 'Users'
}
</script>
