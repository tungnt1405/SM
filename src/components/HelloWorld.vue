<template>
  <v-container>
    <div
      class="calendly-inline-widget"
      data-url="https://calendly.com/tung140520/30min"
      style="min-width: 320px; height: 630px"
    ></div>
  </v-container>
</template>

<script>
export default {
  name: "HelloWorld",
  mounted() {
    const recaptchaScript = document.createElement("script");
    recaptchaScript.setAttribute(
      "src",
      "https://assets.calendly.com/assets/external/widget.js"
    );
    document.head.appendChild(recaptchaScript);
  },
  data: () => ({}),
};
</script>
