<script setup>
import {computed} from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    'modelValue': {
        default: false,

    },
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    class:{
        default: 'slider-checked',

    },
    id:{
        default: null,
    },
    'label': {
        default: '',
        type: String
    },
    'required':{
        default: false,

    },
    'title':{
        default: '',

    }
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
     <label :for="title" class="w-fit form-label inline-block mb-2 text-lg text-gray-700">
            {{ label ?? '' }} <span v-if="required" class="text-red-600">*</span>
        </label>
    <input
        :value="modelValue"
        :class="class"
        type="checkbox"
        class="slider"
    />
</template>
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
