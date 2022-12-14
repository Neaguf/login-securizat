import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
// import axios from "axios";
import Settings from "./setari.js";
import ElementPlus from "element-plus";
import "element-plus/dist/index.css";

let app = createApp(App);

app.use(router);

//axios settings
import axios from "axios";
import VueAxios from "vue-axios";

app.use(Settings);
app.provide("settings", app.settings);

app.use(VueAxios, axios);
app.use(ElementPlus);
app.provide("axios", app.config.globalProperties.axios);

axios.defaults.headers.common["Token"] = app.settings.getToken();

app.mount("#app");
