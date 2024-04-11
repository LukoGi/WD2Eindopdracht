import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    isLoggedIn: false,
    jwt: null,
  }),
  getters: {
    getJwt: (state) => state.jwt, 
  },
  actions: {
    login(jwt) {
      this.isLoggedIn = true;
      this.jwt = jwt;
      localStorage.setItem('jwt', jwt);
    },
    logout() {
      this.isLoggedIn = false;
      this.jwt = null;
      localStorage.removeItem('jwt');
    },
    checkAuth() {
      const jwt = localStorage.getItem('jwt');
      this.isLoggedIn = jwt !== null;
      this.jwt = jwt; 
    }
  }
})