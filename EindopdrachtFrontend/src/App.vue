<script>
import HeaderComponent from './components/header/headercomponent.vue';
export default {
  components: {
    HeaderComponent
}
}
</script>
<template>
  <HeaderComponent />
   <main>
      <RouterView />
  </main>
</template>

<style scoped>

</style>