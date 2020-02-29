@extends('auth.layouts')
@section('title', trans('active.title'))
@section('css')
    
@endsection
@section('content')
    @if (Session::get('successMsg'))
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span> {{Session::get('successMsg')}} </span>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <span> {{$errors->first()}} </span>
        </div>
    @endif
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="/activeUser" method="post" style="display: block;">
        @if(\App\Components\Helpers::systemConfig()['is_active_register'])
            <h3 class="form-title font-green-steel">{{trans('active.title')}}</h3>
            <div class="form-group">
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="{{trans('active.username_placeholder')}}" name="username" value="{{Request::get('username')}}" required />
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
            </div>
        @else
            <div class="alert alert-danger">
                <span> {{trans('active.tips')}} </span>
            </div>
        @endif
        <div class="form-actions">
            <button type="button" class="btn btn-danger" onclick="login()">{{trans('active.back')}}</button>
            @if(\App\Components\Helpers::systemConfig()['is_active_register'])
                <button type="submit" class="btn green-steel uppercase pull-right">{{trans('active.submit')}}</button>
            @endif
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
@endsection
@section('script')
    <script type="text/javascript">
        // 登录
        function login() {
            window.location.href = '/login';
        }
    </script>
@endsection