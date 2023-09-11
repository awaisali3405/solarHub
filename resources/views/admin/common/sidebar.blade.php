<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.category.index') }}">
                <i class="mdi mdi-language-c menu-icon"></i>
                <span class="menu-title">Category</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.subCategory.index') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Sub Category</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.accessories.index') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Accessories</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.product.index') }}">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">Product</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.inventory.index') }}">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">Inventory</span>
            </a>
        </li> --}}
        <li class="nav-item">
            <div class="btn-group">
                <a class="nav-link" data-toggle="collapse" data-target="#ui-basic">
                    <i class="menu-icon mdi mdi-floor-plan"></i>
                    <span class="menu-title">Order</span>

                </a>
                <span type="button" class=" dropdown-toggle dropdown-toggle-split mt-2" id="dropdownMenuSplitButton5"
                    data-bs-toggle="dropdown" aria-haspopup="false" aria-expanded="false ">
                    <i class="menu-arrow"></i>
                </span>
                <div class="dropdown-menu " aria-labelledby="dropdownMenuSplitButton5" data-popper-placement="top-start"
                    style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(115px, -46.2px);">
                    <a class="dropdown-item" href="{{ route('admin.order.index') }}">
                        Orders
                    </a>
                    <a class="dropdown-item" href="{{ route('admin.onlineOrder.index') }}">
                        Online Orders
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <div class="btn-group">
                <a class="nav-link" data-toggle="collapse" data-target="#ui-basic">
                    <i class="mdi mdi-human-male menu-icon"></i>
                    <span class="menu-title">Customer</span>
                </a>
                <span type="button" class=" dropdown-toggle dropdown-toggle-split mt-2" id="dropdownMenuSplitButton5"
                    data-bs-toggle="dropdown" aria-haspopup="false" aria-expanded="false ">
                    <i class="menu-arrow"></i>
                </span>
                <div class="dropdown-menu " aria-labelledby="dropdownMenuSplitButton5" data-popper-placement="top-start"
                    style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(115px, -46.2px);">
                    <a class="dropdown-item" href="{{ route('admin.customer.index') }}">
                        Customer
                    </a>
                    <a class="dropdown-item" href="{{ route('admin.user.index') }}">
                        Online Customer
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.product.index') }}">
                <i class="mdi mdi-human-greeting menu-icon"></i> <span class="menu-title">Product</span>
            </a>

        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.supplier.index') }}">
                <i class="mdi mdi-human-greeting menu-icon"></i>
                <span class="menu-title">Supplier</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.seller.index') }}">
                <i class="mdi mdi-human-greeting menu-icon"></i>
                <span class="menu-title">Seller</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.customer.index') }}">
                <i class="mdi mdi-human-male menu-icon"></i>
                <span class="menu-title">Customer</span>
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dailyExpense.index') }}">
                <i class="mdi mdi-human-male menu-icon"></i>
                <span class="menu-title">Daily Expense</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.recipe.index') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Recipe</span>
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.purchase.index') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Purchase</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.sale.index') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Sale</span>
            </a>
        </li>
        {{--
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.employee.index') }}">
                <i class="mdi mdi-human-male menu-icon"></i>
                <span class="menu-title">Employee</span>
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.chat.index') }}">
                <i class="mdi mdi-human-male menu-icon"></i>
                <span class="menu-title">Chat</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                <i class=" mdi mdi-power  menu-icon"></i>
                <span class="menu-title">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>

    </ul>
</nav>
