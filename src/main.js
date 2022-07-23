import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import vuetify from "./plugins/vuetify";
import moment from 'moment'
import NProgress from "vue-nprogress";
Vue.config.productionTip = false;

const options = {
  latencyThreshold: 200, // Number of ms before progressbar starts showing, default: 100,
  router: true, // Show progressbar when navigating routes, default: true
  http: false, // Show progressbar when doing Vue.http, default: true
};
Vue.use(NProgress, options);
Vue.prototype.moment = moment
const nprogress = new NProgress();

new Vue({
  router,
  store,
  vuetify,
  nprogress,
  render: (h) => h(App),
}).$mount("#app");
