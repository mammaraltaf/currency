<script setup>
import {ref, reactive, computed} from "vue";
import {useAPI} from "@/Composables/useAPI";
import {useNotificationStore} from "@/stores/notification";
import TextInput from "@/Components/TextInput.vue";
import ToggleSwitch from "@/Components/Custom/ToggleSwitch.vue";
import SelectInput from "@/Components/Custom/SelectInput.vue";
import Spinner from "@/Components/Custom/Spinner.vue";
import { countries } from "@/helpers/countries";

const api = useAPI();
const notification = useNotificationStore();

const props = defineProps({
    countries: {
        required: true,
        type: Object
    }

});
let allCountries = computed(() => {
    return props.countries.map((country) => ({
    label: country.code +"("+country.label+")",
    value: country.id
  }));
});
console.log('countries',props.countries, allCountries);
// Emits
const emit = defineEmits(['postAdded']);

// Form:
const formOpened = ref(false);

const openForm = () => {
    formOpened.value = true;
}

const endAdd = () => {
    formOpened.value = false;
    api.errors.value = {};
    resetPost();
}

const post = reactive({
    'transaction_id': '1',
    'country_code': '',
    'status': false,
})


const resetPost = () => {
    post.transaction_id = ''
    post.country_code = ''
    post.status = ''
}

const addPost = async () => {
    api.startRequest();

    try {
        const res = await axios.post('/admin/posts/store', post)

        if (res.data.id || res.data.status === 'success') {
            notification.notify('Post added', 'success');
            endAdd();
            emit('postAdded');
        }
    } catch (errors) {
        notification.notify('Error', 'error');
        api.handleErrors(errors)
    } finally {
        api.requestCompleted();
    }
}

</script>

<template>
    <div >
        <button @click="openForm" type="button" class="mb-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Add new post
        </button>


        <form v-show="formOpened" class="border-gray-400 border rounded-lg p-6 mb-8">
            <div class="grid gap-6 mb-10 md:grid-cols-2">
                <TextInput
                    v-model="post.transaction_id"
                    :errors="api.errors.value?.transaction_id"
                    label="Post Transection Id"
                    placeholder="Transection ID"
                    required
                    title="transaction"
                />
                 <SelectInput
                    v-model="post.country_code"
                    :errors="api.errors.value?.country_code"
                    :options="allCountries"
                    label="Country Code"
                    required
                    placeholder=" Select "
                    title="Country Code"
                    type="text"
                />
                <div>
                    <label>Status</label>
                <input type="checkbox" :class="post.status ? 'slider-checked' : ''"
                                    class="slider" v-model="post.status"
                                 />
                </div>

            </div>

            <div class="flex gap-4 items-center">
                <button
                    @click="addPost"
                    type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add
                </button>
                <button
                    type="button"
                    @click="endAdd"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    Cancel
                </button>

                <Spinner v-if="api.isLoading.value" class="button-spinner-center action-btn"/>
            </div>

        </form>

    </div>
</template>

<script>
export default {
    name: "CreatePost"
}
</script>
<style scoped>
.slider {
    /* -webkit-appearance: none; */
    width: 40px;
    height: 20px;
    border-radius: 20px;
    background: #c6c6c6;
    outline: none;
    opacity: 0.7;
    transition: .2s;
    margin: 0 10px;
}

.slider:hover {
    opacity: 1;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
}

.slider-checked {
    background-color: #1C64F2;
}
</style>
