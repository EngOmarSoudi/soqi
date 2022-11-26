@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
{{--                <div class="card-header">{{__("massages.show all offers")}}</div>--}}
                <div class="alert alert-success" id="success_msg" style="display: none" role="alert">
                    {{__('massages.added successfully')}}
                </div>
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
                        <table class="table ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{__('massages.Photo')}}</th>
                                <th scope="col">{{__('massages.Name')}}</th>
                                <th scope="col">{{__('massages.Price')}}</th>
                                <th scope="col">{{__('massages.Details')}}</th>
                                <th style="text-align: center" colspan="3">{{__('massages.operations')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offers as $offer)
                            <tr class="offers{{$offer->id}}">
                                <th scope="row">{{$offer->id}}</th>
                                <td > <img  style="height: 50px; width: 50px" src="{{asset('images/offers/'.$offer->photo)}}"></td>
                                <td>{{$offer->name}}</td>
                                <td>{{$offer->price}}</td>
                                <td>{{$offer->details}}</td>
                                <td>
                                    <a href="{{route('offers.edit.form',$offer->id)}}" class="btn btn-success">{{__('massages.Edit')}}</a>
                                </td>
                                <td>
                                    <a  offer_id="{{$offer->id}}"  class="btn btn-danger delete_btn">{{__('massages.delete')}}</a>
                                </td>
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
@section('scripts')
    <script>
        $(document).on('click','.delete_btn',function (e){
            e.preventDefault();
            var offer_id=$(this).attr('offer_id');

            // var formData = new FormData($('#offerForm')[0]);

            $.ajax({
                type: 'post',
                url: "{{url('offers/delete')}}",
                data: {
                    '_token':"{{csrf_token()}}",
                    'id':offer_id,
                },
                // form.serialize()

                success: function (data) {
                    if(data.status == true) {
                        $('#success_msg').show();
                    }$('.offers'+data.id).remove();
                }, error: function (reject) {

                },
            });
        });
    </script>
@stop
