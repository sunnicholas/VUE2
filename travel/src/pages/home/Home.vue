<template>
  <div>
    <div class="home">home</div>
    <router-link to="/list" class="home">列表页</router-link>
  </div>
</template>

<script>
export default {
  name: 'Home'
}
</script>

<style>
  .home {
    front-size: 500px;
  }
</style>
