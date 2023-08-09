<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Edit from "@/Pages/Admin/Time/Edit.vue";
import Add from "@/Pages/Admin/Time/Add.vue";

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
    times: {
        required: true,
        type: Object
    },
})
// console.log('times', props.times);
// Adding
const timeAdded = (data) => {
    // props.times.data.push(data.data);
    props.times.data.unshift(data.data)
    props.times.total++;

}

// Editing:
const editingTime = reactive({});
var showEditDialog = ref(false);

var index = ref()
const edit = (time) => {
    editingTime.value = { ...time };
    index.value = props.times.data.findIndex(oldInfo => oldInfo.id === editingTime.value.id);
    console.log(' index.value', index.value);

    showEditDialog.value = true;
    Edit;
    return { showEditDialog, Edit };
}
function closeEditDialog($isFetchData) {
    console.log('closeEditDialog',$isFetchData);
    props.times.data.splice(index.value, 1, $isFetchData);
    showEditDialog.value = false;
    index.value = null

    return { showEditDialog };
}

// Deleting

// const deleteTime = async (time) => {
//     console.log(time);
//     selectedTimeId.value = time.id;
//     index.value = props.times.data.findIndex(oldInfo => oldInfo.id === time.id);
//     console.log('index.value', index.value);
//     api.startRequest();

//     try {
//         const res = await axios.delete('/admin/times/delete/' + time.id)

//         if (res.data.id || res.data.status === 'success') {
//             notification.notify('Post deleted', 'success');
//             time.id = 'deleted';
//             props.times.total--;
//             props.times.rows.splice(index.value, 1);
//             index.value = null
//         }
//     } catch (errors) {
//         notification.notify('Error, this base time can not be deleted.', 'error');
//         api.handleErrors(errors)
//     } finally {
//         api.requestCompleted();
//     }
// }

const fetchingtimes = ref(false);

// Updating rates:
// const updatePostRates = async () => {
//     api.startRequest();
//     fetchingtimes.value = true;

//     try {
//         const res = await axios.put('/admin/times/update-rates')

//         if (res.data.status === 'success') {
//             notification.notify('Post rates updated', 'success');
//             props.times.data = res.data.times;
//             props.info.fetched_at = res.data.fetched_at;
//         }
//     } catch (errors) {
//         notification.notify('Error, could not fetch world bank rates.', 'error');
//         api.handleErrors(errors)
//     } finally {
//         fetchingtimes.value = false;
//         api.requestCompleted();
//     }
// }
// sorting
// var currentPage = ref(1)

// var searchValue = ref('');
// var disableClick = ref(false)
// const store = useSortingStore();
// const sort = (column) => {
//     searchValue.value = searchValue.value != null ? searchValue.value : ""
//     disableClick.value = true
//     store.sortValues(column);
//     let res = router.visit(`?page=${currentPage.value}&q=${searchValue.value}&column=${store.column}&type=${store.type}`);
//     if (res) {
//         disableClick.value = false
//     }
// };
// Search
// const search = () => {
//     router.visit(`?page=${currentPage.value}&q=${searchValue.value}&column=${store.column}&type=${store.type}`);
// }
// const clearSearch = () => {
//     router.visit(`?q=`);
// }

onMounted(() => {
    // searchValue.value = new URLSearchParams(window.location.search).get('q');
    // let cpg = new URLSearchParams(window.location.search).get('page');
    // currentPage.value = cpg != null ? cpg : 1
});

</script>

<template>
    <Edit :show="showEditDialog" :timeData="editingTime" v-if="showEditDialog"
        v-on:close="closeEditDialog($event)" />

    <Head title="Expiry Times">
        <title>
            Expiry Times
        </title>
    </Head>

    <AdminLayout>
        <div class="ml-4 md:ml-8 mr-4 md:mr-8">
            <div class="mt-16 mb-8 text-xl flex items-center justify-between">
                <div>
                    times
                </div>
                <div class="text-sm">
                    Page: {{ props.times.current_page }}
                    | total: {{ props.times.total }}
                    | from: {{ props.times.from }},
                    to: {{ props.times.to }}
                </div>
            </div>

            <!-- <Add  @timeAdded="timeAdded" /> -->
            <!-- <div class="flex items-end gap-3 ">
                <TextInput v-model="searchValue" class="mb-8" label="Search by" placeholder="Search" title="searchValue"
                    v-on:keyup.enter="search" />

                <button @click="search" type="button"
                    class="mb-8 flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Search
                </button>

                <button v-if="searchValue" @click="clearSearch" type="button"
                    class="mb-8 flex items-center text-blue-700 bg-white border border-blue-700 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Clear
                </button>
            </div> -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3" :class="disableClick ? 'disabled' : 'clickable'" scope="col"
                                @click="sort('id')">
                                Sr.No#
                            </th>
                            <th class="px-6 py-3" :class="disableClick ? 'disabled' : 'clickable'" scope="col"
                                @click="sort('model_name')">
                                Model Name
                            </th>
                            <th class="px-6 py-3" :class="disableClick ? 'disabled' : 'clickable'" scope="col"
                                @click="sort('time')">
                                Time
                            </th>
                            <th class="px-6 py-3" scope="col">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(time,key) in props.times.data" :key="time.id"
                            class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ key+1 }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                                {{ time.model_name }}
                            </td>
                            <td class="px-6 py-3" scope="col">
                                <p>
                                    {{ time.time }}
                                </p>
                            </td>
                            <td class="px-6 py-3" scope="col">
                               <EditIcon @click="edit(time)" v-if="time.status == 'on_hold'"
                                    class="w-8 hover:cursor-pointer hover:bg-blue-600 hover:text-white rounded-md p-1" />
                                <Spinner v-if="api.isLoading.value && selectedTimeId.value === time.id"
                                    class="button-spinner-center action-btn" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <Pagination :links="props.times.links" />
        </div>

    </AdminLayout>
</template>

<script>

export default {
    name: 'times/Index'
}
</script>

<style scoped></style>
