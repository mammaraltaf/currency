<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Custom/Pagination.vue";
import { Head } from '@inertiajs/vue3';
import CreateCountry from "@/Pages/Admin/Countries/partials/CreateCountry.vue";
import EditCountry from "@/Pages/Admin/Countries/partials/EditCountry.vue";
import { reactive, ref } from "vue";
import { useAPI } from "@/Composables/useAPI";
import { useNotificationStore } from "@/stores/notification";
import EditIcon from "@/Icons/EditIcon.vue";
import Spinner from "@/Components/Custom/Spinner.vue";
import { router } from '@inertiajs/vue3'
import {useSortingStore} from "@/stores/sorting";

const api = useAPI();
const notification = useNotificationStore();

const props = defineProps({
    countries: {
        required: true,
        type: Object
    },
    currencies: {
        type: Array,
        required: true
    }
})


// Adding
const countryAdded = () => {
    props.countries.total++;
}

const editedCountry = reactive({});

// Editing
const edit = (country) => {
    editedCountry.value = country;
}
const endEdit = () => {
    editedCountry.value = {}
}

const countryEdited = (country) => {
    console.log('edited')
    let index = props.countries.data.findIndex(oldInfo => oldInfo.id === country.id);
    props.countries.data.splice(index, 1, country);
}

// sorting
const store = useSortingStore();
const sort = (column) => {
  store.sortValues(column);
  router.visit(`?column=${store.column}&type=${store.type}`);
};
</script>

<template>
    <Head title="Countries">
        <title>
            Countries
        </title>
    </Head>

    <AdminLayout>
        <div class="ml-4 md:ml-16">
            <div class="mt-16 mb-8 text-xl flex items-center justify-between">
                <div>
                    Countries
                </div>
                <div class="text-sm">
                    Page: {{ props.countries.current_page }}
                    | total: {{ props.countries.total }}
                    | from: {{ props.countries.from }},
                    to: {{ props.countries.to }}
                </div>
            </div>

            <CreateCountry :currencies="currencies" />

            <EditCountry v-if="editedCountry.value?.id" @endEdit="endEdit" @countryEdited="countryEdited"
                :edited-country="editedCountry" :currencies="currencies" />

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3" scope="col" @click="sort('id')">
                                #ID
                            </th>
                            <th class="px-6 py-3" scope="col" @click="sort('label')">
                                Country Name
                            </th>
                            <th class="px-6 py-3" scope="col" @click="sort('name')">
                                Currency
                            </th>
                            <th class="px-6 py-3" scope="col" @click="sort('can_send')">
                                Sending Countries
                            </th>
                            <th class="px-6 py-3" scope="col" @click="sort('can_receive')">
                                Receiving Countries
                            </th>
                            <th class="px-6 py-3" scope="col">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="country in props.countries.data" :key="country.id" v-show="country.id !== 'deleted'"
                            class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                                {{ country.id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ country.label }} ({{ country.code }})
                            </td>
                            <td class="px-6 py-4">
                                {{ country.currency.name }} ({{ country.currency.code }})
                            </td>
                            <td class="px-6 py-4">
                                {{ country.can_send }}
                            </td>
                            <td class="px-6 py-4">
                                {{ country.can_receive }}
                            </td>
                            <td class="px-6 py-4 flex gap-4 items-center">
                                <EditIcon @click="edit(country)"
                                    class="w-8 hover:cursor-pointer hover:bg-blue-600 hover:text-white rounded-md p-1" />

                                <Spinner v-if="api.isLoading.value && deletingCountryId === country.id"
                                    class="button-spinner-center action-btn" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <Pagination :links="props.countries.links" />
        </div>

    </AdminLayout>
</template>

<script>

export default {
    name: 'Countries'
}
</script>
<style scoped>
th:not(:last-child) {
    cursor: pointer;
}
</style>
