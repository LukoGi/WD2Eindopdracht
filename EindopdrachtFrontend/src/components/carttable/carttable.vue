<template>
    <div class="container mt-5">
        <table class="table" v-if="cartItems.length">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in cartItems" :key="index">
                    <td>{{ item.title }}</td>
                    <td>€{{ item.price.toFixed(2) }}</td>
                    <td>
                        <button class="btn btn-danger" @click="removeFromCart(item)">Remove</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <h4 v-if="cartItems.length">Total Price: €{{ totalPrice.toFixed(2) }}</h4>
        <p v-else>Your cart is empty.</p>
    </div>
</template>

<script>
import { useCartStore } from '@/stores/cart'

export default {
    name: 'CartTable',
    computed: {
        cartItems() {
            const cart = useCartStore()
            return cart.items
        },
        totalPrice() {
            const cart = useCartStore()
            return cart.totalPrice
        }
    },
    methods: {
        removeFromCart(item) {
            const cart = useCartStore()
            cart.removeFromCart(item)
        }
    }
}
</script>

<style scoped>
@import './carttable.scss';
</style>