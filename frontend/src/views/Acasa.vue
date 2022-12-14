<template>
  <div class="acasa">
    <h1>Aceasta e pagina principala</h1>
  </div>
</template>

<script setup>
import { onMounted, inject, ref } from "vue";
import setari from "../setari.js";
import router from "../router/index.js";
const axios = inject("axios");

async function load() {
  // console.log("merge");
  const response = await axios.post(
    "https://florinlogin.brk-dev.ro/public/home",
    {}
  );
  if (response.data.logat) {
  } else {
    router.push("/login");
  }
}

onMounted(() => {
  // show.value = true;
  load();
});
</script>
