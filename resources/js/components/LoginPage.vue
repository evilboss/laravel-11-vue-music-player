<template>
    <div class="min-h-screen bg-purple-900 text-white flex justify-center items-center p-6">
        <div class="w-full max-w-md bg-purple-800 p-6 rounded-lg">
            <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
            <form @submit.prevent="login">
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
                <div class="mb-6">
                    <label class="block text-sm font-bold mb-2" for="password">Password</label>
                    <input
                        v-model="password"
                        type="password"
                        id="password"
                        class="w-full px-3 py-2 text-gray-700 bg-white rounded-lg focus:outline-none"
                        required
                    />
                </div>
                <div v-if="errorMessage" class="mb-4 text-red-500 text-sm">
                    {{ errorMessage }}
                </div>
                <div class="flex items-center justify-between">
                    <button
                        type="submit"
                        class="bg-purple-700 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none"
                    >
                        Login
                    </button>
                    <router-link to="/register" class="text-sm text-purple-400 hover:text-purple-300">
                        Don't have an account? Sign up
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
      errorMessage: ''
    }
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('/api/login', {
          email: this.email,
          password: this.password
        })
        const token = response.data

        localStorage.setItem('auth_token', token)
        this.$emit('login-state-changed')
        this.$router.push('/songs')
      } catch (error) {
        console.error('Login error:', error)
        this.errorMessage = 'Login failed. Please check your credentials.'
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
