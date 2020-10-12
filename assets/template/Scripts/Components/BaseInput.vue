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
    render(createElement, context) {
      let self = this;
      const {props, data, children, listeners} = context;
      const classes = {};
      const content = [];
      const field = [];
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
          input(event) {
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
      field.push(createElement('div', {class: 'border--effect'}));

      classes[props.baseClass + ' ' + props.containerClass + (data.staticClass ? ' ' + data.staticClass : '')] = true;
      classes[props.baseClass + '--invalid'] = invalid();
      classes[props.baseClass + '--disabled'] = isDisabled;

      if (props.help) {
        content.push(createElement('div', {class: props.baseClass + '-help'}, props.help));
      }
      content.push(createElement('div', {class: 'formField-control'}, field));
      if (invalid()) {
        content.push(createElement('div', {class: props.baseClass + '-validation'}, props.validation));
      }

      return createElement('div', {class: classes}, content);
    },
  };
</script>

<style scoped>
  base-input:before
  {
    content: attr(label);
  }

  base-input:before
  {
    content: attr(label);
  }

  base-input
  {
    display: block;
    float: left;
    width: 100%;
  }

  .baseField .formField-control
  {
    position: relative;
  }

  .baseField input ~ .border--effect:after,
  .baseField textarea ~ .border--effect:after
  {
    background: #ccc;
    bottom: -3px;
    content: '';
    height: 3px;
    left: 50%;
    position: absolute;
    transform: translateX(-50%);
    transition: 0.4s;
    width: 0;
  }

  .baseField .baseField--entered .border--effect:after
  {
    background: linear-gradient(300deg, rgba(75, 17, 58, 1) 0%, rgba(26, 70, 136, 1) 100%); /* w3c */
  }

  .baseField input:focus ~ .border--effect:after,
  .baseField textarea:focus ~ .border--effect:after,
  .baseField .baseField--entered .border--effect:after
  {
    transition: 0.4s;
    width: 100%;
  }


  .baseField .baseField-validation
  {
    font-size: 0.777777777777777em;
    line-height: 18px;
    margin-bottom: -2px;
    padding-top: 2px;
  }

  .baseField.baseField--invalid input,
  .baseField.baseField--invalid textarea
  {
    background-color: #ecd8d8;
  }

  .image--section .baseField .border--effect
  {
    display: none;
  }

  .image--section .baseField input:focus,
  .image--section .baseField textarea:focus
  {
    box-shadow: inset 0 0 10px 1px rgba(0, 0, 0, 0.75);
  }

  .image--section .baseField .baseField--entered input,
  .image--section .baseField .baseField--entered textarea
  {
    box-shadow: inset 0 0 10px 0 rgba(0, 0, 0, 1);
  }
</style>
