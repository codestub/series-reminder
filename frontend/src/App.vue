<template>
  <div id="app">
    <navigation></navigation>
    <router-view/>
  </div>
</template>

<script>
  import Navigation from '@/components/widgets/Navigation.vue';
export default {
  name: 'App',
  components: {
    Navigation
  }
};
</script>

<style>
</style>
