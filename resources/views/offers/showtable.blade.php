@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
{{--                <div class="card-header">{{__("massages.show all offers")}}</div>--}}

                <div class="card-body">
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{\Illuminate\Support\Facades\Session::get('success')}}
                    </div>
                    @elseif(\Illuminate\Support\Facades\Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{\Illuminate\Support\Facades\Session::get('error')}}
                        </div>
                    @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{__('massages.Photo')}}</th>
                                <th scope="col">{{__('massages.Name')}}</th>
                                <th scope="col">{{__('massages.Price')}}</th>
                                <th scope="col">{{__('massages.Details')}}</th>
                                <th style="text-align: center" colspan="2">{{__('massages.operations')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offers as $offer)
                            <tr>
                                <th scope="row">{{$offer->id}}</th>
                                <td > <img  style="height: 50px; width: 50px" src="{{asset('images/offers/'.$offer->photo)}}"></td>
                                <td>{{$offer->name}}</td>
                                <td>{{$offer->price}}</td>
                                <td>{{$offer->details}}</td>
                                <td>
                                    <a href="{{url('offers/editForm/'.$offer->id)}}" class="btn btn-success">{{__('massages.Edit')}}</a>
                                </td>
                                <td>
                                    <a href="{{url('offers/delete/'.$offer->id)}}" class="btn btn-danger">{{__('massages.delete')}}</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center col-md-12">
                            {!! $offers->links() !!}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
