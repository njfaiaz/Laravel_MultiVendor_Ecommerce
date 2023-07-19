<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('admin/assets') }}/images/logo-icon.png" class="logo-icon" alt="logo icon">
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
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>
                <li> <a href="{{ route('brand') }}"><i class="bx bx-right-arrow-alt"></i>All Brand</a>
                </li>
                <li> <a href="{{ route('brand.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Brand</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
                <li> <a href="{{ route('category') }}"><i class="bx bx-right-arrow-alt"></i>All Category</a>
                </li>
                <li> <a href="{{ route('category.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Sub Category</div>
            </a>
            <ul>
                <li> <a href="{{ route('subcategory') }}"><i class="bx bx-right-arrow-alt"></i>All Sub Category</a>
                </li>
                <li> <a href="{{ route('subcategory.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Sub Category</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Vendor Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('inactive.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Inactive Vendor</a>
                </li>
                <li> <a href="{{ route('active.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Active Vendor</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Product Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('product') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
                </li>
                <li> <a href="{{ route('product.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Slider Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('slider') }}"><i class="bx bx-right-arrow-alt"></i>All Slider</a>
                </li>
                <li> <a href="{{ route('slider.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Banner Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('banner') }}"><i class="bx bx-right-arrow-alt"></i>All Banner</a>
                </li>
                <li> <a href="{{ route('banner.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Coupon System</div>
            </a>
            <ul>
                <li> <a href="{{ route('coupon') }}"><i class="bx bx-right-arrow-alt"></i>All Coupon</a>
                </li>
                <li> <a href="{{ route('coupon.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
                </li>
            </ul>
        </li>

    </ul>
    <!--end navigation-->
</div>
