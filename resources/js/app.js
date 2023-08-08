import '../../public/main.css'

import { createApp } from 'vue'
import App from './BasicScreens/App.vue'
import router from './router'

const app = createApp(App)

app.use(router)

app.mount('#app')