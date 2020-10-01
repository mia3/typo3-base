<script>
  export default {
    name: 'button-burger',
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
            type: 'burger',
          },
          on: {
            ...listeners,
          },
        },
        [
          createElement('span', { class: 'bar' }),
          createElement('span', { class: 'bar center' }),
          createElement('span', { class: 'bar' }),
        ]);
    },
  };
</script>

<style scoped>
  .button-burger
  {
    border: none;
    margin: 0;
    padding: 7.5px 0.66666666em;
    transition: padding 0.3s ease-in;
    width: auto;
  }

  .button-burger:hover,
  .button-burger:focus,
  .button-burger:active
  {
    background: transparent;
  }


  .button-burger .bar
  {
    background: var(--orange);
    display: block;
    height: 10px;
    transition: width cubic-bezier(.81, -0.23, 0, 1.35) 0.3s, transform 0.9s cubic-bezier(.81, -0.23, 0, 1.35);
    width: 100px;
  }

  .button-burger .bar + .bar
  {
    margin-top: 10px;
  }

  .button-burger.button-burger--active .bar
  {
    width: 0;
  }

  .button-burger.button-burger--active .bar:first-child
  {
    transform: translateY(var(--base-2));
    transition: transform 0.3s cubic-bezier(.81, -0.23, 0, 1.35), width cubic-bezier(.81, -0.23, 0, 1.35) 0.9s;
  }

  .button-burger.button-burger--active .bar:last-child
  {
    transform: translateY(calc(var(--base-2) * -1));
    transition: transform 0.3s cubic-bezier(.81, -0.23, 0, 1.35), width cubic-bezier(.81, -0.23, 0, 1.35) 0.9s;
  }
</style>
