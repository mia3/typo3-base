<script>
  export default {
    name: 'resizeable',
    data () {
      return {
        initialHeight: 0
      };
    },
    methods: {
      resizeTextarea (event) {
        if (event.target.scrollHeight > this.initialHeight) {
          event.target.style.height = 'auto';
          event.target.style.height = (event.target.scrollHeight) + 'px';
        } else {
          event.target.style.height = '';
        }
      }
    },
    mounted () {
      this.initialHeight = this.$el.scrollHeight;
      this.$el.setAttribute('style', 'overflow-y:hidden;');
      this.$el.addEventListener('input', this.resizeTextarea);
    },
    beforeDestroy () {
      this.$el.removeEventListener('input', this.resizeTextarea);
    },
    render () {
      return this.$slots.default[0];
    }
  };
</script>
