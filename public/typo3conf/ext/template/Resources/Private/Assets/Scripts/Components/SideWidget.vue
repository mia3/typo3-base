<template>
    <div class="side-widget-container">
        <div class="side-widget__backdrop" v-if="isOpen" @click="toggleWidget"></div>
        <slot :toggleWidget="toggleWidget" :isOpen="isOpen"></slot>
    </div>
</template>
<script>
    export default {
        name: 'side-widget',
        data(){
            return {
                open: false
            }
        },
        methods: {
            toggleWidget(){
                this.open = !this.open
            }
        },
        computed: {
            isOpen(){
                return this.open
            }
        }
    }
</script>
