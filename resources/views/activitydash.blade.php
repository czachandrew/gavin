@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">

<h3>Activities</h3>
</div>
<div class="panel-body">
<div class="col-md-6">
<h4>Active</h4>
<ul class="list-group">
@foreach($assigned as $task)
<li class="list-group-item">
<div class="row">
<div class="col-md-10">

	<p>{{$task->title}} - <a href="{{'/facility/' . $task->facility_id}}"><span style="font-weight: bold;">{{$task->facility->name}}</span></a></p>
	<p style="font-style: italic;">{{$task->content}} <br> Phone: {{$task->facility->phone}}</p>
	</div><div class="col-md-2"><button class="btn btn-default" @click="completeActivity({{$task}}, {{Auth::user()}})"><span class="glyphicon glyphicon-check"></span></button></div></div>
</li>
@endforeach
</ul>
</div>
<div class="col-md-6">
<h4>Complete</h4>
<ul class="list-group">

@foreach($created as $task)
<li class="list-group-item">
	<p>{{$task->title}} - {{$task->facility->name}}</p>
	<p>{{$task->content}} <br> Phone: {{$task->facility->phone}}</p>
	</li>
	@endforeach
	</ul>

	</div>

	</div>
	</div>
	</div>
	</div>

@endsection