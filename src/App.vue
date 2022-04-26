<template>
  <nav>
    <router-link to="/">Home</router-link>
    <br>
    <router-link to="/create">Create</router-link>
    <br>
    <router-link to="/update">Update</router-link>
    <br>
    <router-link to="/delete">Delete</router-link>
    <br>
    <router-link to="/list">List</router-link>
    <br>
    <router-link to="/about">About</router-link>
  </nav>
  <router-view />
</template>

<script>
</script>

<style>
#app {
}
</style>
