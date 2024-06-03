<template>
    <div class="min-h-screen bg-purple-900 text-white flex justify-center items-center p-6">
        <div class="w-full max-w-md bg-purple-800 p-6 rounded-lg">
            <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
            <form @submit.prevent="register">
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="email">Email</label>
                    <input
                        v-model="email"
                        type="email"
                        id="email"
                        class="w-full px-3 py-2 text-gray-700 bg-white rounded-lg focus:outline-none"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="password">Password</label>
                    <input
                        v-model="password"
                        type="password"
                        id="password"
                        class="w-full px-3 py-2 text-gray-700 bg-white rounded-lg focus:outline-none"
                        required
                    />
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-bold mb-2" for="confirmPassword">Confirm Password</label>
                    <input
                        v-model="confirmPassword"
                        type="password"
                        id="confirmPassword"
                        class="w-full px-3 py-2 text-gray-700 bg-white rounded-lg focus:outline-none"
                        required
                    />
                </div>
                <div class="flex items-center justify-between">
                    <button
                        type="submit"
                        class="bg-purple-700 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none"
                    >
                        Register
                    </button>
                    <router-link to="/login" class="text-sm text-purple-400 hover:text-purple-300">
                        Already have an account? Login
                    </router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      email: '',
      password: '',
      confirmPassword: ''
    }
  },
  methods: {
    async register() {
      if (this.password !== this.confirmPassword) {
        alert('Passwords do not match')
        return
      }

      try {
        const response = await axios.post('/api/register', {
          email: this.email,
          password: this.password,
          password_confirmation: this.confirmPassword
        })
        console.log(response.data)
        alert('Registration successful. Please log in.')
        this.$router.push('/login')
      } catch (error) {
        console.error('Registration error:', error)
        alert('Registration failed. Please try again.')
      }
    }
  }
}
</script>

<style scoped>
input[type="email"],
input[type="password"] {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
</style>
