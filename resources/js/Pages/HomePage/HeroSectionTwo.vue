<script setup>
import FiftyText from "@/Components/Design/FiftyText.vue";
import GetMoneySection from "@/Pages/HomePage/partials/GetMoneySection.vue";
</script>

<template>

    <div class="hero-section-two-container">
        <FiftyText class="limited-title-width" color="dark" variation="heading-2">
            The Fastest & Cheapest Money
            Transfer Across Boarders
        </FiftyText>

        <FiftyText class="mt-10 limited-title-text">
            50-50 has made t he g lobe flat with Peer-2-Peer money transfer. We're upfront about our ridiculously low
            fees and best market driven exchange rates. Send money instantly to friends, family & business partner from
            our app or web portal with direct bank deposits.
            Pick the transfer methods that works best. Check our price calculator before you send money.
        </FiftyText>

        <GetMoneySection/>
    </div>

</template>


<script>
export default {
    name: "HeroSectionTwo"
}
</script>
