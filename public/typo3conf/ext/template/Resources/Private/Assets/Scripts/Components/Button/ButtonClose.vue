<script>
    export default {
        name: 'button-close',
        functional: true,
        props:{
            active: {
                type: Boolean,
                default: false
            }
        },
        render(createElement, {props, listeners, attrs}){
            return createElement("base-button", {
                attrs: attrs,
                props: {
                    ...props,
                    type: 'close'
                },
                on: {
                    ...listeners
                },
            },
            [
                createElement("span", {class: 'bar'}),
                createElement("span", {class: 'bar'}),
            ]);
        }
    }
</script>