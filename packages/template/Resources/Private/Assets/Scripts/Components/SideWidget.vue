<template>
  <div class="side-widget-container">
    <div @click="toggleWidget" class="side-widget__backdrop" v-if="isOpen"></div>
    <slot :isOpen="isOpen" :toggleWidget="toggleWidget"></slot>
  </div>
</template>
<script>
  export default {
    name: 'side-widget',
    data () {
      return {
        open: false
      }
    },
    methods: {
      toggleWidget () {
        this.open = !this.open
      }
    },
    computed: {
      isOpen () {
        return this.open
      }
    }
  }
</script>
