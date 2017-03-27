<template>
<form @submit.prevent="submit" class="form">
	<div class="form-group">
		<label for="title">Task</label>
		<input type="text" class="form-control" v-model="activity.title" />
	</div>
	<div class="form-group">
		<label for="description">Description</label>
		<input type="text" class="form-control" v-model="activity.content" />
	</div>
	<div class="form-group">

		<label for="due">Date Due</label>
		
		<datepicker v-model="activity.due_date" input-class="form-control"></datepicker>
		
	</div>
	<div class="form-group">
		<label for="assigned">Assigned To</label>
		<select class="form-control" v-model="activity.assigned_id" required >
			<option v-for="user in users" :value="user.id">{{user.name}}</option>

		</select>
	</div>
	<div class="form-group">
		<label for="reminder">Would you like to send a reminder?</label>
		<select class="form-control" v-model="activity.reminder">
			<option selected="selected">Yes</option>
			<option>No</option>

		</select>
	</div>
	<div class="form-group">
		<input type="hidden" v-model="activity.facility_id" :value="facility_id" />
		<button type="submit" class="btn btn-default btn-success">Submit</button>
	</div>
</form>

</template>
<script>
import Datepicker from 'vuejs-datepicker';
import moment from 'moment';
export default {
	props:['action','id', 'user_id','facility_id'],
	components:{
		Datepicker
	},
	data:function(){
		return {
			users:{},
			activity:{},
			show:false,
			year:2017,
			month:5,
			day:25,
			date:{},

		}
	},
	filters: {
		moment: function (date) {
			return moment(date).fromNow();
		}
	},
	methods:{
		create:function(){

		},
		update:function(){

		},
		submit:function(){
			var self = this; 
			if(this.action == 'update'){

			}
			if(this.action == 'create'){
				axios.post('/activities/create', {activity:this.activity}).then(function(response){
					console.log(response); 
					if(response.data.message == "success"){
						self.success();
					}

					//if successful dismiss modal and broadcrast refresh event 
					
				})
			}
		},
		success:function(){
			this.$root.activityIsOpen = false;
			location.reload();
		}

	},
	mounted(){
		var self = this; 
		axios.get('/users/list').then(function(response){
			self.users = response.data; 
			console.log(response);
		});
		if(this.action == 'update'){
			axios.get('/actvities/details/' + this.id).then(function(response){
				self.activity = response.data; 
			});
		}
		if(this.facility_id){
			this.activity.facility_id = this.facility_id;
		}
		

	}
}
</script>