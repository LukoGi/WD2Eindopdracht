import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: [],
  }),
  getters: {
    totalItems(state) {
      return state.items.length
    },
    totalPrice(state) {
      return state.items.reduce((total, item) => total + item.price, 0)
    },
  },
  actions: {
    addToCart(item) {
      this.items.push(item)
    },
    removeFromCart(item) {
      const index = this.items.findIndex(i => i.id === item.id)
      if (index !== -1) {
        this.items.splice(index, 1)
      }
    },
    clearCart() {
      this.items = []
    },
  }
})