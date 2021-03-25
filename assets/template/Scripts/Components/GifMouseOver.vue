<template>
  <div @mouseover="mouseoverHandler()"
    @mouseleave="mouseleaveHandler()">
    <slot></slot>
  </div>
</template>

<script>
  import Freezeframe from 'freezeframe';

  export default {
    name: 'gif-mouse-over',
    props: {},
    data() {
      return {
        freezeframe: null,
        gifElement: null
      };
    },
    methods: {
      mouseoverHandler() {
        this.freezeframe.start();
      },
      mouseleaveHandler() {
        this.freezeframe.stop();
      }
    },
    mounted() {
      if ('img' === this.$slots.default[0].elm.localName) {
        this.gifElement = this.$slots.default[0].elm;
      } else {
        this.gifElement = this.$slots.default[0].elm.getElementsByTagName('img')[0];
      }
      this.freezeframe = new Freezeframe(this.gifElement, {
        trigger: false,
        overlay: true
      });
    },
    destroyed() {
      this.freezeframe.destroy();
    }
  };
</script>
