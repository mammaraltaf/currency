<script setup>
import DesktopNavbar from "@/Components/Custom/DesktopNavbar.vue";
import MobileNavbar from "@/Components/Custom/MobileNavbar.vue";


const navItems = [
    {
        title: 'services',
        label: 'Services',
        url: '/services'
    },
    {
        title: 'track',
        label: 'Track Transaction',
        url: '/track-transaction'
    }
]

</script>

<template>
    <div>
        <!-- Desktop nav bar -->
        <DesktopNavbar :navItems="navItems"/>

        <MobileNavbar :navItems="navItems"/>

    </div>
</template>

<script>
export default {
    name: "Header",
}
</script>
