@extends('user.layouts')
@section('css')
    <link href="/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top: 0px; min-height: 354px;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('successMsg'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        {{Session::get('successMsg')}}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <span> {{$errors->first()}} </span>
                    </div>
                @endif
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet green-steel box">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-grey bold uppercase">{{trans('home.profile')}}</span>
                                    </div>
                                    <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1" data-toggle="tab">{{trans('home.password')}}</a>
                                            </li>
                                            <li>
                                                <a href="#tab_2" data-toggle="tab">{{trans('home.contact')}}</a>
                                            </li>
                                            <li>
                                                <a href="#tab_3" data-toggle="tab">{{trans('home.ssr_setting')}}</a>
                                            </li>
                                        </ul>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        
                                        <div class="tab-pane active" id="tab_1">
                                            <form action="{{url('profile')}}" method="post" enctype="multipart/form-data" class="form-bordered">
                                                <div></div>
                                                <div class="form-group form-md-line-input">
                                                    <input type="password" class="form-control" name="old_password" id="old_password" required >
                                                    <label for="old_password">{{trans('home.current_password')}}</label>
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}" >
                                                    <span class="help-block ">{{trans('home.current_password')}}</span>
                                                </div>
                                                <div class="form-group form-md-line-input">                                                    
                                                    <input type="password" class="form-control" name="new_password" id="new_password" required >
                                                    <label for="new_password">{{trans('home.new_password')}}</label>
                                                    <span class="help-block ">{{trans('home.password_need_strong')}}</span>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class=" col-md-4">
                                                            <button type="submit" class="btn green-steel">{{trans('home.submit')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="tab_2">
                                            <form action="{{url('profile')}}" method="post" enctype="multipart/form-data" class="form-bordered">
                                                <div class="form-group form-md-line-input">
                                                    <input type="text" class="form-control form-md-line-input" name="wechat" value="{{Auth::user()->wechat}}" id="wechat" required />
                                                    <label for="wechat">{{trans('home.wechat')}}</label>
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                                    <span class="help-block">{{trans('home.wechat')}}</span>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <input type="text" class="form-control form-md-line-input" name="qq" value="{{Auth::user()->qq}}" id="qq" required/>
                                                    <label for="wechat">QQ</label>
                                                    <span class="help-block">QQ</span>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn green-steel">{{trans('home.submit')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="tab_3">
                                            <form action="{{url('profile')}}" method="post" enctype="multipart/form-data" class="form-bordered">
                                                <div class="form-group form-md-line-input">
                                                    <input type="text" class="form-control form-md-line-input" name="passwd" value="{{Auth::user()->passwd}}" id="passwd" required  />
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                                    <label for="passwd">{{trans('home.connection_password')}}</label>
                                                    <span class="help-block">{{trans('home.connection_password')}}</span>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn green-steel"> {{trans('home.submit')}} </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
@endsection