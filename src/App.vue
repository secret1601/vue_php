<template>
  <div class="container">

    <nav>
      <router-link :to="{name:'Home'}">Home</router-link> |
      <router-link :to="{name:'Create'}">Ceate</router-link> |
      <router-link :to="{name:'List'}">List</router-link> |
      <router-link :to="{name:'About'}">About</router-link>
    </nav>

    <router-view />

    <!-- 안내창 -->
    <ToastBox 
    :message="toastMessage" 
    v-if="toastShow" />
    
  </div>


</template>

<script>
  import ToastBox from '@/components/ToastBox.vue'
  import {useToast} from '@/composables/toast.js'

  export default {
    components: {
      ToastBox
    },
    setup() {
      const {
        toastMessage,
        toastShow,
        triggerToast
      } = useToast();

      return {
        toastMessage,
        toastShow,
        triggerToast
      }
    }
  }
  
</script>

<style>
  #app {}
</style>