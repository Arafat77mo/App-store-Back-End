<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
    <div class="m-container m-container--fluid m-container--full-height">
        <div class="m-stack m-stack--ver m-stack--desktop">

            <!-- BEGIN: Brand -->
            <div class="m-stack__item m-brand  m-brand--skin-dark ">
                <div class="m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                        <a href="#" class="m-brand__logo-wrapper">
                            <img alt="" width="90px"
                                 src="{{asset('metronic/assets/demo/default/media/img/logo/logo_default_dark.png')}}" />

                        </a>
                    </div>
                    
                    <div class="m-stack__item m-stack__item--middle m-brand__tools">

                        <!-- BEGIN: Left Aside Minimize Toggle -->
                        <a href="javascript:;" id="m_aside_left_minimize_toggle"
                           class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                            <span></span>
                        </a>

                        <!-- END -->

                        <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                        <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                           class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>

                        <!-- END -->

                        <!-- BEGIN: Responsive Header Menu Toggler -->
                        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
                           class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>

                        <!-- END -->

                        <!-- BEGIN: Topbar Toggler -->
                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                           class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                            <i class="flaticon-more"></i>
                        </a>

                        <!-- BEGIN: Topbar Toggler -->
                    </div>
                </div>
            </div>

            <!-- END: Brand -->
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

                <!-- BEGIN: Horizontal Menu -->
                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark "
                        id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
               

                <!-- END: Horizontal Menu -->

                <!-- BEGIN: Topbar -->

                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
                    <div class="m-stack__item m-topbar__nav-wrapper">                                    

                        <ul class="m-topbar__nav m-nav m-nav--inline">
                            

                            <li class="m-nav__item dropdown-notifications m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                m-dropdown-toggle="click">                                                   
                                 @php($adminNote = \App\Models\AdminNote::query()->where('seen',0)->orderBy('created_at', 'desc')->get())

                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-topbar__userpic">
                                    <i data-count="" class="glyphicon glyphicon-bell notification-icon"></i>
                                    </span>                                  
                                      @if($adminNote->count())

                                      <span class="badge badge-notify" style=" background:red;
   position:relative;
   top: 0px;
   left: -35px;">{{$adminNote->count()}}</span>@endif


                                    <!--span class="m-badge m-badge--success m-badge--wide"></span-->
                                    <span class="m-topbar__username m--hide">محمد</span>
                                </a>

                                <div class="m-dropdown__wrapper">

                                    <span
                                        class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust custom-arrow-style" style=""></span>
                                    <div class="m-dropdown__inner">

                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">

                                                <div class="dropdown-container">
                                                    <div class="dropdown-toolbar">
                                                        <div class="dropdown-toolbar-actions">
                                                            <a href="#">Mark all as read</a>
                                                        </div>
                                                        <h3 class="dropdown-toolbar-title">Notifications (@if($adminNote->count())<span class="notif-count">{{$adminNote->count()}}</span>  @endif)</h3>
                                                    </div>
 @forelse($adminNote as $note)
                                                    <div class='user-notifications'>                        <i class="fa fa-file ml-2"></i> {{$note->title}} {{$note->content}}
</div>
@empty
                        <span class="dropdown-item text-center">
                            لا يوجد اشعارات
                        </span>
                        
                        
                    @endforelse
                  @php(\App\Models\AdminNote::query()->update(['seen'=>1]))

                                                    <div class="dropdown-footer text-center">
                                                        <a href="{{url('admin/notes')}}">View All</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                m-dropdown-toggle="click">


                                <a href="#" class="m-nav__link m-dropdown__toggle"><span class="m-card-user__name m--font-weight-500">{{auth()->user()->f_name??''}} {{auth()->user()->l_name??''}}</span>
                                    <span class="m-topbar__userpic">
                                        <img src="{{asset('metronic/assets/app/media/img/users/user.png')}}"
                                             class="m--img-rounded m--marginless  m-portlet m-portlet--bordered" alt="" />
                                    </span>
                                    <!--span class="m-badge m-badge--success m-badge--wide"></span-->
                                    <span class="m-topbar__username m--hide">محمد</span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span
                                        class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust custom-arrow-style" style=""></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center"
                                             style="background: url({{asset('metronic/assets/app/media/img/misc/user_profile_bg.jpg')}}); background-size: cover;">
                                            <div class="m-card-user m-card-user--skin-dark">
                                                <div class="m-card-user__pic">
                                                    <img src="{{auth()->user()->image??''}}"

                                                         class="m--img-rounded m--marginless" alt="" />


                                                </div>
                                                <div class="m-card-user__details">
                                                    <span class="m-card-user__name m--font-weight-500">{{auth()->user()->f_name??''}} {{auth()->user()->l_name??''}}</span>
                                                    <a href="" onclick="event.preventDefault(); "
                                                       class="m-card-user__email m--font-weight-300 m-link">{{auth()->user()->email??''}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav m-nav--skin-light">
                                                    <li class="m-nav__section m--hide">
                                                        <span class="m-nav__section-text">Section</span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('admin.indexx') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                            <span class="m-nav__link-title">
                                                                <span class="m-nav__link-wrap">
                                                                    <span class="m-nav__link-text">الملف الشخصي</span>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a  href='{{ route("user.edit",auth()->user()->id) }}' class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-share"></i>
                                                            <span class="m-nav__link-text">تغيير كلمة المرور</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href=""
                                                           class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-globe"></i>
                                                            <span class="m-nav__link-text">{{app()->getLocale()=='ar'?'English':'عربي'}}</span></a>


                                                    </li>

                                                    <li class="m-nav__item">
                                                        <form method="POST" action="{{ route('logout') }}">
                                                            @csrf
                                                            <a href="route('logout')"
                                                               onclick="event.preventDefault(); this.closest('form').submit();"
                                                               class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">{{trans('messages.signout')}}</a>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </li>
                        </ul>

                    </div>
                </div>

                <!-- END: Topbar -->
            </div>
        </div>
    </div>
    
</header>
