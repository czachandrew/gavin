@component('mail::message')
# Your Activity Update

**Open Activities**
<ul>
@foreach($user->assigned_activities->where('status','open') as $activity)

	<li> <span style="font-weight:bold;">{{$activity->title}}</span> <br> {{$activity->content}} <br> <span style="font-weight:bold;">Due:</span> {{Carbon\Carbon::parse($activity->due_date)->diffForHumans()}}</li>
	
@endforeach
</ul>
**Recently Completed**
<ul>
@foreach($user->assigned_activities->where('status','complete')->where('updated_at','>=', Carbon\Carbon::now()->subWeek()->toDateString()) as $activity)

	<li><span style="font-weight:bold;">{{$activity->title}}</span> <br> {{$activity->content}} <br> <span style="font-weight:bold;">Completed:</span> {{Carbon\Carbon::parse($activity->updated_at)->diffForHumans()}}</li>
@endforeach

</ul>
@component('mail::button', ['url' => 'http://gavin.czachendo.com/view/activities'])
View Activities
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
