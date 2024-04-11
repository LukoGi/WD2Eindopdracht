<script>
import Header from './components/header/header.vue';
import Footer from './components/footer/footer.vue';

export default {
  components: {
    Header,
    Footer
}
}
</script>
<template>
  <Header />
   <main>
      <RouterView />
  </main>
  <Footer />
</template>

<style scoped>

</style>