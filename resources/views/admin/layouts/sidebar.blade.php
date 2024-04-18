<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend') }}/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>

    <!--navigation-->
    <ul class="metismenu" id="menu">
        
        <li>
            <a href="{{ route('frontend.home') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Back to home</div>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class="fa-solid fa-gauge"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>
                <li> <a href="{{ route('brand.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Brand</a>
                </li>
                <li> <a href="{{ route('brand.all') }}"><i class="bx bx-right-arrow-alt"></i>All Brand</a>
                </li>
            </ul>
        </li> 

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
                <li> <a href="{{ route('category.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
                </li>
                <li> <a href="{{ route('category.all') }}"><i class="bx bx-right-arrow-alt"></i>All Category</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Sub Category</div>
            </a>
            <ul>
                <li> <a href="{{ route('subcategory.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Sub Category</a>
                </li>
                <li> <a href="{{ route('subcategory.all') }}"><i class="bx bx-right-arrow-alt"></i>All Sub Category</a>
                </li>
            </ul>
        </li>
        
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Vendor Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('vendor.active') }}"><i class="bx bx-right-arrow-alt"></i>Active Vendor</a>
                </li>
                <li> <a href="{{ route('vendor.inactive') }}"><i class="bx bx-right-arrow-alt"></i>Inactive Vendor</a>
                </li>
            </ul>
        </li> 
        
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-cart"></i>
                </div>
                <div class="menu-title">Product Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('product.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
                <li> <a href="{{ route('product.all') }}"><i class="bx bx-right-arrow-alt"></i>All Products</a>
                </li>
            </ul>
        </li> 

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-sliders fs-6"></i></i>
                </div>
                <div class="menu-title">Hero Slider</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.hero-sliders.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
                </li>
                <li> <a href="{{ route('admin.hero-sliders.index') }}"><i class="bx bx-right-arrow-alt"></i>All Sliders</a>
                </li>
            </ul>
        </li> 

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-sliders fs-6"></i></i>
                </div>
                <div class="menu-title">Banner</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.banners.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
                </li>
                <li> <a href="{{ route('admin.banners.index') }}"><i class="bx bx-right-arrow-alt"></i>All Banners</a>
                </li>
            </ul>
        </li> 

        </li>
            <a href="{{ route('admin.logout') }}">
                <div class="parent-icon"><i class="bx bx-log-out-circle"></i>
                </div>
                <div class="menu-title">Logout</div>
            </a>
        </li>

    </ul>
</div>
  <!--end navigation-->