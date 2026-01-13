<template>
  <div class="bg-white">
    <div class="p-4 rounded-lg">
      <h1 class="text-gray-800 text-2xl font-bold mb-6">
        Details
      </h1>

      <!-- FORM -->
      <form @submit.prevent>
        <div class="grid gap-6 md:grid-cols-2">

          <!-- COUNTRY -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">
              Select Country
            </label>
            <select
              v-model="form.country"
              class="w-full px-3 py-3 text-sm border border-gray-200 rounded focus:outline-none"
            >
              <option value="" disabled>Select...</option>
              <option
                v-for="country in countries"
                :key="country"
                :value="country"
              >
                {{ country }}
              </option>
            </select>
          </div>

          <!-- STATE -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">
              Select State
            </label>
            <select
              v-model="form.state"
              class="w-full px-3 py-3 text-sm border border-gray-200 rounded focus:outline-none"
            >
              <option value="" disabled>Select...</option>
              <option
                v-for="state in states"
                :key="state"
                :value="state"
              >
                {{ state }}
              </option>
            </select>
          </div>

        </div>
      </form>

      <!-- ACTION BUTTONS -->
      <div class="flex justify-between mt-8">
        <button
          @click="$emit('back')"
          class="px-6 py-2 rounded bg-gray-200 hover:bg-gray-300"
        >
          Back
        </button>

        <button
          @click="submitStep"
          class="px-6 py-2 rounded bg-blue-600 text-white hover:bg-blue-700"
        >
          Next
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const emit = defineEmits(['next', 'back']);

const form = ref({
  country: '',
  state: '',
});

const countries = [
  'India',
  'USA',
  'Canada',
];

const states = [
  'Gujarat',
  'Maharashtra',
  'Delhi',
  'California',
  'Texas',
  'Ontario',
];

const submitStep = () => {
  emit('next', form.value);
};
</script>
