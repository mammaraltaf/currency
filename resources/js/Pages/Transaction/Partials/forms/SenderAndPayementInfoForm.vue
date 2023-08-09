<script setup>
import { computed, onMounted, reactive, ref, } from "vue";
import InternationalTelInput from "@/Components/Custom/InternationalTelInput.vue";
import { VueTelInput } from 'vue-tel-input';
import { router, usePage } from "@inertiajs/vue3";
import 'vue-tel-input/dist/vue-tel-input.css';
import { useAPI } from "@/Composables/useAPI";
import { countries } from "@/helpers/countries";
import { currencies_countries } from "@/helpers/currencies_countries";
import { currencies } from "@/helpers/currencies";
import { useNotificationStore } from "@/stores/notification";
import NewTextInput from "@/Components/Design/NewTextInput.vue";
import NewSelectInput from "@/Components/Design/NewSelectInput.vue";
import FiftyText from "@/Components/Design/FiftyText.vue";
import NewActionButton from "@/Components/Design/NewActionButton.vue";
import Spinner from "@/Components/Custom/Spinner.vue";

const props = defineProps({
    transactionId: {
        required: false,
        type: String,
    },
    user: {
        // required: true,
        default: null,
        type: Object
    },
    receivingCountries: {
        required: true,
        default: [],
        type: Array
    }
})
console.log('user',props.user);
const emit = defineEmits(['stepChanged'])
const api = useAPI();
const notification = useNotificationStore();
const geoLocationDetails = usePage().props.geoDetails;
const isLoadingCurrencyRate = ref(false);
const currentRate = ref(0);
const isTransactionPreset = ref(false);
const totalAmount = ref(false)
const user = reactive({
    'first_name': '',
    'country': geoLocationDetails.country_code,
    'last_name': '',
    'email': '',
    'phone': '',
    'amount': '',
    'amountTotal': '',
    'currency': currencies_countries[geoLocationDetails.country_code],
    'receiver_country': '',
})
const convertCurrencyByCountryCode = async () => {
    isLoadingCurrencyRate.value = true;

    const selectedCountry = props.receivingCountries.find((country) => {
        return country.code_iso_2 === user.receiver_country || country.code === user.receiver_country
    });

    try {
        const res = await axios.post('/api/convert-currency', {
            'baseCurrency': user.currency,
            'requiredCurrency': selectedCountry.currency.code
        });

        currentRate.value = res?.data[selectedCountry.currency.code].value

    } catch (errors) {
        notification.notify('Exchange rate is not available at the moment..', 'error');
    } finally {
        isLoadingCurrencyRate.value = false;
    }
}
const verifyUserInformation = async (e) => {
    e.preventDefault();
    api.startRequest();

    user.amountTotal = totalValue.value.toString()
    try {
        const res = await axios.post('/api/validate-info', { ...user, transactionId: props.transactionId });
        if (res.data.status === 'success') router.get('/verify-contacts?source=' + (props.transactionId ?? 'direct'));
    } catch (errors) {
        notification.notify('Something went wrong...', 'error');
        api.handleErrors(errors)
    } finally {
        api.requestCompleted();
    }
};
const receiverGetsAmount = computed(() => {
    return parseFloat((currentRate.value * user.amount).toFixed(2))
});
const phoneCountryChanged = (countryObject) => {
    user.phone = '+' + countryObject.dialCode;
}

// Cancelling:
const cancel = () => {
    router.visit('/');
}
let totalValue = ref(0)
function setTotal() {
    totalAmount.value = true
    let total = parseInt(user.amount)
    if (user.amount < 100) {
        total = total+10
    } else if (user.amount >= 100 && user.amount <= 499) {
        total =total+ 20
        console.log('user.amount',user.amount,'total',total);

    } else if (user.amount >= 500 && user.amount <= 1000) {
        total =total+ 30
    }
    totalValue.value = total
    return {totalValue}
}

// const setTransactionValues = () => {
//     user.amount = parseFloat((props.user.handled_transaction.payment_intent.amount_in_receiver_currency / 100).toFixed(2));
//     user.country = props.user.handled_transaction.user.country
// }

// onMounted(() => {
//     isTransactionPreset.value = !!props.user.transaction_id;
//     if (isTransactionPreset.value) {
//         setTransactionValues();
//     }

