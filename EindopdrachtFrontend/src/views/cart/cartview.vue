<template>
    <div class="cart">
      <h1>Your Cart</h1>
      <CartTable />
      <button class="btn btn-primary" @click="placeOrder">Place Order</button>
    </div>
</template>
  
<script>
import CartTable from '@/components/carttable/carttable.vue'
import { useCartStore } from '@/stores/cart'
import { useAuthStore } from '@/stores/auth'
import axios from 'axios'

export default {
    name: 'CartView',
    components: {
        CartTable
    },
    methods: {
        async placeOrder() {
            const cart = useCartStore()
            const auth = useAuthStore()

            if (cart.items.length === 0) {
                alert('Your cart is empty.')
                return
            }

            try {
                const orderResponse = await axios.post(`${import.meta.env.VITE_API_URL}/orders`, {
                user_id: auth.isLoggedIn ? auth.userId : null
                })

                const orderItemsPromises = cart.items.map(item => {
                return axios.post(`${import.meta.env.VITE_API_URL}/orderItems`, {
                    order_id: orderResponse.data.id,
                    product_id: item.id
                })
                })

                await Promise.all(orderItemsPromises)

                cart.clearCart()

                alert('Your order has been placed.')
            }
            catch (error) {
                console.error('Failed to place order:', error);
            }
        }
    }
}
</script>

<style scoped>
@import './cart.scss';
</style>