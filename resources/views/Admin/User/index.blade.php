@extends('layouts.app')
@section('set-footer-bottom')
    <style>
        @if(count($rows) == 0)
        @media only screen and (min-width: 520px) {
            .footer{
                position: fixed !important;
                left: 0;
                right: 0;
                bottom: 0;
            }
        }
        @media only screen and (min-width: 900px) {
            .footer{
                position: fixed !important;
                left: 0;
                right: 0;
                bottom: 0;
            }
        }
        @media only screen and (min-width: 1090px) {
            .footer{
                position: fixed !important;
                left: 0;
                right: 0;
                bottom: 0;
            }
        }
        @media only screen and (min-width: 1251px) {
            .footer{
                position: fixed !important;
                left: 0;
                right: 0;
                bottom: 0;
            }
        }
        @endif
    </style>
@endsection

@section('content')

    <div class="container">
        @if(session('msg'))
            <div class="alert alert-primary mt-2" role="alert">
                {{ session('msg') }}
            </div>
        @endif
        <div class="card my-4">
            <div class="card-header col-12" >
                <div class="row">
                    <h4 class="mr-auto pl-2">{{--User List--}} {{__('User list')}}</h4>
                    <div class="pr-2">
{{--                        <a class="btn btn-md btn-primary"--}}
{{--                           href="{{url('/admin/user/create')}}">--}}{{--Create--}}{{--{{__('admin/user/index.create')}}</a>--}}
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>{{--No--}} {{__('No')}}</th>
                            <th>{{--Name--}} {{__('Name')}}</th>
                            <th style="width: 10% !important;">{{--Email--}} {{__('Email')}}</th>
                            <th>{{--Role--}} {{__('Role')}}</th>
                            <th class=" text-center">{{--Operations--}} {{__('Operations')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $index = row_serial_start($rows)?>
                        @foreach($rows as $k=>$v)
                            <tr>
                                <td> {{$index++}}.</td>
                                <td>{{$v->name}}</td>
                                <td>{{ $v->email }}</td>
                                <td>{{ role_names($v->userRole) }}</td>

                                <td class="text-center">
                                <a class="btn btn-sm btn-primary"
                                   href="{{url('/admin/user/edit/'.$v->id)}}">{{--Edit--}}{{__('edit')}}</a>
                                @if($v->is_active)
                                    <a class="btn btn-sm btn-info"
                                       href="{{url('/admin/user/activate/'.$v->id.'/false')}}">{{--Deactivate--}}{{__('Deactivate')}}</a>
                                @else
                                    <a class="btn btn-sm btn-info"
                                       href="{{url('/admin/user/activate/'.$v->id.'/true')}}"><b>{{--Activate--}}{{__('Activate')}}</b></a>
                                @endif

                                <a class="btn btn-sm btn-danger" onclick="return confirm('{{__("admin/user/index.confirmdel")}}')"
                                   href="{{url('/admin/user/destroy/'.$v->id)}}">{{--Delete--}}{{__('Delete')}}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
