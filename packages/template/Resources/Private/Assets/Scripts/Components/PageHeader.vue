<template>
  <header ref="pageHeader" :class="{'header--fixed': isFixed, 'header--static': !isFixed, 'is--scrolling': isScrolling}">
    <slot :close="close" :isOpen="navOpen" :open="open"></slot>
    <div ref="sentinel" class="scroll--sentinel"></div>
    <div :class="{'offCanvas--shown': navOpen}" class="offCanvas-container">
      <div class="backdrop" @click="close"></div>
      <div class="offCanvas-content">
        <slot :close="close" :isOpen="navOpen" :open="open" name="offCanvas"></slot>
      </div>
    </div>
  </header>
</template>

<script>
  export default {
    name: 'page-header',
    props: {
      isFixed: {
        type: Boolean,
        default: true
      }
    },
    data () {
      return {
        navOpen: false,
        isScrolling: false
      };
    },
    mounted () {
      if (this.isFixed) {
        this.initObserver();
      }
    },
    methods: {
      initObserver () {
        const headerObserver = new IntersectionObserver((entries, observer) => {
          entries.forEach(entry => {
            this.isScrolling = !entry.isIntersecting;
          });
        });

        headerObserver.observe(this.$refs.sentinel);
      },
      open () {
        this.navOpen = true;
      },
      close () {
        this.navOpen = false;
      }
    }
  };
</script>
