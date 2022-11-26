@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__("massages.create your offer")}}</div>

                <div class="card-body">
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{\Illuminate\Support\Facades\Session::get('success')}}
                    </div>
                    @endif
                    <form method="post" action="{{route('offers.update',$offer->id)}}">
                        @csrf
{{--                        <input name="_token" value="{{csrf_token()}}">--}}
                        <div class="form-group">
                            <label >{{__("massages.offer name_ar")}}</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name_ar" value="{{$offer->name_ar}}" placeholder="{{__("massages.offer name_ar")}}">
                            @error('name_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label >{{__("massages.offer name_en")}}</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name_en" value="{{$offer->name_en}}" placeholder="{{__("massages.offer name_en")}}">
                            @error('name_en')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{__("massages.offer price")}}</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="price" value="{{$offer->price}}"  placeholder="{{__("massages.offer price")}}">
                            @error('price')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{__("massages.offer details_ar")}}</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="details_ar"  value="{{$offer->details_ar}}" placeholder="{{__("massages.offer details_ar")}}">
                            @error('details_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{__("massages.offer details_en")}}</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="details_en"  value="{{$offer->details_en}}" placeholder="{{__("massages.offer details_en")}}">
                            @error('details_en')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label >{{__("massages.offer Photo")}}</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" name="Photo" placeholder="{{__("massages.offer Photo")}}">
                            @error('Photo')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
