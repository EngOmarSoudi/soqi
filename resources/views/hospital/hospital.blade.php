@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               <div class="card-header">{{__("massages.hospitals")}}</div>

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
                                <th scope="col">{{__('massages.Name')}}</th>
                                <th scope="col">{{__('massages.address')}}</th>
                                <th scope="col" colspan="2" style="text-align: center">{{__('massages.operations')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($hospitals) && $hospitals-> count()>0)
                            @foreach($hospitals as $hospital)
                            <tr>
                                <th scope="row">{{$hospital->id}}</th>
                                <td>{{$hospital->name}}</td>
                                <td>{{$hospital->address}}</td>
                                <td>
                                    <a href="{{route('hospitals.doctors',$hospital->id)}}" class="btn btn-success">{{__('massages.Show all hospital doctors')}}</a>
                                </td>
                                <td>
                                    <a href="{{route('hospital.delete',$hospital->id)}}" class="btn btn-danger">{{__('massages.delete')}}</a>
                                </td>
                            </tr>
                            @endforeach
                                @endif
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
