<template>
  <div class="text-center mt-10" style="max-width: 50%; margin: 0 auto">
    <v-btn
      v-for="(menu, index) in menus"
      :key="index"
      class="mr-2 mb-2"
      color="primary"
      :to="menu.href"
      depressed
      outlined
      >{{ menu.title }}</v-btn
    >
  </div>
</template>

<script>
export default {
  name: "MenuView",
  data: () => ({
    menus: [
      { title: "Trang chủ", href: "/" },
      { title: "Quản lý", href: "/manage" },
      { title: "Tháng", href: "/months" },
      { title: "Tuần", href: "/weeks" },
      { title: "Khác", href: "/others" },
    ],
  }),
};
</script>

<style></style>
