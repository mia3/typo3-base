<template>
  <div class="side-widget-container">
    <div v-if="isOpen" class="side-widget__backdrop" @click="toggleWidget"></div>
    <slot :isOpen="isOpen" :toggleWidget="toggleWidget"></slot>
  </div>
</template>
<script>
  export default {
    name: 'side-widget',
    data () {
      return {
        open: false,
      };
    },
    methods: {
      toggleWidget () {
        this.open = !this.open;
      },
    },
    computed: {
      isOpen () {
        return this.open;
      },
    },
  };
</script>
