import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    isLoggedIn: false,
    jwt: null,
    userId: null,
  }),
  getters: {
    getJwt: (state) => state.jwt, 
    getUserId: (state) => state.userId,
  },
  actions: {
    login(jwt, userId) {
      this.isLoggedIn = true;
      this.jwt = jwt;
      this.userId = userId;
      localStorage.setItem('jwt', jwt);
      localStorage.setItem('userId', userId);
    },
    logout() {
      this.isLoggedIn = false;
      this.jwt = null;
      this.userId = null;
      localStorage.removeItem('jwt');
      localStorage.removeItem('userId');
    },
    checkAuth() {
      const jwt = localStorage.getItem('jwt');
      const userId = localStorage.getItem('userId');
      this.isLoggedIn = jwt !== null;
      this.jwt = jwt; 
      this.userId = userId;
    }
  }
})