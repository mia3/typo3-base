<template>
    <div :class="containerClass + (invalid ? ' ' + containerClass + '--invalid' : '')">
        <label for="" :class="containerClass + '-label'">
            <template v-if="label">{{label}}:</template>
        </label>
        <div class="formField-control">
            <slot></slot>
            <div v-if="invalid" :class="containerClass + '-error'">{{ validationErrors.first(name) }}</div>
            <div v-if="help" :class="containerClass + '-help'">{{help}}</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'form-field',
        props: {
            name: {
                type: String,
                required: false
            },
            label: {
                type: String,
                required: false
            },
            containerClass: {
                type: String,
                default: 'formField'
            },
            help: {
                type: String
            },
            validationErrors: {
                type: Object
            }
        },
        computed: {
            invalid: function () {
                if (!this.validationErrors || !this.name) {
                    return false;
                }
                return this.validationErrors.has(this.name);
            }
        }
    }
</script>
