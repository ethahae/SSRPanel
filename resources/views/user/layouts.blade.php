<!DOCTYPE html>
<!--[if IE 8]> <html lang="{{app()->getLocale()}}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="{{app()->getLocale()}}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{app()->getLocale()}}">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>{{\App\Components\Helpers::systemConfig()['website_name']}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    @yield('css')
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/layouts/layout3/css/themes/green-haze.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="/assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
</head>

<body class="page-container-bg-solid">
    <div class="page-wrapper">
        <div class="page-wrapper-row">
            <div class="page-wrapper-top">
                <!-- BEGIN HEADER -->
                <div class="page-header">
                    <!-- BEGIN HEADER TOP -->
                    <div class="page-header-top">
                        <div class="container">
                            <!-- BEGIN LOGO -->
                            <div class="page-logo">
                                @if(\App\Components\Helpers::systemConfig()['website_logo'])
                                    <a href="{{url('/')}}"><img src="{{\App\Components\Helpers::systemConfig()['website_logo']}}" alt="logo" class="logo-default" style="width:150px; height:30px;"/> </a>
                                @else
                                    <a href="{{url('/')}}"><img src="/assets/images/logo.png" alt="logo" class="logo-default" /> </a>
                                @endif
                            </div>
                            <!-- END LOGO -->
                            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                            <a href="javascript:;" class="menu-toggler"></a>
                            <!-- END RESPONSIVE MENU TOGGLER -->
                            <!-- BEGIN TOP NAVIGATION MENU -->
                            <div class="top-menu">
                                <ul class="nav navbar-nav pull-right">
                                    <li class="separator hide"> </li>
                                    <!-- BEGIN USER LOGIN DROPDOWN -->
                                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                                    <li class="dropdown dropdown-user dropdown-dark">
                                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                            <span class="username username-hide-on-mobile"> {{Auth::user()->username}} </span>
                                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                            <img alt="" class="img-circle" src="/assets/images/avatar.png" /> </a>
                                        <ul class="dropdown-menu dropdown-menu-default">
                                            @if(Auth::user()->is_admin)
                                                <li>
                                                    <a href="{{url('admin')}}"> <i class="icon-settings"></i>{{trans('home.console')}}</a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{url('profile')}}"> <i class="icon-user"></i>{{trans('home.profile')}}</a>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <a href="{{url('logout')}}"> <i class="icon-key"></i>{{trans('home.logout')}}</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- END USER LOGIN DROPDOWN -->
                                </ul>
                            </div>
                            <!-- END TOP NAVIGATION MENU -->
                        </div>
                    </div>
                    <!-- END HEADER TOP -->
                    <!-- BEGIN HEADER MENU -->
                    <div class="page-header-menu">
                        <div class="container">
                            <!-- BEGIN MEGA MENU -->
                            <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
                            <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                            <div class="hor-menu  ">
                                <ul class="nav navbar-nav">
                                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                        <a href="javascript:;"> {{trans('home.dashboard')}}
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu pull-left">
                                            <li aria-haspopup="true">
                                                <a href="/" class="nav-link">
                                                    <i class="icon-bar-chart"></i> {{trans('home.home')}}
                                                </a>
                                            </li>
                                            <li aria-haspopup="true" class=" ">
                                                <a href="{{url('nodeList')}}" class="nav-link  ">
                                                    <i class="icon-bulb"></i> {{trans('home.nodelist')}}  </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown  ">
                                        <a href="javascript:;"> {{trans('home.service_dash')}}
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu" style="min-width: 710px">
                                            <li aria-haspopup="true">
                                                <a href="{{url('services')}}" class="nav-link">
                                                    <i class="icon-basket"></i>
                                                    <span class="title">{{trans('home.services')}}</span>
                                                </a>
                                            </li>
                                            <li aria-haspopup="true">
                                                <a href="{{url('invoices')}}" class="nav-link">
                                                    <i class="icon-wallet"></i>
                                                    <span class="title">{{trans('home.invoices')}}</span>
                                                </a>
                                            </li>
                                            <li aria-haspopup="true">
                                                <a href="{{url('tickets')}}" class="nav-link">
                                                    <i class="icon-question"></i>
                                                    <span class="title">{{trans('home.tickets')}}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                        <a href="javascript:;"> {{trans('home.other')}}
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu pull-left">
                                            <li aria-haspopup="true">
                                                <a href="{{url('invite')}}" class="nav-link">
                                                    <i class="icon-user-follow"></i>
                                                    <span class="title">{{trans('home.invite_code')}}</span>
                                                </a>
                                            </li>
                                            @if(\App\Components\Helpers::systemConfig()['referral_status'])
                                            <li aria-haspopup="true">
                                                <a href="{{url('referral')}}" class="nav-link">
                                                    <i class="icon-diamond"></i>
                                                    <span class="title">{{trans('home.referrals')}}</span>
                                                </a>
                                            </li>
                                            @endif
                                            <li aria-haspopup="true">
                                                <a href="{{url('help')}}" class="nav-link">
                                                    <i class="icon-doc"></i>
                                                    <span class="title">{{trans('home.help')}}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    
                                </ul>
                            </div>
                            <!-- END MEGA MENU -->
                        </div>
                    </div>
                    <!-- END HEADER MENU -->
                </div>
                <!-- END HEADER -->
            </div>
        </div>
        <div class="page-wrapper-row full-height">
            <div class="page-wrapper-middle">
                <!-- BEGIN CONTAINER -->
                <div class="page-container">
                    <!-- BEGIN CONTENT -->
                    <div class="page-content-wrapper">
                        <div class="page-content">
                            <div class="container">
                                @yield('content')
                            </div>
                            @if(Session::get("admin"))
                                <div class="portlet light bordered" style="position:fixed;right:20px;bottom:0px;width:270px;">
                                    <div class="portlet-body text-right">
                                        <h5>当前身份：{{Auth::user()->username}}</h5>
                                        <button class="btn btn-sm btn-danger" id="return_to_admin"> 返回管理页面 </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- END PAGE CONTENT BODY -->
                        <!-- END CONTENT BODY -->
                    </div>
                    <!-- END CONTENT -->
                </div>
                <!-- END CONTAINER -->
            </div>
        </div>
        <div class="page-wrapper-row">
            <div class="page-wrapper-bottom">
                <!-- BEGIN FOOTER -->
                <!-- BEGIN INNER FOOTER -->
                <div class="page-footer">
                    <div class="container"> Copyright &copy; 2017 - 2019 <a href="https://github.com/ssrpanel/ssrpanel" target="_blank">SSRPanel</a> {{config('version.name')}} 
                    </div>
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
                <!-- END INNER FOOTER -->
                <!-- END FOOTER -->
            </div>
        </div>
    </div>
<!-- END FOOTER -->
<!--[if lt IE 9]>
<script src="/assets/global/plugins/respond.min.js"></script>
<script src="/assets/global/plugins/excanvas.min.js"></script>
<script src="/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="/js/layer/layer.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
@yield('script')

@if(Session::get("admin"))
    <script type="text/javascript">
        $("#return_to_admin").click(function () {
            $.ajax({
                'url': "{{url("switchToAdmin")}}",
                'data': {
                    '_token': "{{csrf_token()}}"
                },
                'dataType': "json",
                'type': "POST",
                success: function (ret) {
                    layer.msg(ret.message, {time: 1000}, function () {
                        if (ret.status == 'success') {
                            window.location.href = "{{url('admin')}}";
                        }
                    });
                },
                error: function (ret) {
                    layer.msg("操作失败：" + ret, {time: 5000});
                }
            });
        });
    </script>
@endif
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-122312249-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-122312249-1');
</script>

<!-- 统计 -->
{!! \App\Components\Helpers::systemConfig()['website_analytics'] !!}
<!-- 客服 -->
{!! \App\Components\Helpers::systemConfig()['website_customer_service'] !!}
</body>


</html>