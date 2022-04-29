<template>
<div class="container">
    <nav>
      <router-link :to="{name:'Home'}">Home</router-link> |
      <router-link :to="{name:'Create'}">Create</router-link> |
      <router-link :to="{name:'List'}">List</router-link> |
      <router-link :to="{name:'About'}">About</router-link>
    </nav>
    <router-view />
</div>
  
</template>

<script>
</script>

<style>
#app {
}
</style>
