<template>
  <v-container>
    <month-component />
  </v-container>
</template>

<script>
import monthComponent from "@/components/SM/month-component.vue";
export default {
  components: { monthComponent },
  name: "MonthsView",
};
</script>

<style></style>
