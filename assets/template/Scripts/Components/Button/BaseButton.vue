<script>
  export default {
    name: 'base-button',
    functional: true,
    props: {
      active: {
        type: Boolean,
        default: false,
      },
      baseClass: {
        type: String,
        default: 'button',
      },
      type: {
        type: String,
        required: true,
      },
    },
    render (createElement, { props, listeners, attrs, children }) {
      const classes = {};
      classes[props.baseClass] = true;
      classes[props.baseClass + '-' + props.type] = true;
      classes[props.baseClass + '-' + props.type] = true;
      classes[props.baseClass + '-' + props.type + '--active'] = props.active;
      return createElement('button', {
          attrs: attrs,
          on: {
            ...listeners,
          },
          class: classes,
        },
        children,
      );
    },
  };
</script>
