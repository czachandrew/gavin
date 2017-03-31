@component('mail::message')
# New activity assigned

Hi {{$activity->assigned->name}}, 

You have been assigned the following activity by {{$activity->creator->name}}. 

@component('mail::panel', ['url' => ''])
 **Task**: {{$activity->title}} <br>
 **Description**: {{$activity->content}} <br>
 **Due Date**: {{ Carbon\Carbon::parse($activity->due_date)->diffForHumans()}} <br>
 **Facility**: {{$activity->facility->name}} <br>
@endcomponent

@component('mail::button', ['url' => 'http://gavin.czachendo.com/view/activities'])
Your Activities
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
