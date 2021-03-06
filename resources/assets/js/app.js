
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('comment-list', require('./components/Comment-list.vue'));
Vue.component('comment', require('./components/Comment.vue'));
Vue.component('comment-form', require('./components/Comment-form.vue'));
Vue.component('flash', require('./components/Flash.vue'));

window.Event = new Vue();
window.flash = function (message) {
    Event.$emit('flash', message);
};

const app = new Vue({
    el: '#app'
});
