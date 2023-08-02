<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Custom/Pagination.vue";
import {Head, Link} from "@inertiajs/vue3";

const props = defineProps({
    posts: {
        required: true,
        type: Object
    }
})

</script>

<template>
    <Head title="Posts">
        <title>
            Posts
        </title>
    </Head>

    <AdminLayout>
        <div class="ml-4 md:ml-8 mr-4 md:mr-8">
            <div class="mt-16 mb-8 text-xl flex items-center justify-between">
                <div>
                    Posts
                </div>
                <div class="text-sm">
                    Page: {{ props.posts.current_page }}
                    | total: {{ props.posts.total }}
                    | from: {{ props.posts.from }},
                    to: {{ props.posts.to }}
                </div>
            </div>


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3" scope="col">
                            Initialized
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Status
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Country from
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Country To
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Amount
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Direct Transaction Reference
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="post in props.posts.data" :key="post.id"
                        class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ post.created_at }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                            {{ post.status }}
                        </td>
                        <td class="px-6 py-3" scope="col">
                            <p>
                                {{ post.transaction.user.country }}
                            </p>
                            <p>
                                <Link :href="route('single.user.page', post.transaction.user.id)"
                                      class="text-blue-700 hover:text-blue-900 hover:underline"
                                >
                                    (View sender)
                                </Link>
                            </p>
                        </td>
                        <td class="px-6 py-3" scope="col">
                            <p>
                                {{ post.transaction.receiver.country }}
                            </p>
                            <p>
                                <Link :href="route('single.receiver.page', post.transaction.receiver.id)"
                                      class="text-blue-700 hover:text-blue-900 hover:underline"
                                >
                                    (View receiver)
                                </Link>
                            </p>
                        </td>
                        <td class="px-6 py-3" scope="col">
                            <p>
                                {{ parseFloat(post.transaction.payment_intent.amount / 100).toFixed(2) }}
                                <span class="uppercase">
                                    ({{ post.transaction.payment_intent.currency }})
                            </span>
                            </p>

                            <Link :href="route('payment.intent.page', post.transaction.payment_intent.id)"
                                  class="text-blue-700 hover:text-blue-900 hover:underline">
                                (View Payment Intent)
                            </Link>
                        </td>
                        <td class="px-6 py-3 uppercase" scope="col">
                            #{{ post.transaction.id }}
                        </td>
                        <td class="px-6 py-3" scope="col">
                            Coming soon...
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <Pagination :links="props.posts.links"/>
        </div>

    </AdminLayout>
</template>

<script>

export default {
    name: 'Posts/Index'
}
</script>
