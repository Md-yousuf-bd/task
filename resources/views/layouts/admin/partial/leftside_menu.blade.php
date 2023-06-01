<div class="vertical-menu">

    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    {{-- href="{{ route('admin.dashboard') }}" --}}
                    <a class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-danger float-end">04</span>
                        <span key="t-dashboards">{{ __('text.dashboard') }}</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fa-solid fa-copy text-info"></i>
                        <span key="t-dashboards">{{ __('text.product') }} </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{ route('products.create') }}" key="t-horizontal">{{ __('text.addProductCreate') }}</a></li>

                        <li><a href="{{ route('products.index') }}" key="t-horizontal">{{ __('text.productList') }}</a>
                        </li>
                    </ul>
                </li>
                {{-- Create Corses --}}
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fa-solid fa-copy text-info"></i>
                        <span key="t-dashboards">{{ __('text.productAddStock') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('stocks.index') }}" key="t-horizontal">{{ __('text.add') }}</a></li>
                        {{-- <li><a href="{{ route('course.list') }}" key="t-horizontal">List
                                list</a></li> --}}
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End --
