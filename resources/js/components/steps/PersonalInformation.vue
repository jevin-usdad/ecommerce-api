<template>
    <div class="bg-white">
        <div class="p-4 rounded-lg">
            <h1 class="block text-left w-full text-gray-500 text-2xl font-bold mb-6">
                Personal Details
            </h1>

            <!-- PROFILE IMAGE -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Profile Image
                </label>

                <div class="flex flex-col items-start">
                    <div class="w-20 h-20 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center">
                        <img :src="previewImage" alt="Profile" class="w-20 h-20 object-cover rounded-full" />
                    </div>


                    <label
                        class="mt-5 cursor-pointer flex flex-col items-center px-4 py-2 bg-blue-300 text-gray-700 rounded-lg shadow hover:bg-blue-400">
                        <span class="text-base">Upload Image</span>
                        <input type="file" class="hidden" accept="image/*" @change="onImageChange" />
                    </label>
                </div>
            </div>

            <!-- NAME & GENDER -->
            <div class="grid gap-x-7 md:grid-cols-2">
                <!-- NAME -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Name
                    </label>
                    <input v-model="form.name" type="text" placeholder="Name"
                        class="w-full px-3 py-3 text-sm border border-gray-200 rounded focus:outline-none" />
                </div>

                <!-- GENDER -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Gender
                    </label>

                    <div class="flex space-x-7">
                        <label class="flex items-center space-x-2">
                            <input type="radio" value="male" v-model="form.gender" class="w-4 h-4" />
                            <span>Male</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="radio" value="female" v-model="form.gender" class="w-4 h-4" />
                            <span>Female</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="radio" value="others" v-model="form.gender" class="w-4 h-4" />
                            <span>Others</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- PHONE NUMBER -->
            <div class="grid gap-x-7 md:grid-cols-2">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Phone Number
                    </label>
                    <input v-model="form.mobile_no" type="number" placeholder="Phone Number"
                        class="w-full px-3 py-3 text-sm border border-gray-200 rounded focus:outline-none" />
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex justify-between mt-6">
                <button disabled class="px-6 py-2 rounded bg-gray-200 text-gray-500 cursor-not-allowed">
                    Back
                </button>

                <button @click="submitStep" class="px-6 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                    Next
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const emit = defineEmits(['next']);

const form = ref({
    name: '',
    gender: 'female',
    mobile_no: '',
    profile_image: null,
});

const previewImage = ref(
    'https://images.unsplash.com/photo-1531316282956-d38457be0993'
);

const onImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.value.profile_image = file;
        previewImage.value = URL.createObjectURL(file);
    }
};

const submitStep = () => {
    emit('next', form.value);
};
</script>
