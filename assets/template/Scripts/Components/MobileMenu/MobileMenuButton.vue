<template>
  <button class="hamburger hamburger--collapse" :class="activeClass" type="button" @click="toggleMenu">
    <span class="hamburger-box">
      <span class="hamburger-inner"></span>
    </span>
  </button>
</template>

<script>
  export default {
    name: 'mobile-menu-button',
    computed: {
      activeClass() {
        return {
          'is-active': this.$store.getters.isNavOpen
        };
      }
    },
    methods: {
      toggleMenu() {
        this.$store.commit('toggleMenu');
      }
    }
  };
</script>

<style scoped>
  .hamburger-inner,
  .hamburger-inner::after,
  .hamburger-inner::before
  {
    background-color: var(--color-primary);
  }
</style>
