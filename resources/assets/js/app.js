
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

Vue.component('example', require('./components/Example.vue'));
Vue.component('modal', require('./components/Modal.vue'));
Vue.component('notepad', require('./components/Notepad.vue'));
Vue.component('activity-form', require('./components/ActivityForm.vue'));
Vue.component ('activity-modal', require('./components/ActivityModal.vue'));
Vue.component('main-dash', require('./components/Maindash.vue'));
Vue.component('facility-view', require('./components/FacilityView.vue'));

//w

const app = new Vue({
    el: '#app',
    data: {
    	modalIsOpen:false,
        activityIsOpen:false
    },
    methods: {
    	 showModal(){
    		this.modalIsOpen = true;
    	},
        showActivity(){
            this.activityIsOpen = true;
        },
        completeActivity(activity, user){
            //alert('Close!');
            if(activity.assigned_id == user.id){
                axios.get('/activities/complete/' + activity.id).then(function(response){
                    console.log(response);
                    location.reload();
                });
            } else {
                alert('This task is not assigned to you');
            }
            console.log(activity);
            console.log(user);
            //a
        }
    },
    mounted(){
    	console.log('Mounted');
    }
});
