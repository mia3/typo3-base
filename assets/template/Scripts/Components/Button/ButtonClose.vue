<script>
  export default {
    name: 'button-close',
    functional: true,
    props: {
      active: {
        type: Boolean,
        default: false,
      },
    },
    render(createElement, { props, listeners, attrs }) {
      return createElement('base-button', {
          attrs: attrs,
          props: {
            ...props,
            type: 'close',
          },
          on: {
            ...listeners,
          },
        },
        [
          createElement('span', { class: 'bar' }),
          createElement('span', { class: 'bar' }),
        ]);
    },
  };
</script>

<style scoped>
  .button-close
  {
    background: transparent;
    border: none;
    padding: 0;
    width: auto;
  }

  .button-close:hover,
  .button-close:active,
  .button-close:focus
  {
    background: transparent;
  }

  .button-close
  {
    height: 40px;
    position: relative;
    width: 40px;
  }

  .button-close .bar
  {
    background: var(--orange);
    display: block;
    height: 4px;
    left: 0;
    position: absolute;
    top: 10px;
    transform-origin: center;
    transition: transform 0.4s ease-out, width 0.3s ease-in-out;
    width: 0;
  }

  .button-close--active .bar:first-child
  {
    transform: rotate(45deg);
  }

  .button-close--active .bar:last-child
  {
    transform: rotate(-45deg);
  }

  .button-close--active .bar:first-child,
  .button-close--active .bar:last-child
  {
    width: 25px;
  }
</style>
