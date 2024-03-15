 <?php
 if(Session::has('user_id'))
 {
    $cart_count = DB::table('addtocart')->where('user_id',Session::get('user_id'))->count();
    $wishlist_count = DB::table('wishlist')->where('user_id',Session::get('user_id'))->count();
    $cat_data = DB::table('categories')->get();
 }

 ?>
 <!-- Topbar Start -->

 <div class="container-fluid">

     <div class="row align-items-center py-3 px-xl-5" style="width:205%;" >
         <div class="col-lg-3 d-none d-lg-block">
             <a href="" class="text-decoration-none">
                 <h1 class="m-0 display-5 font-weight-semi-bold"><span
                         class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
             </a>
         </div>
         <div class="col-lg-3 col-6 text-right">
             <a href="{{ Session::has('user_id') ? "/wishlist" : "" }}" class="btn border">
                 <i class="fas fa-heart text-primary"></i>
                 <span class="badge wishlistcount">{{ Session::has('user_id') ? $wishlist_count : "0" }}</span>
             </a>
             <a href="{{ Session::has('user_id') ? "/addtocart" : "" }}" class="btn border">
                 <i class="fas fa-shopping-cart text-primary"></i>
                 <span class="badge">{{ Session::has('user_id') ? $cart_count : "0" }}</span>
             </a>
         </div>
     </div>
 </div>


 <!-- Topbar End -->

 <div class="col-lg-3 d-none d-lg-block">
     <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
         data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
         <h6 class="m-0">Categories</h6>
         <i class="fa fa-angle-down text-dark"></i>
     </a>
     <nav class="collapse {{ $user_panel_page == 'homepage' ? 'show' : '' }}  navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
         id="navbar-vertical">
         <div class="navbar-nav w-100 h-auto overflow-hidden">
             @foreach ($cat_data as $category)
                 <a href="/displayporduct/{{ $category->id }}" class="nav-item nav-link">{{ $category->name }}</a>
             @endforeach
         </div>
     </nav>
 </div>
 <div class="col-lg-9">
     <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
         <a href="" class="text-decoration-none d-block d-lg-none">
             <h1 class="m-0 display-5 font-weight-semi-bold"><span
                     class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
         </a>
         <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
             <div class="navbar-nav mr-auto py-0">
                 <a href="/homepage"
                     class="nav-item nav-link {{ $user_panel_page == 'homepage' ? 'active' : '' }}">Home</a>
                 <a href="/displayporduct/0"
                     class="nav-item nav-link {{ $user_panel_page == 'shop' ? 'active' : '' }}">Shop</a>
             </div>
             <div class="navbar-nav ml-auto py-0 dropdown show">
                 @if (Session::has('userlogin'))
                     <a href="" class="nav-item nav-link border dropdown-toggle" role="button" id="dropdownMenuLink"
                         data-toggle="dropdown" aria-haspopup="true"
                         aria-expanded="false">{{ Session::get('userlogin') }}</a>

                     <div class="dropdown-menu" style="width: 50px;" aria-labelledby="dropdownMenuLink">
                         <a class="dropdown-item" href="/login" style="width:50px;">Logout</a>
                         <a class="dropdown-item" href="/order" style="width:50px;">Your Order</a>
                     </div>
                 @else
                     <a href="/login" class="nav-item nav-link">Login/Register</a>
                 @endif

             </div>
         </div>
     </nav>
