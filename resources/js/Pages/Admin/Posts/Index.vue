<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Add from "@/Pages/Admin/Posts/partials/Add.vue";
import Edit from "@/Pages/Admin/Posts/partials/Edit.vue";

import Pagination from "@/Components/Custom/Pagination.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { useSortingStore } from "@/stores/sorting";
import Spinner from "@/Components/Custom/Spinner.vue";
import DeleteIcon from "@/Icons/DeleteIcon.vue";
import RefreshIcon from "@/Icons/RefreshIcon.vue";

import { ref, reactive, onMounted } from "vue";
import { useAPI } from "@/Composables/useAPI";
import { useNotificationStore } from "@/stores/notification";
import EditIcon from "@/Icons/EditIcon.vue";
import TextInput from "@/Components/TextInput.vue";

const api = useAPI();
const notification = useNotificationStore();
const props = defineProps({
    posts: {
        required: true,
        type: Object
    },
    receivers: {
        required: true,
        type: Object
    }

})
console.log('receivers', props.receivers);
// Adding
const postAdded = (data) => {
    console.log('data after adding ', data);
    // props.posts.data.push(data.data);
    props.posts.data.unshift(data.data)
    props.posts.total++;

}

// Editing:
const editingPost = reactive({});
var showEditDialog = ref(false);

var index = ref()
const edit = (post) => {
    editingPost.value = { ...post };
    index.value = props.posts.data.findIndex(oldInfo => oldInfo.id === editingPost.value.id);
    console.log(' index.value', index.value);

    showEditDialog.value = true;
    Edit;
    return { showEditDialog, Edit };
}
function closeEditDialog($isFetchData) {
    props.posts.data.splice(index.value, 1, $isFetchData);
    showEditDialog.value = false;
    index.value = null

    return { showEditDialog };
}
// refreshing

let selectedPostId = ref();
const refreshPost = async (post) => {
    console.log('post', post);
    selectedPostId.value = post.id;
    index.value = props.posts.data.findIndex(oldInfo => oldInfo.id === post.id);
    console.log('index.value', index.value);
    console.log('selectedPostId.value', selectedPostId.value);
    api.startRequest();

    try {
        const res = await axios.post('/admin/posts/refresh/' + post.id)
        console.log('res refresh', res);

        if (res.data.status === 'success') {
            notification.notify('Post Refereshed', 'success');
            // props.posts.rows.splice(index.value, 1);
            props.posts.data.splice(index.value, 1, res.data.data);

            index.value = null
        }
    } catch (errors) {
        notification.notify('Error, this base post can not be refreshed.', 'error');
        api.handleErrors(errors)
    } finally {
        api.requestCompleted();
    }
}
// Deleting

const deletePost = async (post) => {
    console.log(post);
    selectedPostId.value = post.id;
    index.value = props.posts.data.findIndex(oldInfo => oldInfo.id === post.id);
    console.log('index.value', index.value);
    api.startRequest();

    try {
        const res = await axios.delete('/admin/posts/delete/' + post.id)

        if (res.data.id || res.data.status === 'success') {
            notification.notify('Post deleted', 'success');
            post.id = 'deleted';
            props.posts.total--;
            props.posts.rows.splice(index.value, 1);
            index.value = null
        }
    } catch (errors) {
        notification.notify('Error, this base post can not be deleted.', 'error');
        api.handleErrors(errors)
    } finally {
        api.requestCompleted();
    }
}

const fetchingposts = ref(false);


// sorting
var currentPage = ref(1)

var searchValue = ref('');
var disableClick = ref(false)
const store = useSortingStore();
const sort = (column) => {
    searchValue.value = searchValue.value != null ? searchValue.value : ""
    disableClick.value = true
    store.sortValues(column);
    let res = router.visit(`?page=${currentPage.value}&q=${searchValue.value}&column=${store.column}&type=${store.type}`);
    if (res) {
        disableClick.value = false
    }
};
// Search
const search = () => {
    router.visit(`?page=${currentPage.value}&q=${searchValue.value}&column=${store.column}&type=${store.type}`);
}
const clearSearch = () => {
    router.visit(`?q=`);
}

onMounted(() => {
    searchValue.value = new URLSearchParams(window.location.search).get('q');
    let cpg = new URLSearchParams(window.location.search).get('page');
    currentPage.value = cpg != null ? cpg : 1
});
// class of the status
function getClass(status){
    let flag = "info"
    if (status=='available') {
        flag='success'
    }else if(status=="on_hold"){
        flag='danger'
    }
    return flag;
    }


