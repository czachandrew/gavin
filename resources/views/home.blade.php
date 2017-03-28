@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    
                    <main-dash :facilities="{{$facilities}}"></main-dash>
                    
                   
                       
                </div>
            </div>
            </div>
            <div class="col-md-4">
                <notepad content="{{$notepad->content}}" id="{{$notepad->id}}"></notepad>
            </div>
        </div>
    </div>
</div>
@endsection
