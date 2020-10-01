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
    render (createElement, { props, listeners, attrs }) {
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
