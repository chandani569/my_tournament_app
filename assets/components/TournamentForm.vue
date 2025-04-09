<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <form @submit.prevent="handleSubmit" class="bg-white shadow-lg rounded-xl p-8 space-y-4 w-full max-w-md">
      <h2 class="text-2xl font-bold text-center text-gray-800">Create Tournament</h2>
      <div v-if="step === 1">
        <label class="block text-sm font-medium text-gray-700">Tournament Name</label>
        <input v-model="form.name" type="text" class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
        <button @click="nextStep" type="button" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Next</button>
      </div>

      <div v-if="step === 2">
        <label class="block text-lg font-semibold mb-2">Tournament Type</label>
        <div class="flex space-x-4">
          <label v-for="type in types" :key="type.value" class="flex items-center space-x-2 cursor-pointer border px-4 py-2 rounded-lg hover:bg-gray-100" :class="{'bg-blue-100': form.type === type.value}">
            <input type="radio" v-model="form.type" :value="type.value" class="hidden" />
            <span>{{ type.label }}</span>
          </label>
        </div>
        <div class="mt-4 flex justify-between">
          <button @click="step = 1" type="button" class="bg-gray-300 text-black px-4 py-2 rounded">Back</button>
          <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Submit</button>
        </div>
      </div>
    </form>

    <p v-if="message" class="mt-4 text-green-600 font-semibold">{{ message }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      step: 1,
      message: '',
      form: {
        name: '',
        type: '',
      },
      types: [
        { label: 'Mixed Type', value: 'mixed' },
        { label: 'Championship Type', value: 'championship' },
        { label: 'Elimination Type', value: 'elimination' },
      ],
    };
  },
  methods: {
    nextStep() {
      if (this.form.name.trim() === '') {
        alert('Please enter a name.');
        return;
      }
      this.step = 2;
    },
    async handleSubmit() {
      try {
        const response = await fetch('/api/tournaments', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(this.form),
        });
        console.log('456');

        if (!response.ok) throw new Error('Failed to create tournament');
        const data = await response.json();
        this.message = data.message;
        this.step = 1;
        this.form.name = '';
        this.form.type = '';
      } catch (error) {
        console.error(error);
        alert('An error occurred while submitting the form.');
      }
    },
  },
};
</script>

<style scoped>
input:checked + span {
  font-weight: bold;
}
</style>