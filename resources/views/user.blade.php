@extends('layout.resourc')
@section('1')
<h1>user name is {{$name}}</h1>
@foreach($obj->data as $l)
    <h1>user name is {{$l}}</h1>

@endforeach
@if ($obj->data['phone']==7775)
    <h1>====================</h1>
@endif
{{--@foreach($obj as $o)--}}
<h1>{{$obj -> gender}}</h1>

{{--@endforeach--}}
<h2>phone:  {{($obj->data['phone'])}}</h2>

@stop
