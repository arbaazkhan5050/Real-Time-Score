import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import BootstrapVue from "bootstrap-vue";

Vue.config.productionTip = false;

Vue.use(BootstrapVue);

// styles
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import "@/assets/styles/app.scss";

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");