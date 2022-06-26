<template>
  <v-app>
    <nprogress-container></nprogress-container>
    <NavBarView />
    <v-main class="main">
      <MenuView />
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import NavBarView from "./views/layouts/NavBarView.vue";
import NprogressContainer from "vue-nprogress/src/NprogressContainer";
import MenuView from "./views/layouts/MenuView.vue";
export default {
  name: "App",
  data: () => ({}),
  components: { NavBarView, NprogressContainer, MenuView },
};
</script>
<style>
#nprogress .bar {
  background: #fff;
}
.v-btn {
  width: 120px !important;
}
.v-btn--active {
  background: #3498db !important;
}
.v-btn--active .v-btn__content {
  color: white !important;
}
</style>
