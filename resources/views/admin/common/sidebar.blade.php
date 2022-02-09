<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" style="font: 14px">
                <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">CÁ NHÂN</span></li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('home') }}" ><i class="mdi mdi-view-dashboard"></i><span>Bảng điều khiển</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('destination.index') }}" ><i class="fas fa-map-marked"></i></i><span>Điểm đến </span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('type-of-tour.index') }}" ><i class="fas fa-bookmark"></i></i><span>Loại hình tham quan</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('tour.index') }}" ><i class="fas fa-plane-departure"></i><span>Chuyến tham quan</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('booking.index') }}" ><i class="fas fa-hotel"></i><span>Đặt vé</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('contact.index') }}" ><i class="fas fa-phone-square-alt"></i><span>Phản hồi</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('user.index') }}" ><i class="fas fa-users"></i><span>Tài Khoản</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<style>
    nav > ul > li >a:hover{text-decoration: none};
</style>
