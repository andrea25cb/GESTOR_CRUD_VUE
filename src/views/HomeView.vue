<template>
  <hello-world />
</template>

<script>
  import HelloWorld from '../components/HomeView'

  export default {
    name: 'HomeView',

    components: {
      HelloWorld,
    },
  }
</script>

<style>
body{
  background-image: url('https://i.pinimg.com/564x/11/71/f8/1171f82f8594e8e6012f3d2ece638068.jpg');
  background-size:100% 100%;
}
</style>