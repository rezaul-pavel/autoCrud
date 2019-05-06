@extends('layouts.admin')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header col-12"><h4>{{--User--}}{{__('admin/user/edit.user')}}</h4></div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/admin/user',['id'=>$row->id]) }}" id="editUser">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">{{--Name--}}{{__('admin/user/edit.name')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="{{old('name', $row->name)}}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">{{--Email--}}{{__('admin/user/edit.email')}}</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" value="{{old('email', $row->email)}}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label for="gender" class="col-sm-2 control-label">{{--Role--}}{{__('admin/user/edit.role')}}</label>
                                <div class="col-md-9">
                                    {!! chk_roles('role_id', $row->userRole) !!}
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">{{--Update--}}{{__('admin/user/edit.update')}}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $( "form" ).on( "submit", function() {
            var role = $('.role').val();
            if ($("#editUser input:checkbox:checked").length > 0)
            {
                return true;
                // any one is checked
            }
            else
            {
                alert('Please select at least one role')
                return false;

            }
        });
    </script>
@endsection
