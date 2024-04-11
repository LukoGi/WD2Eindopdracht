<template>
    <div class="card product-card h-100">
        <div class="card-body">
            <img class="img-fluid" :src="product.image" :alt="product.title">
            <h2 class="product-title">{{ product.title }}</h2>
            <p class="category">{{ product.category }}</p>
            <p class="description">{{ product.description }}</p>
        </div>
        <div class="card-footer">
            <span class="float-start"><h3 class="m-1">€{{ product.price.toFixed(2) }}</h3></span>
            <button class="btn btn-secondary rounded-circle float-end">+</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductCard',
    props: {
        product: {
        type: Object,
        required: true
        }
    }
};
</script>

<style scoped>
@import './productcard.scss';
</style>