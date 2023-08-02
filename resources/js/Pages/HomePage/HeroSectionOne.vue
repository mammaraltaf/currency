<script setup>
import FiftyText from "@/Components/Design/FiftyText.vue";
import NewActionButton from "@/Components/Design/NewActionButton.vue";
import Ratings from "@/Components/Design/Ratings.vue";

</script>

<template>
    <div class="hero-section-one inside-container">
        <div class="hero-section-title">
            <FiftyText variation="heading-2">
                Sending Money Made Easy
            </FiftyText>


            <FiftyText class="mt-6" variation="body-l">
                Send money instantly to friends, family & business partner from our app or web portal with
                direct bank deposits.
                Pick the transfer methods that works best. Check our price calculator before you
                send money.
            </FiftyText>

            <NewActionButton
                :url="route('track.transaction')"
                class="mt-8 w-fit"
                title="Track Transaction"
            />

            <Ratings/>
        </div>

        <div class="hero-section-image">
            <img alt="People Picture" src="images/homePage/hero-section-1.png">
        </div>
    </div>
</template>


<script>

export default {
    name: "HeroSectionOne",
}
</script>
