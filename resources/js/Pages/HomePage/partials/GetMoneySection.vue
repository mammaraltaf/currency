<script setup>

import FiftyText from "@/Components/Design/FiftyText.vue";
import NewActionButton from "@/Components/Design/NewActionButton.vue";
</script>

<template>

    <div class="get-money-section-container">
        <div class="content-container">
            <FiftyText color="dark" variation="heading-3">
                Get Money Without Borders
            </FiftyText>

            <FiftyText class="body-text">
                Our dream is for people to live and work anywhere seamlessly.
                That means money without borders: moving it instantly, transparently, conveniently, and eventually for
                free.
            </FiftyText>

            <NewActionButton
                :url="route('user.info.page')"
                class="w-fit money-action-button"
                title="Send Money Now"
            />
        </div>
    </div>

</template>

<script>
export default {
    name: "GetMoneySection"
}
</script>
