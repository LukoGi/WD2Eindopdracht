<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark full-width">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">RoyalSupps</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link class="nav-link" to="/">Home</router-link>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Account
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li v-if="!isLoggedIn"><router-link class="dropdown-item" to="/register">Register</router-link></li>
              <li v-if="!isLoggedIn"><router-link class="dropdown-item" to="/login">Login</router-link></li>
              <li v-if="isLoggedIn"><a class="dropdown-item" href="#" @click="logout">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="d-flex">
        <router-link class="nav-link" to="/cart">
          <i class="bi bi-cart-fill"></i>
        </router-link>
      </div>
    </div>
  </nav>
</template>

<script>
import { useAuthStore } from '@/stores/auth';

export default {
  name: 'Header',
  computed: {
    isLoggedIn() {
      const auth = useAuthStore();
      return auth.isLoggedIn;
    }
  },
  methods: {
    logout() {
      const auth = useAuthStore();
      auth.logout();
      this.$router.push('/login');
    }
  }
};
</script>

<style scoped>
@import './header.scss';
</style>