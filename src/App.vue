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
    <transition name="fade">
      <ToastBox :message="toastMessage" v-if="toastShow" />
    </transition>
    
    
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

  .fade-enter-active,
  .fade-leave-active {
    transition: opacity 0.5s;
  }
  .fade-enter-from,
  .fade-leave-to {
    opacity: 0;
  }
  .fade-enter-to,
  .fade-leave-from {
    opacity: 1;
  }

</style>