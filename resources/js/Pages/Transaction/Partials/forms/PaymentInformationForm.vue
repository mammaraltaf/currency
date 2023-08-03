<script setup>
import { computed, onMounted, reactive, ref, watch } from "vue";
import { useAPI } from "@/Composables/useAPI";
import { useNotificationStore } from "@/stores/notification";
import { router, usePage } from "@inertiajs/vue3";
import { currencies } from "@/helpers/currencies";
import { currencies_countries } from "@/helpers/currencies_countries";
import Spinner from "@/Components/Custom/Spinner.vue";
import NewActionButton from "@/Components/Design/NewActionButton.vue";
import NewTextInput from "@/Components/Design/NewTextInput.vue";
import NewSelectInput from "@/Components/Design/NewSelectInput.vue";
import FiftyText from "@/Components/Design/FiftyText.vue";

const emit = defineEmits(['stepChanged'])
const api = useAPI();
const notification = useNotificationStore();
const geoLocationDetails = usePage().props.geoDetails;
const isLoadingCurrencyRate = ref(false);
const currentRate = ref(0);
const isTransactionPreset = ref(false);

const props = defineProps({
    user: {
        required: true,
        default: null,
        type: Object
    },
    receivingCountries: {
        required: true,
        default: [],
        type: Array
    }
})
const monthNames = [
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
];
let expiryYear = ref()

const expiryYears = computed(() => {
    const currentYear = new Date().getFullYear();
    const numberOfYearsToShow = 10; // Adjust this to show how many future years you want to display
    const years = [];

    for (let i = 0; i < numberOfYearsToShow; i++) {
        let option = { 'label': currentYear + i, 'value': currentYear + i }
        years.push(option);
    }
    return years;
});

let allMonths = computed(() => {
    return monthNames.map((month, index) => ({
    label: month,
    value: (index + 1).toString().padStart(2, '0')
  }));
});
let expiryMonths = ref(allMonths.value);
watch(expiryYear, (newYear) => {
    const currentYear = new Date().getFullYear();
    const currentMonth = new Date().getMonth() + 1;
    let months = [];
    if (newYear == currentYear) {
        let upcomingMonths = monthNames.slice(currentMonth - 1); // Show upcoming months
        console.log('upcomingMonths',upcomingMonths, currentMonth);
        let j = 0;
        for (let i = 12; i > 12 - upcomingMonths.length; i--) {
            j++
            months.push({ 'label': upcomingMonths[j-1], 'value': currentMonth+j-1 });
        }
    } else {
        for (let i = 0; i < monthNames.length; i++) {
            months.push({ 'label': monthNames[i], 'value': i + 1 });
        }

    }
        expiryMonths.value = months
        transactionInfo.expiry_year = newYear;

});

const transactionInfo = reactive({
    'amount': '100',
    'currency': currencies_countries[geoLocationDetails.country_code],
    'card_number': '411111111111',
    'expiry_year': expiryYear.value,
    'expiry_month': '',
    'cvv': '1111',
    'country': '',
});
const saveTransactionInfo = async () => {
    api.startRequest();

    try {
        console.log('transactionInfo',transactionInfo);
        const res = await axios.post('/moneris', transactionInfo);
        if (res.data.status === 'success') {
            goForward('/receiver-info?payment-reference-identification=' + res.data.paymentIntent.id + '&country=' + transactionInfo.country);
        } else {
            notification.notify('Unexpected error happen', 'error');
        }
    } catch (errors) {
        api.handleErrors(errors)
        notification.notify('Invalid data submitted', 'error');
    } finally {
        api.requestCompleted();
    }
}

const convertCurrencyByCountryCode = async () => {
    isLoadingCurrencyRate.value = true;

    const selectedCountry = props.receivingCountries.find((country) => {
        return country.code_iso_2 === transactionInfo.country || country.code === transactionInfo.country
    });

    try {
        const res = await axios.post('/api/convert-currency', {
            'baseCurrency': transactionInfo.currency,
            'requiredCurrency': selectedCountry.currency.code
        });

        currentRate.value = res?.data[selectedCountry.currency.code].value

    } catch (errors) {
        notification.notify('Exchange rate is not available at the moment..', 'error');
    } finally {
        isLoadingCurrencyRate.value = false;
    }
}

const goForward = (url) => {
    router.get(url);
}

const setTransactionValues = () => {
    transactionInfo.amount = parseFloat((props.user.handled_transaction.payment_intent.amount_in_receiver_currency / 100).toFixed(2));
    transactionInfo.country = props.user.handled_transaction.user.country
}

onMounted(() => {
    isTransactionPreset.value = !!props.user.transaction_id;
    if (isTransactionPreset.value) {
        setTransactionValues();
    }

})

// Cancelling:
const cancel = () => {
    router.visit('/');
}

// receiver will get amount:

const receiverGetsAmount = computed(() => {
    return parseFloat((currentRate.value * transactionInfo.amount).toFixed(2))
});

</script>

<template>
    <div class="transaction-info-form-wrapper">
        <NewTextInput v-model="transactionInfo.amount" :disabled="isTransactionPreset" :errors="api.errors.value?.amount"
            label="Amount" placeholder="99" required title="amount" class="fifty-form-input" type="number" />

        <NewSelectInput v-model="transactionInfo.currency" :disabled="isTransactionPreset"
            :errors="api.errors.value?.currency" :options="currencies" label="Currency"
            placeholder="Currency of your payment card" required title="country" class="fifty-form-input" type="text"
            @update:modelValue="convertCurrencyByCountryCode" />
        <NewTextInput v-model="transactionInfo.card_number"
            :errors="api.errors.value?.card_number" label="Card Number" placeholder="99" required title="amount"
            class="fifty-form-input" type="number" />
        <NewSelectInput v-model="expiryYear"  :errors="api.errors.value?.expiry_year"
            :options="expiryYears" label="Expiry Year" placeholder="Expiry Year of your payment card" required
            title="country" class="fifty-form-input" type="text" />
        <NewSelectInput v-model="transactionInfo.expiry_month"
            :errors="api.errors.value?.expiryMonth" :options="expiryMonths" label="Expiry Month"
            placeholder="Expiry Month of your payment card" required title="expiry month" class="fifty-form-input"
            type="text" />
        <NewTextInput v-model="transactionInfo.cvv" :errors="api.errors.value?.cvv"
            label="cvv" placeholder="99" required title="CVV" class="fifty-form-input" type="number" />
        <NewSelectInput v-model="transactionInfo.country" :disabled="isTransactionPreset"
            :errors="api.errors.value?.country" :options="receivingCountries" label="Receiver Country"
            label-accessor="label" placeholder="Country" required title="country" class="fifty-form-input country"
            type="text" value-accessor="code_iso_2" @update:modelValue="convertCurrencyByCountryCode" />

        <transition mode="out-in" name="fade">
            <div v-if="currentRate && transactionInfo.amount" class="receiver-gets-wrapper m-auto">
                <div class="receiver-gets">
                    <FiftyText class="title">
                        The receiver will get approximately
                    </FiftyText>
                    <Spinner v-if="isLoadingCurrencyRate" />
                    <div class="amount" v-else>
                        {{ receiverGetsAmount }} {{ currencies_countries[transactionInfo.country] }}
                    </div>
                </div>
            </div>
        </transition>

        <div class="action-buttons">
            <NewActionButton :reversed="true" type="button" title="Cancel" @click="cancel" />

            <NewActionButton :isLoading="api.isLoading.value" type="button" title="Continue" @click="saveTransactionInfo" />
        </div>
    </div>
</template>

<script>
export default {
    name: 'PaymentInformationForm'
}
</script>
