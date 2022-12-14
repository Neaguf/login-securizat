<template>
  <div class="login-bg">
    <div class="login">
      <Transition name="slide-fade">
        <el-card class="box-card login-box" v-if="show" v-loading="loading">
          <el-form @submit.prevent>
            <h5 class="card-title">Login</h5>
            <el-form-item label="Email">
              <el-input
                type="text"
                v-model="email"
                placeholder="Email"
              ></el-input>
            </el-form-item>
            <el-form-item label="Parola">
              <el-input
                type="password"
                v-model="password"
                placeholder="Parola "
              ></el-input>
            </el-form-item>
            <el-form-item>
              <el-button native-type="submit" type="primary" @click="login()">
                Login
              </el-button>
            </el-form-item>
          </el-form>
        </el-card>
      </Transition>
    </div>
  </div>
</template>
<script setup>
import { ElMessage } from "element-plus";
import { onMounted, inject, ref } from "vue";
import setari from "../setari.js";

const show = ref(false);
const loading = ref(false);
const email = ref("");
const password = ref("");

const axios = inject("axios");
const settings = inject("settings");

async function login() {
  const response = await axios.post(
    "https://florinlogin.brk-dev.ro/public/login",
    {
      email: email.value,
      password: password.value,
    }
  );

  if (response.data.error) {
    ElMessage.error(response.data.error);
  } else {
    let token = response.data.token;
    settings.setToken(token);
  }
}

onMounted(() => {
  show.value = true;
});
</script>

<style lang="less">
body {
  background: url(https://images.unsplash.com/photo-1670845837077-634938a20e6c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1478&q=80);
  background-repeat: no-repeat;
  background-size: cover;
}
.img-logo {
  max-height: 40px;
}
.el-card {
  margin: 50px auto;
  width: 320px;
  background: rgba(255, 255, 255, 0.311) !important;
  border: none;
  outline: none;
}

.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateY(20px);
  opacity: 0;
}
</style>
