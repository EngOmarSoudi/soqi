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
                    <form id="offerForm" method="" action="" enctype="multipart/form-data">
                        @csrf
{{--                        <input name="_token" value="{{csrf_token()}}">--}}

                        <div class="form-group">
                            <label >{{__("massages.offer name_ar")}}</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name_ar" placeholder="{{__("massages.offer name_ar")}}">

                            <small id="name_ar_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label >{{__("massages.offer name_en")}}</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name_en" placeholder="{{__("massages.offer name_en")}}">
                            <small id="name_en_error" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{__("massages.offer price")}}</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="price" placeholder="{{__("massages.offer price")}}">
                            <small id="price_error" class="form-text text-danger"></small>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{__("massages.offer details_ar")}}</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="details_ar" placeholder="{{__("massages.offer details_ar")}}">
                            <small id="details_ar_error" class="form-text text-danger"></small>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{__("massages.offer details_en")}}</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="details_en" placeholder="{{__("massages.offer details_en")}}">
                            <small id="details_en_error" class="form-text text-danger"></small>

                        </div>
                        <div class="form-group">
                            <label >{{__("massages.offer Photo")}}</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" name="photo" placeholder="{{__("massages.offer Photo")}}">
                            <small id="photo_error" class="form-text text-danger"></small>
                        </div>
                        <button id="save_over" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).on('click','#save_over',function (e){
        e.preventDefault();
        $('#photo_error').text('');
        $('#details_en_error').text('');
        $('#details_ar_error').text('');
        $('#price_error').text('');
        $('#name_en_error').text('');
        $('#name_ar_error').text('');
        var formData = new FormData($('#offerForm')[0]);

        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{url('offers/store')}}",
            data: formData,
            // form.serialize()
            processData: false,
            contentType: false,

            cache: false,
            success: function (data) {
                if(data.status == true)
                    $('#success_msg').show();

            }, error: function (reject) {
                var response =$.parseJSON(reject.responseText);
                $.each(response.errors, function(key, value) {
                    $("#"+key+"_error").text(value[0]);
                });
            },
        });
    });
</script>
@stop
{{--// =>data:{--}}
{{--'_token':"{{csrf_token()}}",--}}
{{--//     'name_ar':$("input[name='name_ar']").val(),--}}
{{--//     'name_en':$("input[name='name_en']").val(),--}}
{{--//     'price':$("input[name='price']").val(),--}}
{{--//     'details_ar':$("input[name='details_ar']").val(),--}}
{{--//     'details_en':$("input[name='details_en']").val(),--}}
{{--// },--}}
