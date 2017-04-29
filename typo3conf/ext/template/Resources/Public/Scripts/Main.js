import Vue from 'vue';
import '../Styles/Main.css';

require.context('./Components/', true, /\.vue$/).keys().forEach(function (elementPath) {
    let element = require('./Components/' + elementPath.replace('./', ''));
    Vue.component(element.name, element);
});

new Vue({
    el: '.vue'
})
