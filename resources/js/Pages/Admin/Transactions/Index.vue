<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Custom/Pagination.vue";
import {Head, Link} from "@inertiajs/vue3";
import {useSortingStore} from "@/stores/sorting";

const props = defineProps({
    transactions: {
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
    <Head title="Transactions">
        <title>
            Transactions
        </title>
    </Head>

    <AdminLayout>
        <div class="ml-4 md:ml-8 mr-4 md:mr-8">
            <div class="mt-16 mb-8 text-xl flex items-center justify-between">
                <div>
                    Transactions
                </div>
                <div class="text-sm">
                    Page: {{ props.transactions.current_page }}
                    | total: {{ props.transactions.total }}
                    | from: {{ props.transactions.from }},
                    to: {{ props.transactions.to }}
                </div>
            </div>


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3" scope="col" @click="sort('created_at')">
                            Initialized
                        </th>
                        <th class="px-6 py-3" scope="col" @click="sort('user')">
                            Sender
                        </th>
                        <th class="px-6 py-3" scope="col" @click="sort('receiver')">
                            Receiver
                        </th>
                        <th class="px-6 py-3" scope="col" @click="sort('amount')">
                            Amount
                        </th>

                        <th class="px-6 py-3" scope="col" @click="sort('status')">
                            status
                        </th>
                        <th class="px-6 py-3" scope="col" @click="sort('type')">
                            type
                        </th>
                        <th class="px-6 py-3" scope="col" @click="sort('payment_status')">
                            Payment Status
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="transaction in props.transactions.data" :key="transaction.id"
                        class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ transaction.created_at }}
                        </td>
                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                            <Link :href="route('single.user.page', transaction.user.id)"
                                  class="text-blue-700 hover:text-blue-900 hover:underline">
                                {{ transaction.user.first_name }} {{ transaction.user.last_name }}
                                ({{ transaction.user.country }})
                            </Link>
                        </th>
                        <td class="px-6 py-4">
                            <Link :href="route('single.receiver.page', transaction.receiver.id)"
                                  class="text-blue-700 hover:text-blue-900 hover:underline">
                                {{ transaction.receiver.first_name }} {{ transaction.receiver.last_name }}
                                ({{ transaction.receiver.country }})
                            </Link>
                        </td>
                        <td class="px-6 py-4">
                            <Link :href="route('payment.intent.page', transaction.payment_intent.id)"
                                  class="text-blue-700 hover:text-blue-900 hover:underline">
                                {{ parseFloat(transaction.payment_intent.amount / 100).toFixed(2) }}
                                <span class="uppercase">
                                    ({{ transaction.payment_intent.currency }})
                                </span>
                            </Link>
                        </td>

                        <td class="px-6 py-4 capitalize">
                            {{ transaction.status.replaceAll('_', ' ') }}
                        </td>
                        <td class="px-6 py-4 capitalize">
                            {{ transaction.type.replaceAll('_', ' ') }}
                        </td>
                        <td class="px-6 py-4 capitalize">
                            {{ transaction.payment_status.replaceAll('_', ' ') }}
                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>

            <Pagination :links="props.transactions.links"/>
        </div>

    </AdminLayout>
</template>

<script>

export default {
    name: 'Transactions/Index'
}
</script>

<style scoped>
th:not(:last-child) {
    cursor: pointer;
}
</style>
