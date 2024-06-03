import { createApp } from 'vue'
import AppRouter from './components/AppRouter.vue'
import App from './App.vue'
import router from './router/'
import '@fortawesome/fontawesome-free/css/all.css'

const app = createApp(App)
app.component('AppRouter', AppRouter)

app.use(router).mount('#app')
