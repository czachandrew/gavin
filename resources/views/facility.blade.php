@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>{{$facility->name}} - {{$facility->phone}}
				@if($facility->possible != '')
					<span class="pull-right">Possibility: {{$facility->possible}}</span>
				@endif	
				</h1>
			</div>
			<div class="panel-body">
				<div class="col-md-8">
				
					<form action="" method="POST" accept-charset="UTF-8">
						<div class="form-group">
							<label for="notes">Add a Note:</label>
							<textarea id="body" name="body" class="form-control" rows="5"></textarea>
							{{csrf_field() }}

						</div>
						<div class="form-group">
							<div class="">
								<button type="submit" class="btn btn-default btn-success">Add Note</button>
							</div>
						</div>
					</form>
					<form action="{{'markit/' . $facility->id}}" method="POST">
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
					<p><span style="font-weight:bold;">Phone:</span><br> {{$facility->phone}} </p>
					<p><span style="font-weight:bold;">Address:</span><br> {{$facility->address}}<br>{{$facility->city}}, {{$facility->state}}</p>
					@if($contact)
						<!-- Display the main contact info here --> 
						<p><span style="font-weight:bold;">Contact Person:</span><br> {{$contact->name}}<br>
						@if($contact->email)
							<a href="mailto:{{$contact->email}}">{{$contact->email}} </a><br>
						@endif
						@if($contact->phone)
							{{$contact->phone}}
							@endif
					@else
						<!-- Show me the button to create a contact here --> 
						<button type="button" @click="showModal" class="btn btn-default btn-primary">Add a Contact Person</button>
						@endif
						
						<button type="button" @click="showActivity" class="btn btn-default btn-success">Create Follow up</button>
				</div>

			</div>

		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-1">
		
				<h3>Notes:</h3>
			
			@if($notes)
			
				@foreach($notes as $note)
				@if($note->call_id > 0 )
					<div class="panel panel-success">
						<div class="panel-heading">On {{$note->created_at}} {{$note->user->name}} called </div>
						<div class="panel-body"><p>{{$note->body}}</p></div>
					</div>

				@else
					<div class="panel panel-default">
						<div class="panel-heading">On {{$note->created_at}} {{$note->user->name}} said...</div>
						<div class="panel-body"><p>{{$note->body}}</p></div>
					</div>

				@endif
				@endforeach
			@endif

		
	</div>
	<div class="col-md-4">
		<h3>Activities:</h3>
		@if($activities)
							<ul class="list-group">
							@foreach($activities as $activity)
							
								<li class="list-group-item">
								<div class="row">
								<div class="col-md-10">{{$activity->title}} <br> Due: {{Carbon\Carbon::parse($activity->due_date)->format('M-d-Y')}} Responsible: {{$activity->assigned->name}}</div><div class="col-md-2"><button class="btn btn-default" @click="completeActivity({{$activity}}, {{Auth::user()}})"><span class="glyphicon glyphicon-check"></span></button></div></div></li>

							@endforeach
							</ul>
		@else
		<p>You have no activities scheduled for this facility</p>
						@endif	


	</div>
</div>
<modal title="Add a contact person">
<form action="{{$facility->id}}/addContact" method="post">
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
{{csrf_field()}}
<button type="submit" class="btn btn-default btn-primary">Create Contact</button>
</div>
</form>

</modal>
<activity-modal title="Create Activity">
	<activity-form action="create" id="" user_id="{{$user->id}}" facility_id="{{$facility->id}}"></activity-form>

</activity-modal>
<div class="modal fade" id="contactPersonModal" tabindex="-1" role="dialog" aria-labelledby="contactPersonModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Here is the modal</p>
			</div>
			<div class="modal-footer">
			<span class="pull-right">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary">Create</button>
				</span>
			</div>
		</div>
	</div>
</div>

@endsection
