<template>
  <div class="text-center mt-10" style="max-width: 50%; margin: 0 auto">
    <v-btn
      v-for="(menu, index) in menus"
      :key="index"
      class="mr-2"
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
      { title: "Danh sách", href: "/" },
      { title: "Tháng", href: "/about" },
      { title: "Tuần", href: "/weeks" },
      { title: "Khác", href: "/others" },
    ],
  }),
};
</script>

<style></style>
