<template>
  <div class="add-product">
    <h1 class="title">Add Product</h1>
    <form @submit.prevent="addProduct">
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
      <button class="submit-button" type="submit">Add Product</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      title: '',
      price: '',
      description: '',
      category: '',
      image: ''
    };
  },
  methods: {
    addProduct() {
      axios.post(`${import.meta.env.VITE_API_URL}/products`, {
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
@import './addproduct.scss';
</style>