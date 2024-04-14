<template>
    <div class="edit-product">
        <h1 class="title">Edit Product</h1>
        <form @submit.prevent="editProduct">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" v-model="title" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" v-model="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" v-model="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="category" v-model="category" required>
        </div>
        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="text" id="image" v-model="image" required>
        </div>
        <button class="submit-button" type="submit">Edit Product</button>
        </form>
    </div>
</template>
  
<script>
import axios from 'axios';
export default {
    data() {
        return {
        id: this.$route.params.id,
        title: '',
        price: '',
        description: '',
        category: '',
        image: ''
        };
    },
    mounted() {
        axios.get(`${import.meta.env.VITE_API_URL}/products/${this.id}`)
        .then(response => {
            this.title = response.data.title;
            this.price = response.data.price;
            this.description = response.data.description;
            this.category = response.data.category;
            this.image = response.data.image;
        })
        .catch(error => {
            console.error('Failed to fetch product:', error);
        });
    },
    methods: {
        editProduct() {
        axios.put(`${import.meta.env.VITE_API_URL}/products/${this.id}`, {
            title: this.title,
            price: this.price,
            description: this.description,
            category: this.category,
            image: this.image
        })
        .then(response => {
            this.$router.push('/admin');
        })
        .catch(error => {
            console.error(error);
        });
        }
    }
};
</script>
  
<style scoped>
@import './editproduct.scss';
</style>