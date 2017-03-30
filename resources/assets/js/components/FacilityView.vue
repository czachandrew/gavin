<template>
	<div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>{{facility.name}} - {{facility.phone}}

					<span v-if="facility.possible !== ''" class="pull-right">Possibility: {{facility.possible}}</span>

				</h1>
			</div>
			<div class="panel-body">
				<div class="col-md-8">
					<p>Website: <a target="_blank" :href="facility.link">{{facility.link}}</a></p>

					<form action="" method="POST" @submit.prevent="addNote()" accept-charset="UTF-8">
						<div class="form-group">
							<label for="notes">Add a Note:</label>
							<textarea id="body" name="body" class="form-control" v-model="newNote" rows="5"></textarea>


						</div>
						<div class="form-group">
							<div class="">
								<button type="submit" class="btn btn-default btn-success">Add Note</button>
							</div>
						</div>
					</form>
					<form action="'markit/' . facility.id" @submit.prevent="markIt()" method="POST">
						<div class="form-group">
							<label for="match">Could this be a potential match?</label>
							{{csrf_field() }}
							<button type="submit" name="potential" value="yes" class="btn btn-default btn-primary">Yes</button>
							<button type="submit" name="potential" value="no" class="btn btn-default btn-danger">No</button>
							<button type="submit" name="potential" value="maybe" class="btn btn-default btn-warning">Maybe</button>

						</div>
					</form>
				</div>
				<div class="col-md-3 col-md-offset-1">
					<p><span style="font-weight:bold;">Phone:</span><br> {{facility.phone}} </p>
					<p><span style="font-weight:bold;">Address:</span><br> {{facility.address}}<br>{{facility.city}}, {{facility.state}}</p>

					<!-- Display the main contact info here --> 
					<p v-if="facility.contact && facility.contact !== ''"><span style="font-weight:bold;">Contact Person:</span><br> {{facility.contact.name}}<br>

						<a v-if="facility.contact.email" :href="'mailto:' + facility.contact.email">{{facility.contact.email}} </a><br>


						<span v-if="facility.contact.phone && facility.contact.phone !== ''">{{facility.contact.phone}}</span>

					</p>
					
					<!-- Show me the button to create a contact here --> 
					<button v-else type="button" @click="$root.showModal" class="btn btn-default btn-primary">Add a Contact Person</button>
					

					<button type="button" @click="$root.showActivity" class="btn btn-default btn-success">Create Follow up</button>
				</div>

			</div>

		</div>
	
<div class="row">
	<div class="col-md-6 col-md-offset-1">
		
		<h3>Notes:</h3>

		<div v-if="facility.notes !== ''">


			<div v-for="note in facility.notes">
				<div v-if="note.call_id > 0" class="panel panel-success">
					<div class="panel-heading">On {{note.created_at}} {{note.user.name}} called </div>
					<div class="panel-body"><p>{{note.body}}</p></div>
				</div>


				<div v-else class="panel panel-default">
					<div class="panel-heading">On {{note.created_at}} {{note.user.name}} said...</div>
					<div class="panel-body"><p>{{note.body}}</p></div>
				</div>
			</div>


		</div>

		
	</div>
	<div class="col-md-4">
		<h3>Activities:</h3>
		
		<ul v-if="facility.activities && facility.activities !== ''" class="list-group">
			

			<li v-for="activity in facility.activity" class="list-group-item">
				<div class="row">
					<div class="col-md-10">{{activity.title}} <br> Due: {{activity.due_date}} Responsible: {{activity.assigned.name}}</div><div class="col-md-2"><button class="btn btn-default" @click="completeActivity(activity)"><span class="glyphicon glyphicon-check"></span></button></div></div></li>

					
				</ul>
				
				<p v-else>You have no activities scheduled for this facility</p>
				


			</div>
		</div>
		<modal title="Add a contact person">
			<form :action="facility.id + '/addContact'" @submit.prevent="addContact()" method="post">
				<div class="form-group">
					<label for="name">Full Name</label>
					<input type="text" class="form-control" id="name" name="name" />
				</div>
				<div class="form-group">
					<label for="phone">Phone</label>
					<input type="text" class="form-control" id="phone" name="phone" /> 
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" class="form-control" id="email" name="email" />
				</div>
				<div class="form-group pull-right">
					
					<button type="submit" class="btn btn-default btn-primary">Create Contact</button>
				</div>
			</form>

		</modal>
		<activity-modal title="Create Activity">
			<activity-form action="create" id="" :user_id="user.id" :facility_id="facility.id"></activity-form>

		</activity-modal>
	</div>
</template>
<script>
export default{
	props: ['id'], 
	data: function() {
		return {
			facility:{},
			user:{}
		}
	},
	methods: {
		addContact: function(){

		},
		markIt: function(){

		},
		addNote: function(){

		}

	},
	mounted(){
		//get facility 
		var self = this; 
		axios.get('/facility/details/' + this.id).then(function(response){
			console.log(response.data); 

			self.facility = response.data; 
		})
		//get current user 

	}
}
</script>