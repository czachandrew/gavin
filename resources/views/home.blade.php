@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <form class="form" action="/add/facilities" accept-charset="UTF-8" method="POST">
                    <div class="form-group">
                        <label for="blob"> Past a chunk of text with complete address records</label>
                        <textarea class="form-control" id="blob" name="blob" rows="4"></textarea>
                        {{csrf_field()}}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default btn-success">Parse</button>
                    </div>

                    </form>
                    
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
                        @foreach($facilities as $facility)
                            <tr>
                                <td><p>{{$facility->name}}</p><p><a href="{{$facility->link}}">Website</a></p>
                                @if(count($facility->calls) == 0)
                                    <p style="font-weight:bold;">Not Contacted</p>
                                    @endif

                                </td>
                                <td>{{$facility->city}}</td>
                                <td>{{$facility->state}}</td>
                                <td>{{$facility->phone}}</td>
                                <td>
                                    @if($facility->contact)
                                        {{$facility->contact->name}}<br> 
                                        {{$facility->contact->phone}}
                                    @endif
                                </td>
                                
                                <td><p><a type="button" class="btn btn-sm btn-primary" href="{{'/facility/' . $facility->id .'/call'}}">Contact</a>    <a class="btn btn-success btn-sm" href="{{'/facility/' . $facility->id}}">View Record</a></p></td>
                            </tr>
                        @endforeach
                    </tbody>

                    </table> 
                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
