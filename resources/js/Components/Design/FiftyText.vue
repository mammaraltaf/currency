<script setup>

const props = defineProps({
    variation: {
        type: String,
        default: ''
    },
    color: {
        type: String,
        default: 'grey'
    },
})


</script>

<template>
    <div :class="`${variation} ${color}`" class="basic-text">
        <slot/>
    </div>
</template>

<script>
export default {
    name: 'FiftyText'
}
</script>

