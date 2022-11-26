@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__("massages.doctors")}}</div>

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
                        <table class="table" style="text-align: center">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{__('massages.Name')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($service) && $service-> count()>0)
                                @foreach($service as $serv)
                                    <tr>
                                        <th scope="row">{{$serv->id}}</th>
                                        <td>{{$serv->name}}</td>
{{--                                        <td>--}}
{{--                                            <a href="{{url('offers/delete/'.$doctor->id)}}" class="btn btn-danger">{{__('massages.delete')}}</a>--}}
{{--                                        </td>--}}
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                        <br> <br>
                        <form action="{{route('save_services_to_doctor')}}" method="post" >

                            @csrf
                            <div class="form-group">
                                <label for="exampleInput"> {{__('massages.choose doctor')}}</label>
                                <select class="form-control" name="doctorId" id="">
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">
                                                       {{$doctor->name}}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInput">{{__('massages.choose service')}}</label>
                                <select class="form-control" name="servicesIds" id="" multiple>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">
                                            {{$service->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" >{{__('massages.save')}}</button>

                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
