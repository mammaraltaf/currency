<script setup>
import FiftyText from "@/Components/Design/FiftyText.vue";
import SitePropertyBox from "@/Pages/HomePage/partials/SitePropertyBox.vue";

</script>

<template>
    <div class="hero-section-three-container">
        <FiftyText class="limited-title-width" color="dark" variation="heading-2">
            Why Choose Us
        </FiftyText>

        <FiftyText class="mt-10 limited-title-text">
            Carry the latest prices in your pocket. With no hidden fees,
            the money you send to your friends and family goes further. Check the most up-to-date rates at anytime for
            easy sending to over 165 countries.
        </FiftyText>

        <div class="site-properties">
            <SitePropertyBox
                description="Send money in seconds to your loved ones across the world."
                iconSrc="images/icons/fast.png"
                title="Fast"
            />

            <SitePropertyBox
                description="Feel secure knowing we’ve sent over a billion safe transfers."
                iconSrc="images/icons/secure.png"
                title="Secure"
            />

            <SitePropertyBox
                description="Enjoy our no hassle 100% satisfaction guarantee of your money transfer."
                iconSrc="images/icons/guaranteed.png"
                title="Guaranteed"
            />
        </div>
    </div>
</template>

<script>
export default {
    name: "HeroSectionThree"
}
</script>
