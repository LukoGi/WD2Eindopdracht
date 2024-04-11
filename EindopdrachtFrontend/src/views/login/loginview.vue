<template>
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="text-center">Log in</h2>
            <p class="text-center">If you don't have an account yet, you should <a href="/register">register</a></p>
            <form @submit.prevent="login">
            <div class="form-group mb-3">
                <input type="text" class="form-control" id="username" v-model="username" placeholder="Username/email" required>
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control" id="password" v-model="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3 w-100">Log in</button>
            </form>
        </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { useAuthStore } from '@/stores/auth';

export default {
    data() {
        return {
        username: '',
        password: ''
        };
    },
    methods: {
        login() {
            axios.post(`${import.meta.env.VITE_API_URL}/users/login`, {
                username: this.username,
                password: this.password
            })
            .then(response => {
                if (response.data.jwt) {
                    axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.jwt}`;
                    const auth = useAuthStore();
                    auth.login(response.data.jwt);
                    this.$router.push('/');
                } else {
                    console.error('Login attempt failed');
                }
            })
            .catch(error => {
                console.error(error);
            });
        }
    }
};
</script>

<style scoped>
@import './login.scss';
</style>