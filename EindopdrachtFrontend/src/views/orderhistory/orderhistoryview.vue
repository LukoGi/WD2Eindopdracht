<template>
    <div class="container">
        <h1>Your Order History</h1>
        <div v-if="orders.length === 0">
            <p>You have no orders.</p>
        </div>
        <div v-else>
            <div v-for="order in orders" :key="order.id" class="card mb-3">
                <div class="card-header">
                    Order #{{ order.id }}
                </div>
                <div class="card-body">
                    <p>Order Date: {{ order.created_at }}</p>
                    <div v-if="order.items.length > 0">
                        <h5>Products:</h5>
                        <ul>
                            <li v-for="item in order.items" :key="item.id">
                                {{ item.title }} - Price: €{{ item.price }}
                            </li>
                        </ul>
                    </div>
                    <div v-else>
                        <p>No products in this order.</p>
                    </div>
                </div>
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
        orders: []
        };
    },
    async mounted() {
        const auth = useAuthStore();
        try {
            const response = await axios.get(`${import.meta.env.VITE_API_URL}/orders/${auth.userId}`);
            const orders = response.data;

            const orderItemsRequests = orders.map(order => 
            axios.get(`${import.meta.env.VITE_API_URL}/orderItems/${order.id}`)
            );
            const orderItemsResponses = await Promise.all(orderItemsRequests);

            for (let i = 0; i < orderItemsResponses.length; i++) {
                const orderItems = orderItemsResponses[i].data;
                for (let j = 0; j < orderItems.length; j++) {
                    const productResponse = await axios.get(`${import.meta.env.VITE_API_URL}/products/${orderItems[j].product_id}`);
                    orderItems[j].title = productResponse.data.title;
                    orderItems[j].price = productResponse.data.price;
                }
                orders[i].items = orderItems;
            }

            this.orders = orders;
        } catch (error) {
            console.error('Failed to fetch order history:', error);
        }
    }
};
</script>

<style scoped>
@import './orderhistory.scss';
</style>