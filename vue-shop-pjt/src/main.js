import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import mixins from './mixins';

createApp(App).mixin(mixins).use(store).use(router).mount('#app');

window.Kakao.init('3c31e819cf122129cd883f45440096a6');
