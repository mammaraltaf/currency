<script setup>
import FiftyText from "@/Components/Design/FiftyText.vue";
import WorkingStep from "@/Pages/HomePage/partials/WorkingStep.vue";
import NewActionButton from "@/Components/Design/NewActionButton.vue";
</script>

<template>
    <div class="hero-section-four-container">
        <FiftyText class="limited-title-width" color="dark" variation="heading-2">
            Quick & Simple Money Transfers
        </FiftyText>

        <FiftyText class="mt-10 limited-title-text">
            Carry the latest prices in your pocket. With no hidden fees,
            the money you send to your friends and family goes further. Check the most up-to-date rates at anytime for
            easy sending to over 165 countries.
        </FiftyText>

        <div class="working-steps">
            <WorkingStep
                description="Register quickly for free with one time passwords"
                number="01"
                title="Register for free"
            />

            <WorkingStep
                description="In a very simple way, add the transfer details."
                number="02"
                title="Add transfer details"
            />

            <WorkingStep
                description="For your own protection and security we need to verify the identity of our senders."
                number="03"
                title="Verify your identity"
            />

            <WorkingStep
                description="You can track you transfer all the way to the receiver with real time updates by email and SMSs."
                number="04"
                title="Track your transfer"
            />
        </div>

        <NewActionButton :url="route('user.info.page')" class="w-fit" title="Get Started"/>
    </div>
</template>

<script>
export default {
    name: "HeroSectionFour"
}
</script>
