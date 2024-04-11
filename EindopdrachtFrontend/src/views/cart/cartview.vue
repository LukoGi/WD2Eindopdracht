<template>
    <div class="cart">
      <h1>Your Cart</h1>
      <CartTable />
    </div>
  </template>
  
  <script>
  import CartTable from '@/components/carttable/carttable.vue'
  
  export default {
    name: 'CartView',
    components: {
      CartTable
    }
  }
  </script>
  
  <style scoped>
  @import './cart.scss';
  </style>