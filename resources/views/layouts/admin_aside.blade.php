<nav id="sidebar">
        <div class="shopName" style="height:84px;background: #f8f9fa;">
             <h3    style="padding: 21px 30px;color: darkolivegreen;font-weight: 700;">{{get_settings($settingdata, 'name')}}</h3>
  
        </div>

            <div class="sidebar-header"> 
                <div class="img-area">
                    <img src="{{URL::to(Auth::user()->photo)}}" alt="">
                    <h2>{{auth()->user()->name}}<br>
                    <span class="dis">{{auth()->user()->getRoleNames()->first()}}</span><span class="badge2"></span></h2>
                </div>
            </div>

            <ul class="list-unstyled components">
                <li class="@if(Request::is('/', '/*')) active @endif">
                    <a href="{{url('/')}}">
                            <img class="img" src="{{URL::to('assets/new-theme/images/Setting_icn/dashboard.png')}}" alt="">
                        <span class="title menu-nav-color-asidebar">Dashboard</span>
                        
                    </a>                  
                </li>
                <!-- Customer Section Start -->
                @if((auth()->user()->can('customer')) || auth()->user()->hasRole('super-admin'))
                <li class="@if(Request::is('customer', 'customer/*')) active @endif">
                    @if((auth()->user()->can('customer')) || auth()->user()->hasRole('super-admin'))
                    <a href="{{route('customer')}}">
                        <img class="img" src="{{asset('assets/new-theme/images/Setting_icn/customer.png')}}" alt="">
                        <span class="title menu-nav-color-asidebar">Customer</span>
                    </a>
                    @endif
                </li>
                @endif
                <!-- Customer Section End -->

                <!-- Categories Section Start -->
               
                @if((auth()->user()->can('categories.index')) || auth()->user()->hasRole('super-admin'))
                <li class="@if(Request::is('categories', 'categories/*')) active @endif">
                    @if((auth()->user()->can('categories.index')) || auth()->user()->hasRole('super-admin'))
                    <a href="{{route('categories.index')}}">
                        <img class="img" src="{{asset('assets/new-theme/images/Setting_icn/note.png')}}" alt="">
                        <span class="title menu-nav-color-asidebar">Categories</span>
                    </a>
                    @endif
                </li>
                @endif
                <!-- Categories Section End -->

                <!-- Products Section Start -->
                @if((auth()->user()->can('product.home')) || auth()->user()->hasRole('super-admin'))        
                <li class="@if(Request::is('product', 'products','units','suppliers', 'product/*','products/*', 'units/*','suppliers/*')) active menu-open @endif">
                     @if((auth()->user()->can('product.home')) || auth()->user()->hasRole('super-admin'))        
                    <a href="{{route('product.home')}}">
                        <img class="img" src="{{asset('assets/new-theme/images/Setting_icn/catagory.png')}}" alt="">
                        <span class="title menu-nav-color-asidebar">Items</span>        
                     </a>
                     @endif      
                </li>
                @endif      
                <!-- Products Section End -->

                <!-- Purchase Section End -->
                @if((auth()->user()->can('purchases.home')) || auth()->user()->hasRole('super-admin'))
                <li class="@if(Request::is('purchases','purchase', 'purchases/*','purchase/*')) active @endif">
                    @if((auth()->user()->can('purchases.home')) || auth()->user()->hasRole('super-admin'))   
                    <a href="{{route('purchases.home')}}">
                        <img class="img" src="{{asset('assets/new-theme/images/Setting_icn/img_172557.png')}}" alt="">
                        <span class="title menu-nav-color-asidebar">Purchase</span>
                    </a>
                    @endif
                </li>
                @endif
                <!-- Purchase Section End -->

                <!-- POS Section Start -->
                @if((auth()->user()->can('pos.home')) || auth()->user()->hasRole('super-admin'))
                <li class="@if(Request::is('pos','all/sell','new_invoices','return/product', 'pos/*','new_invoices/*','return/product*/')) active @endif">
                    @if((auth()->user()->can('pos.home')) || auth()->user()->hasRole('super-admin')) 
                    <a href="{{route('pos.home')}}">
                        <img class="img" src="{{asset('assets/new-theme/images/pos_icn/cash-register.png')}}" alt="">
                        <span class="title menu-nav-color-asidebar">Invoice</span>
                    </a>
                    @endif
                </li>
                @endif
                <!-- POS Section End -->

                <!-- Wastages Section Start -->
                @if((auth()->user()->can('wastage.home')) || auth()->user()->hasRole('super-admin'))
                <li class="@if(Request::is('wastage','wastages', 'wastage/*','wastages/*')) active @endif">
                    @if((auth()->user()->can('wastage.home')) || auth()->user()->hasRole('super-admin')) 
                    <a href="{{route('wastage.home')}}">
                        <img class="img" src="{{asset('assets/new-theme/images/Setting_icn/recycle-sign.png')}}" alt="">
                        <span class="title menu-nav-color-asidebar">Wastages</span>
                    </a>
                    @endif
                </li>
                @endif
                 <!-- Wastages Section End -->
                 <!-- Expense Section Start -->
                @if((auth()->user()->can('expense.home')) || auth()->user()->hasRole('super-admin'))
                    <li class="@if(Request::is('expense','expenses', 'expense/*','expenses/*')) active @endif">
                        @if((auth()->user()->can('expense.home')) || auth()->user()->hasRole('super-admin')) 
                            <a href="{{route('expense.home')}}">
                                <img class="img" src="{{asset('assets/new-theme/images/Setting_icn/money.png')}}" alt="">
                                <span class="title menu-nav-color-asidebar">Expense</span>
                            </a>
                        @endif
                    </li>
                @endif
                <!-- Expense Section End -->
                <!-- Start Report -->
                @if((auth()->user()->can('report.home')) || auth()->user()->hasRole('super-admin'))
                    <li class="@if(Request::is('report','sale-report','report-purchase','due-report','supplier-report','customer-report', 
                        'report/*','sale-report/*' ,'report-purchase/*' ,'due-report/*' ,'supplier-report/*' ,'customer-report/*')) active @endif">
                        @if((auth()->user()->can('report.home')) || auth()->user()->hasRole('super-admin')) 
                            <a href="{{route('report.home')}}">
                                <img class="img" src="{{asset('assets/new-theme/images/report_icn/report.png')}}" alt="">
                                <span class="title menu-nav-color-asidebar">Report</span>
                            </a>
                        @endif
                    </li>
                @endif
                <!-- End Report -->
                <!-- Settings Section Start -->
                @if((auth()->user()->can('module_setting.home')) || auth()->user()->hasRole('super-admin'))
                    <li class="@if(Request::is('setting','roles','users','settings', 'setting/*','roles/*','users/*','settings/*')) active @endif">
                        @if((auth()->user()->can('module_setting.home')) || auth()->user()->hasRole('super-admin')) 
                            <a href="{{route('module_setting.home')}}">
                                <img class="img" src="{{asset('assets/new-theme/images/Setting_icn/settings.png')}}" alt="">
                                <span class="title menu-nav-color-asidebar">Settings</span>  
                            </a>
                        @endif
                    </li>
                @endif
                <!-- Settings Section End -->

               
                <!-- <li class="li-bg"> <a href=""><i class="fas fa-lock"></i>LOCK</a> </li>   -->
          
            </ul>
        </nav>