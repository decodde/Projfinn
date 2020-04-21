<div class="main-menu menu-static menu-light menu-accordion menu-shadow border-radius-10" data-scroll-to-active="true">
    <div class="main-menu-content border-radius-10">
        <ul class="navigation navigation-main border-radius-10" id="main-menu-navigation" data-menu="menu-navigation">

            @if(Request::is('dashboard/i'))
                <li class=" nav-item open">
                    <a href="{{URL('dashboard/i')}}" class="active">
            @else
                <li class=" nav-item">
                    <a href="{{URL('dashboard/i')}}">
                        @endif
                        <i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">Overview</span>
                    </a>
                </li>
                @if(Request::is('dashboard/i/stash*'))
                    <li class=" nav-item open">
                        <a href="{{URL('dashboard/i/stash')}}" class="active">
                @else
                    <li class=" nav-item">
                        <a href="{{URL('dashboard/i/stash')}}">
                            @endif
                            <i class="la la-check"></i><span class="menu-title" data-i18n="nav.templates.main">Stash</span>
                        </a>
                    </li>
                    @if(Request::is('dashboard/document*'))
                        <li class=" nav-item open">
                            <a href="{{URL('dashboard/document')}}" class="active">
                    @else
                        <li class=" nav-item">
                            <a href="{{URL('dashboard/document')}}">
                                @endif
                                <i class="la la-paperclip"></i><span class="menu-title" data-i18n="nav.templates.main">Businesses</span>
                            </a>
                        </li>
                        <li class=" nav-item">
                            <a href="#"><i class="la la-money"></i><span class="menu-title" data-i18n="nav.templates.main">Notifications</span></a>
                        </li>
                        <li class=" navigation-header">
                            <span data-i18n="nav.category.layouts">License</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"
                                                                                    data-placement="right" data-original-title="Layouts"></i>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="la la-columns"></i><span class="menu-title" data-i18n="nav.page_layouts.main">Reviews</span></a>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="la la-navicon"></i><span class="menu-title" data-i18n="nav.navbars.main">Notifications</span></a>
                        </li>
        </ul>
    </div>
</div>
