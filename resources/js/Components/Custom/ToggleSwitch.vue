<script setup>
import { computed } from 'vue';
import FiftyText from "@/Components/Design/FiftyText.vue";

// const emit = defineEmits(['update:modelValue']);
defineEmits(['update:modelValue']);

const props = defineProps({
    modelValue: {
        default: false,

    },
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    class: {
        default: 'slider-checked',

    },
    id: {
        default: null,
    },
    'label': {
        default: '',
        type: String
    },
    'required': {
        default: false,

    },
    'title': {
        default: '',
    },
    'beforeSwitch': {
        default: '',
    },
    'afterSwitch': {
        default: '',
    },
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
    <!-- <label :for="title" class="w-fit form-label inline-block mb-2 text-lg text-gray-700">
            {{ label ?? '' }} <span v-if="required" class="text-red-600">*</span>
        </label>
    <input
        :value="modelValue"
        :class="class"
        type="checkbox"
        class="slider"
    /> -->
    <div class="w-full flex flex-col justify-start relative fifty-form-input">
        <label :for="title" class="w-fit inline-block mb-2">
            <FiftyText>
                {{ label ?? '' }} <span v-if="required" class="text-red-600">*</span>
            </FiftyText>
        </label>
        <div class="w-full  flex-col   ">

            <label class="w-fit inline-block mb-2" for="" v-if="beforeSwitch"><FiftyText>{{ beforeSwitch }}</FiftyText></label>
        <label class="switch">
            <input type="checkbox" :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            >
            <span class="slider round"></span>
        </label>
        <label class="w-fit inline-block mb-2" for="" v-if="afterSwitch"><FiftyText>{{ afterSwitch }}</FiftyText></label>
        </div>
    </div>

</template>
<style scoped>
/* The switch - the box around the slider */
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 25px;
}

/* Hide default HTML checkbox */
.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

/* The slider */
.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 4px;
    bottom: 3px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked+.slider {
    background-color: #233375;
}

input:focus+.slider {
    box-shadow: 0 0 1px #233375;
}

input:checked+.slider:before {
    -webkit-transform: translateX(33px);
    -ms-transform: translateX(33px);
    transform: translateX(33px);
}

/* Rounded sliders */
.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}
</style>