</script>

<template>
    <Edit :show="showEditDialog" :postData="editingPost" v-if="showEditDialog"
        v-on:close="closeEditDialog($event)" />

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

            <Add :receivers="props.receivers" @postAdded="postAdded" />
            <div class="flex items-end gap-3 ">
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
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3" :class="disableClick ? 'disabled' : 'clickable'" scope="col"
                                @click="sort('created_at')">
                                Initialized <span class="fw-100">{{ store.column == 'created_at' ? '(' + store.type + ')' : ''
                                }}</span>
                            </th>
                            <th class="px-6 py-3" :class="disableClick ? 'disabled' : 'clickable'" scope="col"
                                @click="sort('status')">
                                Status <span class="fw-100">{{ store.column == 'status' ? '(' + store.type + ')' : '' }}</span>
                            </th>
                            <th class="px-6 py-3" :class="disableClick ? 'disabled' : 'clickable'" scope="col"
                                @click="sort('user')">
                                Country from <span class="fw-100">{{ store.column == 'user' ? '(' + store.type + ')' : ''
                                }}</span>
                            </th>
                            <th class="px-6 py-3" :class="disableClick ? 'disabled' : 'clickable'" scope="col"
                                @click="sort('receiver')">
                                Country To <span class="fw-100">{{ store.column == 'receiver' ? '(' + store.type + ')' : ''
                                }}</span>
                            </th>
                            <th class="px-6 py-3" :class="disableClick ? 'disabled' : 'clickable'" scope="col"
                                @click="sort('amount')">
                                Amount <span class="fw-100">{{ store.column == 'amount' ? '(' + store.type + ')' : '' }}</span>
                            </th>
                            <th class="px-6 py-3" :class="disableClick ? 'disabled' : 'clickable'" scope="col"
                                @click="sort('id')">
                                Direct Transaction Reference <span class="fw-100">{{ store.column == 'id' ?
                                    '(' + store.type + ')' : '' }}</span>
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
                               <span :class="getClass(post.status)"> {{ post.status }}</span>
                            </td>
                            <td class="px-6 py-3" scope="col">
                                <p>
                                    {{ post.transaction.user.country }}
                                </p>
                                <p>
                                    <Link :href="route('single.user.page', post.transaction.user.id)"
                                        class="text-blue-700 hover:text-blue-900 hover:underline">
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
                                        class="text-blue-700 hover:text-blue-900 hover:underline">
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
                                <DeleteIcon @click="deletePost(post)"
                                    class="w-8 hover:cursor-pointer hover:bg-red-600 hover:text-white rounded-md p-1" />

                                <EditIcon  @click="edit(post)"
                                    class="w-8 hover:cursor-pointer hover:bg-green-600 hover:text-white rounded-md p-1" />

                                <RefreshIcon @click="refreshPost(post)" v-if="post.status == 'on_hold'"
                                    class="w-8 hover:cursor-pointer hover:bg-blue-600 hover:text-white rounded-md p-1" />

                                <Spinner v-if="api.isLoading.value && selectedPostId.value === post.id"
                                    class="button-spinner-center action-btn" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <Pagination :links="props.posts.links" />
        </div>

    </AdminLayout>
</template>

<script>

export default {
    name: 'Posts/Index'
}
</script>

<style scoped>
th:not(:last-child) {
    cursor: pointer;
}

.clickable {
    cursor: pointer;
}

.disabled {
    cursor: not-allowed;
    opacity: 0.5;
    /* You can adjust the opacity as needed */
    pointer-events: none;
}

th span {
    font-size: 9px;
}
svg.bi.bi-arrow-clockwise.w-8.hover\:cursor-pointer.hover\:bg-blue-600.hover\:text-white.rounded-md.p-1{
    height: 30px;
}
.danger{
     background-color: #ff6666;
    color: white;
    padding: 2px 4px;
    font-size: 13px;
    border-radius: 3px;

}
.success{
    background-color: #2dcb2d;
    color: white;
    padding: 2px 4px;
    font-size: 13px;
    border-radius: 3px;
}
.info {
    background-color: #4dd8ff;
    color: white;
    padding: 2px 4px;
    font-size: 13px;
    border-radius: 3px;
}
</style>
