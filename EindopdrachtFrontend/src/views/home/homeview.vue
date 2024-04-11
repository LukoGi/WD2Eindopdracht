<template>
  <div class="home">
    <div class="banner alert text-center py-5" role="alert">
      <h2 class="alert-heading display-4">Welcome to RoyalSupps</h2>
      <p class="lead">Unlock Your Potential: Elevate Your Fitness Journey with our Premium Supplements</p>
    </div>
    <h1>Our Products</h1>
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-4" v-for="product in products" :key="product.id">
        <ProductCard :product="product" />
      </div>
    </div>
  </div>
</template>
  
<script>
import axios from 'axios';
import ProductCard from '@/components/productcard/productcard.vue';

export default {
  name: 'HomeView',
  components: {
  ProductCard
  },
  data() {
    return {
      products: []
    };
  },
  mounted() {
    axios.get(`${import.meta.env.VITE_API_URL}/products`)
      .then(response => {
        this.products = response.data;
      })
      .catch(error => {
        console.error('Failed to fetch products:', error);
      });
  }
};
</script>
  
<style scoped>
@import './home.scss';
</style>