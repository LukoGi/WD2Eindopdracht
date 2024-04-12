<template>
    <div class="card admin-card h-100">
      <div class="card-body">
        <img class="img-fluid" :src="product.image" :alt="product.title">
        <h2 class="product-title">{{ product.title }}</h2>
        <p class="category">{{ product.category }}</p>
        <p class="description">{{ product.description }}</p>
      </div>
      <div class="card-footer">
        <span class="float-start"><h3 class="m-1">€{{ product.price.toFixed(2) }}</h3></span>
        <button class="btn btn-danger float-end" @click="removeProduct">-</button>
        <button class="btn btn-primary float-end" @click="editProduct">Edit</button>
      </div>
    </div>
</template>

<script>
export default {
    name: 'AdminCard',
    props: {
        product: {
        type: Object,
        required: true
        }
    },
    methods: {
        editProduct() {
        this.$emit('edit', this.product);
        },
        removeProduct() {
        this.$emit('remove', this.product);
        }
    }
};
</script>

<style scoped>
@import './admincard.scss';
</style>