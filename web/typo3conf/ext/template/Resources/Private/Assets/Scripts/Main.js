import Vue from 'vue';
import '../Styles/Main.css';

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


new Vue({
    el: '.vue'
})

