var settings = {
  app: null,

  setToken(newToken) {
    window.localStorage.setItem("token-login", newToken);
    this.app.axios.defaults.headers.common["Token"] = newToken;
  },
  getToken() {
    return window.localStorage.getItem("token-login");
  },
};

export default {
  install: (app, oprions) => {
    settings.app = app;
    app.settings = settings;
  },
};
