@extends('auth.layouts')
@section('title', trans('home.reset_password_title'))
@section('css')
    
@endsection
@section('content')
    @if (Session::get('successMsg'))
        <div class="alert alert-success">
            <span> {{Session::get('successMsg')}} </span>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <span> {{$errors->first()}} </span>
        </div>
    @endif
    <form class="forget-form" action="/resetPassword" method="post" style="display: block;">
        @if(\App\Components\Helpers::systemConfig()['is_reset_password'])
            <h3 class="form-title font-green-steel">{{trans('home.reset_password_title')}}</h3>
            <div class="form-group">
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="{{trans('home.username_placeholder')}}" name="username" value="{{Request::old('username')}}" required autofocus />
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
            </div>
        @else
            <div class="alert alert-danger">
                <span> {{trans('home.system_down')}} </span>
            </div>
        @endif
        <div class="form-actions">
            <button type="button" class="btn btn-danger" onclick="login()">{{trans('register.back')}}</button>
            @if(\App\Components\Helpers::systemConfig()['is_reset_password'])
                <button type="submit" class="btn green-steel uppercase pull-right">{{trans('register.submit')}}</button>
            @endif
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        // 登录
        function login() {
            window.location.href = '/login';
        }
    </script>
@endsection