<template>
    <div :class="{'header--fixed': isFixed, 'header--static': !isFixed, 'is--scrolling': isScrolling}" ref="pageHeader">
        <slot :open="open" :close="close" :isOpen="navOpen"></slot>
        <div class="scroll--sentinel" ref="sentinel"></div>
        <div class="offCanvas__container" :class="{'offCanvas--shown': navOpen}">
            <div class="backdrop" @click="close"></div>
            <div class="offCanvas__content">
                <slot name="offCanvas" :open="open" :close="close" :isOpen="navOpen"></slot>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'page-header',
        props:{
            isFixed: {
                type: Boolean,
                default: true
            }
        },
        data(){
            return{
                navOpen: false,
                isScrolling: false,
            }
        },
        mounted(){
            if(this.isFixed){
                this.initObserver();
            }
        },
        methods: {
            initObserver(){
                const headerObserver = new IntersectionObserver((entries, observer)=>{
                    entries.forEach(entry => {
                        this.isScrolling = !entry.isIntersecting
                    })
                });

                headerObserver.observe(this.$refs.sentinel);
            },
            open(){
                this.navOpen = true;
            },
            close(){
                this.navOpen = false;
            }
        },
    }
</script>
