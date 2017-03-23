@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-default">
		<div class="panel-heading">
		<h3>Add a Facility</h3>
		</div>
		<div class="panel-body">
			<form class="form" action="" method="POST">
				<div class="form-group">
					<label for="name">Facility Name</label>
					<input type="text" class="form-control" name="name" required /> 
				</div>
				<div class="form-group">
					<label for="link">Website</label>
					<input type="text" class="form-control" name="link" />
				</div>
				<div class="form-group">
					<label for="phone">Phone</label>
					<input type="text" class="form-control" name="phone" />
				</div>
				<div class="form-group">
					<label for="address">Address</label>
					<input type="text" class="form-control" name="address" /> 

				</div>
				<div class="form-group">
					<label for="city">City</label>
					<input type="text" class="form-control" name="city" />
				</div>
				<div class="form-group">
					<label for="state">State Abbreviation</label>
					<input type="text" class="form-control" name="state" /> 
				</div>
				<div class="form-group">
				{{csrf_field() }}
					<button type="submit" class="btn btn-default btn-success">Create</button>
				</div>

			</form>

		</div>
		</div>
	</div>
</div>


		@endsection