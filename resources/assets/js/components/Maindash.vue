<template>
<div>
<div class="form-group">
<label for="term">Filter the table</label>
<input type="text" class="form-control" v-model="term" />
</div>
<table class="table table-bordered">

                    <thead>
                        <th>Name</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Phone</th>
                        <th>Contact Person</th>
                        
                        <th></th>
                    </thead>
                    <tbody>
                        
                            <tr v-for="facility in filter(facilities)">
                                <td><p>{{facility.name}}</p><p><a :href="facility.link">Website</a></p>
                               
                                    <p v-if="facility.calls.length == 0" style="font-weight:bold;">Not Contacted</p>
                                   
                                </td>
                                <td>{{facility.city}}</td>
                                <td>{{facility.state}}</td>
                                <td>{{facility.phone}}</td>
                                <td>
                                   
                                    <span v-if="facility.contact">
                                        {{facility.contact.name}}<br> 
                                        {{facility.contact.phone}}
                                    </span>
                                 
                                </td>
                                
                                <td><p><a type="button" class="btn btn-sm btn-primary" :href="'/facility/' + facility.id +'/call'">Contact</a>    <a class="btn btn-success btn-sm" :href="/facility/ + facility.id">View</a></p></td>
                            </tr>
                      
                    </tbody>

                    </table> 
                    </div>
</template>
<script>
export default {
	props:['facilities'],
	data: function(){
		return {
			term:''
		}
	},
	methods: {
		filter:function(facilities){
			var self=this; 
			return facilities.filter(function(facility){
				//console.log(facility);
				return facility.name.indexOf(self.term) !== -1 || facility.city.indexOf(self.term) !== -1 || facility.state.indexOf(self.term) !== -1;
			})
		}
	},
	mounted(){
		console.log(this.facilities);
	}
}

</script>