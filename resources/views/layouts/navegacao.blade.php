<!-- Main navigation -->
<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">

            <!-- Main -->
            <li class="navigation-header"><span>Menu</span> <i class="icon-menu" title="Principal"></i></li>
            @include('layouts.menus.menu')
            @if (Auth::user()->nivel === 'Admin')
            @include('layouts.menus.admin_menu')
            @endif
        </ul>
    </div>
</div>
<!-- /main navigation -->