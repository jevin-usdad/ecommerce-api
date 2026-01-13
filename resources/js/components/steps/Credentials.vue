<template>
    <div class="bg-white">
        <div class="p-4 rounded-lg">
            <h1 class="text-gray-800 text-2xl font-bold mb-6">
                Credentials Details
            </h1>

            <!-- FORM -->
            <form @submit.prevent="submitForm">
                <!-- EMAIL -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Email
                    </label>
                    <input v-model="form.email" type="email" placeholder="Email"
                        class="w-full px-3 py-3 text-sm border border-gray-200 rounded focus:outline-none" />
                </div>

                <!-- PASSWORDS -->
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <input v-model="form.password" type="password" placeholder="Password"
                            class="w-full px-3 py-3 text-sm border border-gray-200 rounded focus:outline-none" />
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            Confirm Password
                        </label>
                        <input v-model="form.password_confirmation" type="password" placeholder="Confirm Password"
                            class="w-full px-3 py-3 text-sm border border-gray-200 rounded focus:outline-none" />
                    </div>
                </div>

                <!-- ERROR -->
                <p v-if="error" class="text-red-600 text-sm mb-4">
                    {{ error }}
                </p>

                <!-- ACTION BUTTONS -->
                <div class="flex justify-between mt-6">
                    <button type="button" @click="$emit('back')"
                        class="px-6 py-2 rounded bg-gray-200 hover:bg-gray-300">
                        Back
                    </button>

                    <button type="submit" class="px-6 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const emit = defineEmits(['back', 'submit']);

const form = ref({
    email: '',
    password: '',
    password_confirmation: '',
});

const error = ref('');

const submitForm = () => {
    error.value = '';

    if (form.value.password !== form.value.password_confirmation) {
        error.value = 'Passwords do not match';
        return;
    }

    emit('submit', form.value);
};
</script>
