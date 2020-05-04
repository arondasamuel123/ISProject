/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform'

import swal from 'sweetalert2'
window.swal = swal;


window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 5000})


import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
    { path: '/users', component: require('./components/Users.vue').default},
    { path: '/lancer', component: require('./components/Freelancer.vue').default },
    { path: '/startup', component: require('./components/Client.vue').default },
    { path: '/portfolio', component: require('./components/Portfolio.vue').default },
  ]

  const router = new VueRouter({
    mode:'history',
    routes, 
     // short for `routes: routes`
  })
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('message-component', require('./components/Messages.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data() {
      return {
        message: '',
        chat: {
          message:[],
          user:[],
          color:[],
          time:[]
        },
        typing:'',
        numberOfUsers:0
      }
      
  },
  watch: {
      message() {
        Echo.private('chat')
        .whisper('typing', {
            name: this.message
        });
      }

  },
  methods:{
      send() {
          if(this.message.length != 0) {
          this.chat.message.push(this.message); 
          this.chat.user.push('You'); 
          this.chat.color.push('success');
          this.chat.time.push(this.getTime());
         
          
          axios.post('/send', {
            message: this.message,
            chat: this.chat
          })
          .then(response => {
            console.log(response);
            this.message = ''
          })
          .catch(error => {
            console.log(error);
          });
          }
      },
      getTime() {
        let time = new Date;
        return time.getHours()+':'+time.getMinutes();
      },
      getOldMessages(){
        axios.post('/getOldMessage')
              .then(response => {
                console.log(response);
                if (response.data != '') {
                    this.chat = response.data;
                }
              })
              .catch(error => {
                console.log(error);
              });
    },
    deleteSession() {
        axios.post('/deleteSession')
        .then(response =>  this.$toaster.info('Chat history deleted'));
    },
  },
  
    router,
    mounted() {
      this.getOldMessages();

      Echo.private('chat')
    .listen('.ChatEvent',(e) => {
        this.chat.message.push(e.message);

        this.chat.user.push(e.user);
        this.chat.color.push('warning');
        this.chat.time.push(this.getTime());
        axios.post('/saveToSession',{
          chat : this.chat
      })
            .then(response => {
            })
            .catch(error => {
              console.log(error);
            });
        // console.log(e);
    })

    .listenForWhisper('typing', (e) => {
        if(e.name != '') {
          this.typing = 'typing...'
        } else {
          this.typing = ''
        }
        
    });
    Echo.join(`chat`)
    .here((users) => {
      this.numberOfUsers = users.length;
        //console.log(users);
    })
    .joining((user) => {
      this.numberOfUsers += 1;
      this.$toaster.success(user.name+  'has joined the room ')
        //console.log(user.name);
    })
    .leaving((user) => {
      this.numberOfUsers -= 1;
      this.$toaster.warning(user.name+ '' +'has left the room ')
        // console.log(user.name);
    });

    }
});
