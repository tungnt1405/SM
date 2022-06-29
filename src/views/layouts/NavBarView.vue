<template>
  <v-app-bar app color="primary" dark>
    <div class="d-flex align-center">
      <h1 class="respon-title text-uppercase">Quản lý chi tiêu</h1>
    </div>

    <v-spacer></v-spacer>

    <v-btn text>
      <span class="mr-2">đăng nhập</span>
    </v-btn>
    <v-btn text>đăng ký</v-btn>
  </v-app-bar>
</template>

<script>
export default {
  name: "NavBarView",
};
</script>

<style scoped>
@media screen and (max-width: 820px) {
  .respon-title {
    font-size: 18px;
  }
}
</style>
