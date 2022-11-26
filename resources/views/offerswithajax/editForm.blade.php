@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__("massages.create your offer")}}</div>
                <div class="alert alert-success" id="success_msg" style="display: none" role="alert">
                    {{__('massages.added successfully')}}
                </div>

                <div class="card-body">
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{\Illuminate\Support\Facades\Session::get('success')}}
                    </div>
                    @endif
                        <form id="editofferForm" method="" action="" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="offer_id" value="{{$offer->id}}" style="display: none">
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

                        <button id="update_over" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).on('click','#update_over',function (e){
            e.preventDefault();

            var formData = new FormData($('#editofferForm')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{url('offers/update')}}",
                data: formData,
                // form.serialize()
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if(data.status == true)
                        $('#success_msg').show();

                }, error: function (reject) {

                },
            });
        });
    </script>
@stop
