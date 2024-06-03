<template>
    <div class="min-h-screen bg-purple-900 text-white flex flex-col">
        <nav class="bg-purple-800 p-4 flex justify-between items-center">
            <div class="text-lg font-bold">Music Player</div>
            <div class="hidden md:flex">
                <template v-if="isLoggedIn">
                    <router-link to="/songs" class="px-4 py-2 rounded hover:bg-purple-700" active-class="bg-purple-700">
                        Songs
                    </router-link>
                    <button @click="logout"
                            class="bg-purple-700 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none">
                        Logout
                    </button>
                </template>

                <template v-else>

                    <router-link to="/login" class="px-4 py-2 rounded hover:bg-purple-700" active-class="bg-purple-700">
                        Login
                    </router-link>
                    <router-link to="/register" class="px-4 py-2 rounded hover:bg-purple-700"
                                 active-class="bg-purple-700">
                        Register
                    </router-link>
                </template>
            </div>
            <div class="md:hidden">
                <button @click="toggleMenu" class="focus:outline-none">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </nav>
        <div v-if="menuOpen" class="md:hidden bg-purple-700">
            <template v-if="isLoggedIn">

                <router-link @click="toggleMenu" to="/songs" class="block px-4 py-2 rounded hover:bg-purple-600"
                             active-class="bg-purple-600">Songs
                </router-link>
                <button @click="logout"
                        class="block px-4 py-2 rounded hover:bg-purple-600">
                    Logout
                </button>
            </template>
            <template v-else>
                <router-link @click="toggleMenu" to="/login" class="block px-4 py-2 rounded hover:bg-purple-600"
                             active-class="bg-purple-600">Login
                </router-link>
                <router-link @click="toggleMenu" to="/register" class="block px-4 py-2 rounded hover:bg-purple-600"
                             active-class="bg-purple-600">Register
                </router-link>
            </template>
        </div>
        <div class="flex-1 p-6 lg:p-10">
            <router-view @login-state-changed="updateLoginState" />
        </div>
    </div>
</template>

<script>
console.log('auth_token', localStorage.getItem('auth_token'), !!localStorage.getItem('auth_token'))
export default {
  name: 'NavLayout',

  data() {
    return {
      menuOpen: false,
      isLoggedIn: !!localStorage.getItem('auth_token')
    }
  },
  methods: {
    toggleMenu() {
      this.menuOpen = !this.menuOpen
    },
    logout() {
      localStorage.removeItem('auth_token')
      this.$emit('login-state-changed')
      this.$router.push('/login')
    },
    updateLoginState() {
      console.log('emmit triggered')
      this.isLoggedIn = !!localStorage.getItem('auth_token')
    }
  }

}
</script>

<style scoped>
/* Add any custom styles if needed */
</style>
