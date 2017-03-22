<template>
	<div @click="closeModal" v-show="isModalOpen" class="modal-dialog" style="z-index:1000; position:absolute; top:120px; left:25%; right:25%;">
		<div @click.stop="" v-show="isModalOpen" class="modal-content">
			<div class="modal-header">
				{{title}} 
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal"><span aria-hidden="true">&times;</span></button>
			</div>
		
		<div class="modal-body">
			<slot></slot>
		</div>
		<div class="modal-footer"></div> 
		</div>
	</div>

</template>
<script>
export default {
	props:['title'],
	computed: {
		isModalOpen: function() {
			return this.$root.modalIsOpen;
		}
	},
	methods: {
		closeModal: function() {
			console.log('Closing!');
			this.$root.modalIsOpen = false; 
		}
	}

}
</script>