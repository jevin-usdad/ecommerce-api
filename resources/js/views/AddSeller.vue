<template>
    <Topbar />

    <aside class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 bg-[#250f4f]">
        <ul class="space-y-2 px-3">
            <li>
                <router-link to="/list" class="flex items-center p-2 text-gray-200 rounded-lg hover:bg-[#432b73]">
                    <span class="ml-3">Sellers</span>
                </router-link>
            </li>
        </ul>
    </aside>

    <main class="p-4 sm:ml-64 mt-20">

        <!-- STEPPER TITLE -->
        <div class="bg-white p-4 mb-2 rounded-lg">
            <h3 class="text-[1.125rem] font-semibold">Stepper Form</h3>
        </div>

        <!-- STEPPER UI (Already Fixed) -->
        <div class="bg-white p-4 rounded-lg mb-4">
            <div class="flex items-center justify-between">

                <template v-for="(step, index) in steps" :key="index">
                    <!-- STEP -->
                    <div class="flex flex-col items-center text-center min-w-[120px]">
                        <div class="w-8 h-8 flex items-center justify-center rounded-full text-sm font-semibold" :class="currentStep > index
                            ? 'bg-green-600 text-white'
                            : currentStep === index
                                ? 'bg-blue-600 text-white'
                                : 'bg-gray-300 text-gray-600'
                            ">
                            {{ currentStep > index ? '✓' : index + 1 }}
                        </div>

                        <p class="mt-2 text-sm" :class="currentStep >= index ? 'text-black' : 'text-gray-400'">
                            {{ step }}
                        </p>
                    </div>

                    <!-- CONNECTOR LINE (NOT AFTER LAST STEP) -->
                    <div v-if="index !== steps.length - 1" class="flex-1 h-[2px] mx-2" :class="currentStep > index
                        ? 'bg-green-600'
                        : 'bg-gray-300'
                        "></div>
                </template>

            </div>
        </div>


        <PersonalInformation v-if="currentStep === 0" @next="handlePersonalInfo" />

        <Details v-if="currentStep === 1" @next="handleDetails" @back="prevStep" />

        <Skills v-if="currentStep === 2" @next="handleSkills" @back="prevStep" />

        <Credentials v-if="currentStep === 3" @back="prevStep" @submit="submitSeller" />

        <p v-if="loading" class="text-center mt-4">
            Saving seller...
        </p>

    </main>
</template>


<script setup>
import { ref } from 'vue';
import { createSeller } from '../services/seller.service';

import Topbar from '../components/Topbar.vue';
import PersonalInformation from '../components/steps/PersonalInformation.vue';
import Details from '../components/steps/Details.vue';
import Skills from '../components/steps/Skills.vue';
import Credentials from '../components/steps/Credentials.vue';

const steps = [
    'Personal Information',
    'Details',
    'Skills Details',
    'Credential Details',
];

const currentStep = ref(0);
const loading = ref(false);

const sellerForm = ref({
    personal: {},
    details: {},
    skills: [],
    credentials: {},
});

const nextStep = () => {
    if (currentStep.value < steps.length - 1) {
        currentStep.value++;
    }
};

const prevStep = () => {
    if (currentStep.value > 0) {
        currentStep.value--;
    }
};

const handlePersonalInfo = (data) => {
    sellerForm.value.personal = data;
    nextStep();
};

const handleDetails = (data) => {
    sellerForm.value.details = data;
    nextStep();
};

const handleSkills = (data) => {
    sellerForm.value.skills = data;
    nextStep();
};

const submitSeller = async (credentials) => {
    sellerForm.value.credentials = credentials;

    try {
        loading.value = true;
        await createSeller(sellerForm.value);

        alert('Seller created successfully');
        currentStep.value = 0;
    } catch (error) {
        alert('Failed to create seller');
    } finally {
        loading.value = false;
    }
};
</script>
