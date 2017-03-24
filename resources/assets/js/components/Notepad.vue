<template>
	<div>
		<div class="panel panel-default">
			<div class="panel-heading">
				Notepad
			</div>
			<div class="panel-body">
				<form>
					<div class="form-group">
						<textarea class="form-control" rows="10" @change="update" @focus="status = 'Updating'" v-model="formContent"></textarea>
						<p style="font-size: 7;">{{status}}</p>
					</div>
				</form>
			</div>
		</div>
	</div>

</template>
<script>
export default {
	props:['content','id'],
	data: function() {
		return {
			formContent: '',
			status: '', 
		}
	},
	methods: {
		update: function(){
			//use content to update the notepad
			this.status = 'Saving'; 
			axios.post('/notepad/update/' + this.id, {content: this.formContent}).then(function(response){
				console.log(response);
				this.status = 'Saved';
			})
			//console.log(this.formContent); 
			
		}
	},
	mounted(){
		this.formContent = this.content;
	}

}
</script>