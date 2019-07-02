
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: 'body'
});


import VueChatScroll from 'vue-chat-scroll';
 import VueTimeago from 'vue-timeago';
 

 Vue.use(VueChatScroll);
 Vue.component('chat-room' , require('./components/laravel-video-chat/ChatRoom.vue'));
 Vue.component('group-chat-room', require('./components/laravel-video-chat/GroupChatRoom.vue'));
 Vue.component('video-section' , require('./components/laravel-video-chat/VideoSection.vue'));
 Vue.component('file-preview' , require('./components/laravel-video-chat/FilePreview.vue'));
 
 Vue.use(VueTimeago, {
     name: 'timeago', // component name, `timeago` by default
     locale: 'en-US',
     locales: {
          'en-US': require('vue-timeago/locales/en-US.json')
     }
 })
 
Vue.use(VueTimeago);
 