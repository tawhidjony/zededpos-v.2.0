<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-bars"></i>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent ">
            <ul class="nav navbar-nav mr-auto ml-5 Top-nav-icon">
                
               <li class="nav-item">
                     <a href="{{route('pos.create')}}"> <img class="img pos" src="{{asset('assets/new-theme/images/Setting_icn/cash-register.png')}}" alt="pos" data-toggle="tooltip" data-placement="bottom" title="POS"></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('customer')}}"><img class="img" src="{{asset('assets/new-theme/images/Setting_icn/customer2.png')}}" alt="customer"data-toggle="tooltip" data-placement="bottom" title="Customer"></a>
                </li>
                <li class="nav-item">
                     <a href="{{route('categories.index')}}"><img class="img" src="{{asset('assets/new-theme/images/Setting_icn/note2.png')}}" alt="category"data-toggle="tooltip" data-placement="bottom" title="Category"></a>
                </li>
               <li class="nav-item">
                    <a href="{{route('product.home')}}"><img class="img" src="{{asset('assets/new-theme/images/Setting_icn/catagory2.png')}}" alt="product"data-toggle="tooltip" data-placement="bottom" title="Product"></a>
                </li>
               <li class="nav-item">
                     <a href="{{route('purchases.home')}}"> <img class="img" src="{{asset('assets/new-theme/images/Setting_icn/img_1725572.png')}}" alt="purchase"data-toggle="tooltip" data-placement="bottom" title="Purchase"></a>
                </li>
               <li class="nav-item">
                    <a href="{{route('wastage.home')}}"> <img class="img" src="{{asset('assets/new-theme/images/Setting_icn/recycle-sign2.png')}}" alt="wastages"data-toggle="tooltip" data-placement="bottom" title="Wastages"></a>
                </li>
               <li class="nav-item">
                    <a href="{{route('expense.home')}}"><img class="img" src="{{asset('assets/new-theme/images/Setting_icn/money2.png')}}" alt="expense"data-toggle="tooltip" data-placement="bottom" title="Expense"></a>
                </li>
               <li class="nav-item">
                    <a href="{{route('report.home')}}"><img class="img" src="{{asset('assets/new-theme/images/Setting_icn/report2.png')}}" alt="report"data-toggle="tooltip" data-placement="bottom" title="Report"></a>
                </li>
               <li class="nav-item">
                     <a href="{{route('module_setting.home')}}"><img class="img" src="{{asset('assets/new-theme/images/Setting_icn/settings2.png')}}" alt="setting"data-toggle="tooltip" data-placement="bottom" title="Setting"></a>
                </li>
            </ul>
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link navbar-avatar waves-effect waves-light waves-round" data-toggle="dropdown"
                        href="#" aria-expanded="false" data-animation="scale-up" role="button">
                        <span class="avatar avatar-online">
                            <img src="{{URL::to(Auth::user()->photo)}}" alt="...">
                        </span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item waves-effect waves-light waves-round" href="{{url('/account')}}"
                            role="menuitem"> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item waves-effect waves-light waves-round"
                            onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();"
                            role="menuitem">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link">{{auth()->user()->name}}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
