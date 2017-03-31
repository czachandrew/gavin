@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">

				<h3>Activities</h3>
			</div>
			<div class="panel-body">
			<button class="btn btn-success" @click="sendEmail()">Email Test</button>
				

				<div>
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#assigned" aria-controls="active" role="tab" data-toggle="tab">Tasks Assigned to you</a>
						</li>
						<li role="presentation"><a href="#created" aria-controls="created" role="tab" data-toggle="tab">Created Tasks</a></li> 

					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="assigned">
						<h4>Tasks that have been assigned to you - </h4>
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

										@foreach($completed as $task)
										<li class="list-group-item">
											<p>{{$task->title}} - {{$task->facility->name}}</p>
											<p>{{$task->content}} <br> Phone: {{$task->facility->phone}}</p>
										</li>
										@endforeach
									</ul>

								</div>

							</div>
							<div role="tabpanel" class="tab-pane" id="created">
							<h4>Tasks that you have created - </h4> 
							<!-- active assigned tasks --> 
							<div class="col-md-6">
							<h4>Active</h4>
								<ul class="list-group">
									@foreach($created as $task)
									@if($task->status == 'open')
									<li class="list-group-item">
										<div class="row">
											<div class="col-md-10">

												<p>{{$task->title}} - <a href="{{'/facility/' . $task->facility_id}}"><span style="font-weight: bold;">{{$task->facility->name}}</span></a></p>
												<p style="font-style: italic;">{{$task->content}} <br> Phone: {{$task->facility->phone}}</p>
											</div><div class="col-md-2"><button class="btn btn-default" @click="completeActivity({{$task}}, {{Auth::user()}})"><span class="glyphicon glyphicon-check"></span></button></div></div>
										</li>
										@endif
										@endforeach
									</ul>
								</div>
								<div class="col-md-6">
									<h4>Complete</h4>
									<ul class="list-group">

										@foreach($created as $task)
										@if($task->status == 'complete')
										<li class="list-group-item">
											<p>{{$task->title}} - {{$task->facility->name}}  Assigned to: {{$task->assigned->name}}</p>
											<p>{{$task->content}} <br> Phone: {{$task->facility->phone}}</p>
										</li>
										@endif
										@endforeach
									</ul>

								</div>
							

							</div>
						</div>



					</div>

				</div>
			</div>
		</div>
	</div>

	@endsection