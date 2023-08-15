<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Edit from "@/Pages/Admin/Range/Edit.vue";
// import Add from "@/Pages/Admin/Range/Add.vue";

import Pagination from "@/Components/Custom/Pagination.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import Spinner from "@/Components/Custom/Spinner.vue";
import EditIcon from "@/Icons/EditIcon.vue";

import { ref, reactive, onMounted } from "vue";
import { useAPI } from "@/Composables/useAPI";
import { useNotificationStore } from "@/stores/notification";

import TextInput from "@/Components/TextInput.vue";

const api = useAPI();
const notification = useNotificationStore();
const props = defineProps({
    ranges: {
        required: true,
        type: Object
    },
})
// console.log('ranges', props.ranges);
// Adding
// const rangeAdded = (data) => {
//     // props.ranges.data.push(data.data);
//     props.ranges.data.unshift(data.data)
//     props.ranges.total++;

// }

// Editing:
const editingRange = reactive({});
var showEditDialog = ref(false);

var index = ref()
const edit = (range) => {
    editingRange.value = { ...range };
    index.value = props.ranges.data.findIndex(oldInfo => oldInfo.id === editingRange.value.id);
    console.log(' index.value', index.value);

    showEditDialog.value = true;
    Edit;
    return { showEditDialog, Edit };
}
function closeEditDialog($isFetchData) {
    console.log('closeEditDialog',$isFetchData);
    props.ranges.data.splice(index.value, 1, $isFetchData);
    showEditDialog.value = false;
    index.value = null

    return { showEditDialog };
}


const fetchingranges = ref(false);


</script>

<template>
    <Edit :show="showEditDialog" :rangeData="editingRange" v-if="showEditDialog"
        v-on:close="closeEditDialog($event)" />

    <Head title="Range Setting">
        <title>
            Range Setting
        </title>
    </Head>

    <AdminLayout>
        <div class="ml-4 md:ml-8 mr-4 md:mr-8">
            <div class="mt-16 mb-8 text-xl flex items-center justify-between">
                <div>
                    ranges
                </div>
                <div class="text-sm">
                    Page: {{ props.ranges.current_page }}
                    | total: {{ props.ranges.total }}
                    | from: {{ props.ranges.from }},
                    to: {{ props.ranges.to }}
                </div>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3" scope="col"
                                @click="sort('id')">
                                Sr.No#
                            </th>
                            <th class="px-6 py-3" scope="col"
                                @click="sort('from')">
                                From
                            </th>
                            <th class="px-6 py-3" scope="col"
                                @click="sort('to')">
                                To
                            </th>
                            <th class="px-6 py-3" scope="col"
                                @click="sort('amount')">
                                Amount
                            </th>
                            <th class="px-6 py-3" scope="col">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(range,key) in props.ranges.data" :key="range.id"
                            class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ key+1 }}
                            </td>

                            <td class="px-6 py-3" scope="col">
                                <p>
                                    {{ range.from }}
                                </p>
                            </td>
                            <td class="px-6 py-3" scope="col">
                                <p>
                                    {{ range.to }}
                                </p>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                                {{ range.amount }}
                            </td>
                            <td class="px-6 py-3" scope="col">
                               <EditIcon @click="edit(range)"
                                    class="w-8 hover:cursor-pointer hover:bg-blue-600 hover:text-white rounded-md p-1" />
                                <Spinner v-if="api.isLoading.value && selectedRangeId.value === range.id"
                                    class="button-spinner-center action-btn" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <Pagination :links="props.ranges.links" />
        </div>

    </AdminLayout>
</template>

<script>

export default {
    name: 'ranges/Index'
}
</script>

<style scoped></style>
