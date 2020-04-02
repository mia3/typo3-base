import Vue from 'vue';


/**
 * Autoloading components from "Components"-directory
 */
require.context('./Components/', true, /\.vue$/).keys().forEach(function (elementPath) {
    let component = require('./Components/' + elementPath.replace('./', '')).default;
    if (typeof(component.name) == 'undefined') {
        console.warn('Component is missing name!', component);
        return;
    }
    Vue.component(component.name, component)
});

Vue.directive('click-outside', {
    bind: function (el, binding, vnode) {
        el.event = function (event) {
            // here I check that click was outside the el and his childrens
            if (!(el == event.target || el.contains(event.target))) {
                // and if it did, call method provided in attribute value
                vnode.context[binding.expression](event);
            }
        };
        document.body.addEventListener('click', el.event)
    },
    unbind: function (el) {
        document.body.removeEventListener('click', el.event)
    },
});

Vue.directive('modal-trigger', {
    inserted: function(el, binding, vnode){
        el.addEventListener("click", ()=>{
            const modalId = binding.value;
            const root = vnode.context.$root;
            const modal = root.$refs[modalId];
            if(!modal){
                throw 'Your modal is not registered as ref within in the $root component';
            }
            if(modal.$options._componentTag !== 'modal-dialog'){
                throw 'Use modal-trigger in combination with the modal-dialog component.'
            }
            modal.toggleModal();
        })
    }
});

new Vue({
    el: '.vue',
    data(){
        return{
            state: {}
        }
    },
    methods:{
        hasState(id, value){
            return this.state[id] == value;
        },
        goBack(evt){
            window.history.back();
        }
    }
});