// })
</script>

<template>
    <div class="sender-info-form-wrapper">

        <NewTextInput v-model="user.first_name" :errors="api.errors.value?.first_name" label="First Name" placeholder="John"
            required title="first_name" class="sender-input" />

        <NewTextInput v-model="user.last_name" :errors="api.errors.value?.last_name" label="Last Name" placeholder="Doe"
            required title="last_name" class="sender-input" />

        <NewTextInput v-model="user.email" :errors="api.errors.value?.email" label="Email" placeholder="john@example.com"
            required title="email" class="sender-input" />

        <InternationalTelInput :errors="api.errors.value?.phone" :required="true" label="Phone Number" title="phone"
            class="sender-input">
            <vue-tel-input id="exampleFormControlInput1" ref="input" v-model="user.phone"
                :class="{ 'error-border': api.errors.value?.phone?.length > 0 }"
                :defaultCountry="geoLocationDetails?.country_code" :inputOptions="{ 'placeholder': '123456789' }" class="form-control block w-full px-0 py-0 text-lg font-normal h-10
                  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition
                  ease-linear m-0
                  focus:text-gray-700 focus:bg-white focus:border-indigo-300 focus:outline-none" mode="international"
                @country-changed="phoneCountryChanged">

            </vue-tel-input>
        </InternationalTelInput>

        <NewSelectInput v-model="user.country" :errors="api.errors.value?.country" :options="countries" disabled
            label="Country" placeholder="Country" required title="country" type="text" class="sender-input country" />


        <FiftyText variation="heading-3">
            Enter Receiver Information
        </FiftyText>

        <NewTextInput v-model="user.amount" :disabled="isTransactionPreset" :errors="api.errors.value?.amount"
            label="Amount" placeholder="99" required title="amount" class="fifty-form-input" type="number"
            @update:modelValue="setTotal" />

        <NewSelectInput v-model="user.currency" :disabled="isTransactionPreset" :errors="api.errors.value?.currency"
            :options="currencies" label="Currency" placeholder="Currency of your payment card" required title="country"
            class="fifty-form-input" type="text" @update:modelValue="convertCurrencyByCountryCode" />

        <NewSelectInput v-model="user.receiver_country" :disabled="isTransactionPreset" :errors="api.errors.value?.receiver_country"
            :options="receivingCountries" label="Receiver Country" label-accessor="label" placeholder="Country" required
            title="country" class="fifty-form-input country" type="text" value-accessor="code_iso_2"
            @update:modelValue="convertCurrencyByCountryCode"
            />

        <transition mode="out-in" name="fade">
            <div v-if="currentRate && user.amount" class="receiver-gets-wrapper m-auto">
                <div class="receiver-gets">
                    <FiftyText class="title">
                        The receiver will get approximately
                    </FiftyText>
                    <Spinner v-if="isLoadingCurrencyRate" />
                    <div class="amount" v-else>
                        {{ receiverGetsAmount }} {{ currencies_countries[user.receiver_country] }}
                    </div>
                </div>
            </div>

        </transition>
        <transition mode="out-in" name="fade">
            <div v-if="totalAmount" class="receiver-gets-wrapper m-auto">
                <div class="receiver-gets">
                    <FiftyText class="title">
                        Total Amount
                    </FiftyText>
                    <!-- <Spinner v-if="isLoadingtotalAmountRate" /> -->
                    <div class="amount" >
                        {{ totalValue +' '+user.currency }}
                    </div>
                </div>
            </div>
        </transition>

        <!-- <div class="action-buttons"> -->
            <!-- <NewActionButton :reversed="true" type="button" title="Cancel" @click="cancel" /> -->

            <!-- <NewActionButton :isLoading="api.isLoading.value" type="button" title="Continue" @click="openCardInfo" /> -->
        <!-- </div> -->
        <div class="action-buttons">
            <NewActionButton :reversed="true" type="button" title="Cancel" @click="cancel" />

            <NewActionButton :isLoading="api.isLoading.value" title="Continue" @click="verifyUserInformation" />
        </div>
    </div>
</template>

<script>
export default {
    name: "SenderInfo"
}
</script>

