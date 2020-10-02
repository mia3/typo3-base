<template>
  <div class="canvas" :class="{ 'canvas--active': $store.getters.isNavOpen }">
    <div class="backdrop" @click="close"></div>

    <div class="content">
      <slot/>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'mobile-menu-canvas',
    methods: {
      open() {
        this.$store.commit('openMenu');
      },
      close() {
        this.$store.commit('closeMenu');
      },
    },
  };
</script>

<style scoped>
  .canvas
  {
    bottom: 0;
    height: 100%;
    left: 0;
    position: fixed;
    right: 0;
    top: 0;
    width: 100%;
    pointer-events: none;
  }

  .canvas--active
  {
    pointer-events: all;
  }

  .backdrop
  {
    background: rgba(0, 0, 0, 0.6);
    bottom: 0;
    left: 0;
    opacity: 0;
    position: absolute;
    right: 0;
    top: 0;
    transition: opacity 0.5s ease-out;
  }

  .canvas.canvas--active .backdrop
  {
    opacity: 1;
  }

  .content
  {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    transform: translateX(100%);
    height: 100vh;
    background: white; /* w3c */
    display: flex;
    flex-direction: column;
    margin: 0 0 0 auto;
    max-width: 100%;
    overflow: auto;
    transition: transform 0.5s cubic-bezier(0.69, -0.02, 0.2, 1.23);
    left: auto;
    width: 256px;
  }

  .canvas.canvas--active .content
  {
    transform: translateX(0);
    transition: transform 0.5s cubic-bezier(.59, 0, 0.56, 1);
  }
</style>
