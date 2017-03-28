@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>Find Facilities</h1>
			</div>
			<div class="panel-body">
				<div class="col-md-8">
				
					<form action="" method="POST" accept-charset="UTF-8">
						<div class="form-group">
							<label for="notes">Search:</label>
							<input type="text" id="text" name="text" class="form-control" rows="5">
							{{csrf_field() }}

						</div>
						<div class="form-group">
						<h3>Filters</h3>
				@foreach($codes as $code)
					<label class="checkbox-inline">
						<input type="checkbox" name="filter[]" value="{{$code->code}}"> {{$code->text}}
					</label>
				@endforeach

						</div>
						<div class="form-group">
							<div class="">
								<button type="submit" class="btn btn-default btn-success">Search</button>
							</div>
						</div>
						</form>
					
				</div>
				<div class="col-md-12">
				<ul class="list-group">
				@foreach($results as $item)
					<li class="list-group-item"><a href="{{'/facility/' . $item->id}}"><span style="font-weight:bold;">{{$item->name}}</span></a> <span>{{$item->city}}</span>, {{$item->state}} <button class="pull-right btn btn-xs btn-primary">Add to List</button></li>
				@endforeach
				</ul>
				</div>
				

			</div>

		</div>
	</div>
</div>


@endsection
