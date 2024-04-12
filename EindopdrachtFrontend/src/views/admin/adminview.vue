<template>
    <div class="admin">
      <h1>Admin Panel</h1>
      <div class="row">
        <div class="col-lg-3 col-md-6 mb-4" v-for="product in products" :key="product.id">
          <AdminCard :product="product" @edit="editProduct" @remove="removeProduct" />
        </div>
      </div>
    </div>
</template>

<script>
import axios from 'axios';
import AdminCard from '@/components/admincard/admincard.vue';

export default {
    name: 'AdminView',
    components: {
        AdminCard
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
    },
    methods: {
        editProduct(product) {
        // Handle the edit action
        // You can redirect to a product edit page or open a modal for editing the product
        },
        removeProduct(product) {
            axios.delete(`${import.meta.env.VITE_API_URL}/products/${product.id}`)
                .then(response => {
                    this.products = this.products.filter(p => p.id !== product.id);
                })
                .catch(error => {
                    console.error('Failed to delete product:', error);
                });
        }
    }
};
</script>

<style scoped>
@import './admin.scss';
</style>