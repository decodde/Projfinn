<div class="main-menu menu-static menu-light menu-accordion menu-shadow border-radius-10" data-scroll-to-active="true">
    <div class="main-menu-content border-radius-10">
        <ul class="navigation navigation-main border-radius-10" id="main-menu-navigation" data-menu="menu-navigation">

                @if(Request::is('dashboard'))
                <li class=" nav-item open">
                    <a href="{{URL('dashboard')}}" class="active">
                @else
                    <li class=" nav-item">
                        <a href="{{URL('dashboard')}}">
                @endif
                    <i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">Overview</span>
                </a>
            </li>
                @if(Request::is('dashboard/eligibility/score*'))
                    <li class=" nav-item open">
                        <a href="{{URL('dashboard/eligibility/score')}}" class="active">
                @else
                    <li class=" nav-item">
                        <a href="{{URL('dashboard/eligibility/score')}}">
                @endif
                    <i class="la la-check"></i><span class="menu-title" data-i18n="nav.templates.main">Eligibility</span>
                </a>
            </li>
                @if(Request::is('dashboard/document*'))
                    <li class=" nav-item open">
                        <a href="{{URL('dashboard/document')}}" class="active">
                @else
                    <li class=" nav-item">
                        <a href="{{URL('dashboard/document')}}">
                @endif
                    <i class="la la-paperclip"></i><span class="menu-title" data-i18n="nav.templates.main">Documents</span>
                </a>
            </li>
                @if(Request::is('dashboard/funds*'))
                    <li class=" nav-item open">
                        <a href="{{URL('dashboard/funds')}}" class="active">
                @else
                    <li class=" nav-item">
                        <a href="{{URL('dashboard/funds')}}">
                @endif
                    <i class="la la-money"></i><span class="menu-title" data-i18n="nav.templates.main">Funds</span>
                </a>
            </li>
                @if(Request::is('dashboard/settings*'))
                    <li class=" nav-item open">
                        <a href="{{URL('dashboard/settings')}}" class="active">
                @else
                    <li class=" nav-item">
                        <a href="{{URL('dashboard/settings')}}">
                @endif
                    <i class="la la-cog"></i><span class="menu-title" data-i18n="nav.templates.main">Settings</span>
                </a>
            </li>
        </ul>
    </div>
</div>
