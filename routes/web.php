<?php

use App\Http\Controllers\admin_manager;
use App\Http\Controllers\user_manager;
use App\Models\category;
use App\Models\Product;
use App\Models\User;
use App\Repository\user_manage;
use App\Services\admin_panel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Filament\Forms\Components\Split;
use Illuminate\Support\Facades\Date;
use PhpParser\Node\Expr\Cast\String_;

use function PHPSTORM_META\type;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$adminpage;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/admin_login', [admin_manager::class, 'adminlogin']);

Route::get('/login', function () {
    if (Session::has('userlogin')) {
        Session::forget('userlogin');
        $difference = Carbon::now()->diff(Session::get('user_active_time'));
        DB::table('users')
            ->where('id', Session::get('user_id'))
            ->update([
                "status" => "offline",
                "last_active_time" => $difference->format('%h:%I:%S'),
            ]);
        Session::forget('user_id');
        Session::forget('user_active_time');
    }
    return view('login');
});

Route::get('/admin/dashboard', [admin_manager::class, 'dashboard'])->middleware('admin_session_maintain');
Route::post('/getactiveuser', [admin_manager::class, 'getactiveuser']);
Route::get('/userlogin', [user_manager::class, 'login']);

Route::get('/userregister', [user_manager::class, 'register']);

Route::get('/homepage', [user_manager::class, 'homepage'])->middleware('user_session_maintain');
Route::get('/productdisplay', [user_manager::class, 'displayproducts']);
Route::get('/displayporduct/{id}', [user_manager::class, 'displayproducts']);
Route::get('/productdetail/{id}', [user_manager::class, 'productdetail']);

Route::get('/addtocart', [user_manager::class, 'addtocart'])->name('addtocart');
Route::post('/deleteproductfromcart', [user_manager::class, 'deleteproductfromcart']);
Route::post('/addtocart', [user_manager::class, 'addproducttocart']);
Route::post('/updateprice', [user_manager::class, 'updateproductprice']);

Route::get('/wishlist', [user_manager::class, 'wishlist']);
Route::post('/addtowishlist', [user_manager::class, 'addtowishlist']);
Route::post('/deleteproductfromwishlist', [user_manager::class, 'deleteproductfromwishlist']);

Route::get('/checkout', [user_manager::class, 'checkout']);
Route::post('/billingcheckoutcheckout', [user_manager::class, 'billingcheckoutcheckout'])->name('billingcheckoutcheckout');

Route::post('/placeorder', [user_manager::class, 'placeorder']);
Route::post('/cancelorder', [user_manager::class, 'cancelorder']);
Route::get('/order', [user_manager::class, 'order']);

Route::get('/displayinvoice/{invoiceno}', [user_manager::class, 'displayinvoice']);
Route::get('/downloadinvoice/{invoiceno}', [user_manager::class, 'downloadinvoice']);
Route::get('/printinvoice/{invoiceno}', [user_manager::class, 'printinvoice']);


Route::post('/checkdiscountcode', [user_manager::class, 'checkdiscountcode']);

Route::get('/adminlogin', function () {
    if (Session::has('usertype')) {
        Session::forget('usertype');
        Session::forget('name');
        $difference = Carbon::now()->diff(Session::get('admin_active_time'));
        DB::table('users')
            ->where('id', Session::get('admin_id'))
            ->update([
                "status" => "offline",
                "last_active_time" => $difference->format('%h:%I:%S'),
            ]);
        Session::forget('admin_id');
        Session::forget('admin_active_time');
    }
    return view('Admin_login');
});


Route::post('/adminlogin', [admin_manager::class, 'adminlogin']);

Route::get('/admin/productdetails', [admin_manager::class, 'product_details'])->middleware('admin_session_maintain');

Route::get('/admin/categorydetails', [admin_manager::class, 'category_details'])->middleware('admin_session_maintain');
Route::get('/admin/branddetails', [admin_manager::class, 'brand_details'])->middleware('admin_session_maintain');
Route::get('/admin/subcategorydetails', [admin_manager::class, 'sub_category_details'])->middleware('admin_session_maintain');


Route::get('/admin/userdetails', [admin_manager::class, 'getuserdetail'])->name('userdetails')->middleware('admin_session_maintain');

Route::post('/admin/adduser', [admin_manager::class, 'adduser'])->name('add_user');
Route::post('/admin/addcategory', [admin_manager::class, 'addcategory'])->name('add_category');

Route::post('/admin/addsubcategory', [admin_manager::class, 'addsubcategory'])->name('add_sub_category');
Route::post('/admin/getsubcategory', [admin_manager::class, 'getsubcategory'])->name('get-sub-category');
Route::post('/admin/editsubcategory', [admin_manager::class, 'editsubcategory'])->name('edit-sub-category');
Route::post('/admin/udpatesubcategory', [admin_manager::class, 'updatesubcategory'])->name('update-sub-category');
Route::post('/admin/deletesubcategory', [admin_manager::class, 'deletesubcategory'])->name('delete-sub-category');

