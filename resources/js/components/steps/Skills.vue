<template>
    <div class="bg-white">
        <div class="p-4 rounded-lg">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">
                Skills Details
            </h1>

            <!-- SKILLS LIST -->
            <div v-for="(skill, index) in skills" :key="index" class="flex space-x-4 mb-4">
                <input v-model="skills[index]" type="text" placeholder="Add Skills"
                    class="w-full px-3 py-3 text-sm border border-gray-200 rounded focus:outline-none" />

                <button type="button" @click="removeSkill(index)"
                    class="text-white bg-red-700 hover:bg-red-800 rounded-lg px-4 py-2 text-sm">
                    Remove
                </button>
            </div>

            <!-- ADD BUTTON -->
            <button type="button" @click="addSkill"
                class="text-white bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2.5 text-sm">
                Add Skills
            </button>

            <!-- ACTION BUTTONS -->
            <div class="flex justify-between mt-8">
                <button @click="$emit('back')" class="px-6 py-2 rounded bg-gray-200 hover:bg-gray-300">
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

const emit = defineEmits(['next', 'back']);

const skills = ref(['']);

const addSkill = () => {
    skills.value.push('');
};

const removeSkill = (index) => {
    skills.value.splice(index, 1);
};

const submitStep = () => {
    emit('next', skills.value.filter(skill => skill.trim() !== ''));
};
</script>
