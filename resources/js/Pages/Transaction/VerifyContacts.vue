<script setup>
import {Head, router} from '@inertiajs/vue3';
import {useNotificationStore} from "@/stores/notification";
import {ref} from "vue";
import GuestLayout from '@/Layouts/GuestLayout.vue';
import VerifyCode from "@/Pages/Transaction/Partials/VerifyCode.vue";
import TransactionSteps from "@/Pages/Transaction/Partials/TransactionSteps.vue";
import FiftyText from "@/Components/Design/FiftyText.vue";


const props = defineProps({
    user: {
        default: null,
        type: Object
    },
    transactionInfo:{
        default: null,
        type: Object
    }
})

const emailVerified = ref(!!props.user.email_verified_at);

const notificationStore = useNotificationStore();

const continueToPayment = () => {
    if (emailVerified.value) {
        router.get('/transaction-info')
    } else {
        notificationStore.notify('Please verify your information first', 'error');
    }
}

const verifyUser = () => {
    emailVerified.value = true;
    continueToPayment();
}


</script>

<template>
    <GuestLayout>
        <Head title="Fifty-Fifty | Send Money">
            <title>
                Fifty-Fifty | Send Money
            </title>
        </Head>

        <div class="transaction-step-wrapper">
            <div class="transaction-step">

                <TransactionSteps />

                <FiftyText variation="heading-3" class="mb-2">
                    Email / Phone Verification
                </FiftyText>

                <FiftyText class="text-center mb-6">
                    Email verification code sent to email: {{ user.email }} and Mobile: {{ user.phone }}
                </FiftyText>

                <Transition mode="out-in" name="fade">
                    <VerifyCode :user="user" :transactionInfo="transactionInfo" @verified="verifyUser"/>
                </Transition>
            </div>
        </div>
    </GuestLayout>
</template>
<script>
export default {
    name: 'VerifyContacts'
}
</script>