Route::post('/admin/addbrand',[admin_manager::class,'addbrand'])->name('add-brand');
Route::post('/admin/getbranddata',[admin_manager::class,'get_brand_data'])->name('get-brand-data');
Route::post('/admin/deletebranddata',[admin_manager::class,'delete_brand_data'])->name('delete-brand-data');
Route::post('/admin/editbrand',[admin_manager::class,'edit_brand'])->name('edit-brand');
Route::post('/admin/updatebrand',[admin_manager::class,'update_brand'])->name('update-brand');


Route::get('/admin/userdataget', [user_manager::class, 'getuserdata']);

Route::post('/delete', [admin_manager::class, 'deleteuser']);
Route::post('/edit', [admin_manager::class, 'edituser']);
Route::post('/updateuser', [admin_manager::class, 'updateuser'])->name('updateuser');

Route::post('/admin/categorydata', [admin_manager::class, 'categorydata'])->middleware('admin_session_maintain');
Route::post('/editcategory', [admin_manager::class, 'editcategory']);
Route::post('/updatecategory', [admin_manager::class, 'updatecategory'])->name('updatecategory');
Route::post('/deletecategory', [admin_manager::class, 'deletecategory']);

Route::post('/addproduct', [admin_manager::class, 'addproduct'])->name('addproduct');
Route::get('/admin/product_add', [admin_manager::class, 'product_add'])->middleware('admin_session_maintain');
Route::post('/getproducts', [admin_manager::class, 'getproducts'])->name('getproducts');
Route::post('/editproduct', [admin_manager::class, 'editproduct'])->name('editproduct');
Route::post('/updateproduct', [admin_manager::class, 'updateproduct'])->name('updateproduct');
Route::post('/deleteproduct', [admin_manager::class, 'deleteproduct'])->name('deleteproduct');
Route::post('/getproductinfo',[admin_manager::class,'getproductinfo']);
Route::post('/getsubcategory',[admin_manager::class,'get_sub_category']);
Route::post('/getbrand',[admin_manager::class,'get_brand'])->name('get-brand');

Route::get('/admin/orderdetails', [admin_manager::class, 'orderdetails'])->middleware('admin_session_maintain');

Route::post('/adddiscountcoupon', [admin_manager::class, 'adddiscountcoupon']);
Route::post('/updatediscountcoupondata', [admin_manager::class, 'updatediscountcoupondata']);
Route::post('/getdiscountcoupondata', [admin_manager::class, 'getdiscountcoupondata']);
Route::post("/deletediscountcoupon",[admin_manager::class,'deletediscountcoupon']);
Route::get('/admin/discountcoupon', [admin_manager::class, 'discount_coupon']);

Route::post('/getorders', [admin_manager::class, 'getorders']);
Route::post('/getorderbysort', [admin_manager::class, 'getorderbysort']);
Route::post('/gettopsellingproduct', [admin_manager::class, 'gettopsellingproduct']);
Route::post('/gettopsellingproductbyprice', [admin_manager::class, 'gettopsellingproductbyprice']);
Route::post('/getdatafromdate', [admin_manager::class, 'getdatafromdate']);
Route::post('/updateorderstatus', [admin_manager::class, 'updateorderstatus']);
Route::post('/deleteorder', [admin_manager::class, 'deleteorder']);


Route::get("/displaydiscountcoupon", function () {
    return view("mail_discount_coupon");
});


Route::get("/error/{errorstatus}/{errormessage}", [user_manager::class, 'errors']);

Route::get("/edit_product/{id}",[admin_manager::class,'edit___product']);

Route::get('/checking', function () {


    // $data = DB::select('SELECT DISTINCT variant_name FROM variant_details');


    // foreach ($data as $key => $value) {
    //     $datas = DB::select('SELECT GROUP_CONCAT(variant_colour) AS colours, GROUP_CONCAT(variant_stock) AS stocks, GROUP_CONCAT(variant_price) AS prices FROM variant_details WHERE variant_name = ?', [$value->variant_name]);

    //     print_r($datas);
    //     echo "<br>";
    // }

    // $data = DB::Select('select p.name,p.shortDescription,p.Description,p.price,p.stock,c.name from products as p Left join categories as c  on c.id = p.category_id ');

    // $data = Product::leftjoin('categories','categories.id','=','products.category_id')
    // ->select("products.*","categories.name as c_name")
    // ->get();
    // print_R($data->toJson());
    // print_R($data);

    $data = Db::table('users')
    ->leftJoin('products','users.id','=','products.user_id')
    ->select('products.name as product_name','users.name as user_name','products.price')
    ->get();
    var_dump($data->toJson());

});

Route::get("/checkingselect",[user_manager::class,'getdataselect']);
