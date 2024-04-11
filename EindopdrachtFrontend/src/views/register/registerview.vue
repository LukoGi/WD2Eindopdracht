<template>
    <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <h2 class="text-center">Register</h2>
        <p class="text-center">If you already have an account, you should <a href="/login">login</a></p>
        <form @submit.prevent="register">
          <div class="form-group mb-3">
            <input type="text" class="form-control" id="username" v-model="username" placeholder="Username/email" required>
          </div>
          <div class="form-group mb-3">
            <input type="password" class="form-control" id="password" v-model="password" placeholder="Password (8+ characters long)" required>
          </div>
          <button type="submit" class="btn btn-primary mt-3 w-100">Register</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
        username: '',
        password: ''
        };
    },
    methods: {
        register() {
            axios.post(`${import.meta.env.VITE_API_URL}/users`, {
                username: this.username,
                password: this.password
            })
            .then(response => {
                this.$router.push('/login');
            })
            .catch(error => {
                console.error(error);
            });
        }
    }
};
</script>

<style scoped>
@import './register.scss';
</style>