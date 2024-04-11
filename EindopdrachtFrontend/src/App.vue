<script>
import Header from './components/header/header.vue';

export default {
  components: {
    Header,
}
}
</script>
<template>
  <Header />
   <main>
      <RouterView />
  </main>
</template>

<style scoped>

</style>