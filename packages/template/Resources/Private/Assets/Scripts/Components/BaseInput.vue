<script>
  export default {
    name: 'base-input',
    functional: true,
    props: {
      value: {},
      label: {
        type: String,
        required: false,
      },
      baseClass: {
        type: String,
        default: 'baseField',
      },
      containerClass: {
        type: String,
        default: '',
      },
      invalid: {
        type: Boolean | Number,
        default: false,
      },
      type: {
        type: String,
        default: 'text',
      },
      autosize: {
        type: Boolean,
        default: false,
      },
      help: {
        type: String,
      },
      validation: {
        type: String,
      },
      element: {
        type: String,
        default: 'input',
      },
    },
    render (createElement, context) {
      let self = this;
      const { props, data, children, listeners } = context;
      const classes = {};
      const content = [];
      const field = [];
      console.log(data);
      const hasField = !!children;
      const input = hasField ? children[0] : null;
      const type = hasField ? input.data.attrs.type : props.type;
      const isDisabled = hasField ? !!input.data.attrs.disabled : !!data.attrs.disabled;
      const attrs = hasField ? input.data.attrs : data.$attrs;
      const element = hasField ? children[0].tag : props.element;
      const value = hasField ? input.data.attrs.value : props.value;

      const invalid = () => {
        return !!props.invalid;
      };

      attrs.placeholder = props.label ? props.label : attrs.placeholder;

      const formInput = createElement(element, {
        class: props.baseClass + '-input ' + 'field--' + type,
        attrs: {
          ...attrs,
          type: type,
        },
        domProps: {
          value: value,
        },
        on: {
          ...listeners,
          input (event) {
            const contentClass = props.baseClass + '--entered';
            if (!!event.target.value) {
              event.target.parentNode.classList.add(contentClass);
            } else {
              event.target.parentNode.classList.remove(contentClass);
            }
            if (data.on) {
              if (data.on.input) {
                data.on.input(event.target.value);
              }
            }
          },
        },

      });

      if (props.autosize) {
        field.push(createElement('resizeable', [formInput]));
      } else {
        field.push(formInput);
      }
      field.push(createElement('div', { class: 'border--effect' }));

      classes[props.baseClass + ' ' + props.containerClass + (data.staticClass ? ' ' + data.staticClass : '')] = true;
      classes[props.baseClass + '--invalid'] = invalid();
      classes[props.baseClass + '--disabled'] = isDisabled;

      if (props.help) {
        content.push(createElement('div', { class: props.baseClass + '-help' }, props.help));
      }
      content.push(createElement('div', { class: 'formField-control' }, field));
      if (invalid()) {
        content.push(createElement('div', { class: props.baseClass + '-validation' }, props.validation));
      }

      return createElement('div', { class: classes }, content);
    },
  };
</script>
