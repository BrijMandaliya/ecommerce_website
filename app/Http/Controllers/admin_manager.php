<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\admin_panel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables;
use App\Filament\Resources\CategoryresourceResource;
use App\Models\brand;
use App\Models\Product;
use App\Models\sub_category;
use App\Services\DataManipulation;
use Filament\Facades\Filament;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\DataTables\ProductDataTable;

use function Laravel\Prompts\table;
use function Termwind\render;

class admin_manager extends Controller
{
    protected $admin, $getdata, $data;
    public function __construct(admin_panel $admin, DataManipulation $getdata)
    {
        $this->admin = $admin;
        $this->getdata = $getdata;
    }

    public function dashboard()
    {
        $this->data = $this->admin->dashboard();

        return view('admin.dashboard', $this->data);
    }

    public function getorderbysort(Request $request)
    {
        $this->data = DB::table('place_order')->orderBy($request->sortby, 'DESC')->take(5)->get();
        return $this->data;
    }

    public function gettopsellingproduct(Request $request)
    {
        return $this->admin->get_top_selling_product();
    }

    public function gettopsellingproductbyprice(Request $request)
    {
        return $this->admin->get_top_selling_product_by_price();
    }

    public function getdatafromdate(Request $request)
    {
        return $this->getdata->selectdata('place_order', [['order_placed_date', $request->_date]]);
    }

    public function getactiveuser()
    {
        // return DB::table('users')
        //     ->select(DB::raw('COUNT(CASE WHEN users.status = "online" THEN 1 ELSE NULL END) as user_active_count'))
        //     ->get();

        // return DB::table('users')
        // ->select(DB::raw('CASE WHEN users.status = \"online\" THEN COUNT(*) END'))->get();
        return $this->getdata->selectdata('users', [['status', 'online']]);
    }

    public function product_details(ProductDataTable $datatable, Product $model)
    {
        $adminpage = 'product_details';
        $cat_data = $this->getdata->selectdata('categories');
        $variantData = DB::table('variant_details');
        $proData = Product::all();
        // dd($datatable->getData());
        $this->data = ["adminpage" => $adminpage, "cat_data" => $cat_data, "proData" => $proData, "variantData" => $variantData];
        return $datatable->render('admin.product_details', $this->data);
        // return view('admin.product_details', $this->data);
    }

    public function adminlogin(Request $request)
    {
        $data =  $this->admin->admin_login($request);
        if ($data == "notadmin") {
            return back()->with('notadmin', 'This User have not right for Admin');
        } elseif ($data == "wrongpassword") {
            return back()->with('wrongpassword', 'Password is Incorrect');
        } else {
            if ($data == 'superadmin') {
                Session::put('usertype', 'superadmin');
                Session::put('name', 'superadmin');
                return redirect('/admin/dashboard');
            } else if ($data) {
                if ($data->usertype == 'admin') {
                    Session::put('usertype', 'admin');
                    Session::put('name', $data->name);
                    return redirect('/admin/dashboard');
                }
            }
        }
    }

    public function getuserdetail()
    {
        $userdata = $this->getdata->selectdata('users');
        $adminpage = 'user_details';
        return view('admin.user_details', compact('adminpage', 'userdata'));
    }

    public function adduser(Request $request)
    {
        $this->admin->add_user($request);
        return redirect()->back()->with('AddUserSuccess', 'User added successfully');
    }
    public function deleteuser(Request $request)
    {
        $this->admin->delete_user($request->id);
        return response()->json();
    }

    public function edituser(Request $request)
    {
        $data = $this->getdata->selectdata('users', [['id', $request->id]]);
        return response()->json($data[0]);
    }

    public function updateuser(Request $request)
    {
        $this->data = $this->admin->update_user($request);
        return redirect()->back()->with('UpdateUserSuccessFull', 'Update User SuccessFully');
    }



    public function category_Details()
    {
        $adminpage = 'category_details';
        return view('admin.category_details', compact('adminpage'));
    }

    public function sub_category_details()
    {
        $adminpage = 'sub_category_details';
        $catData = $this->getdata->selectdata('categories');
        return view('admin.sub_category_details', compact('adminpage', 'catData'));
    }

    public function brand_details()
    {
        $adminpage = 'brand_details';
        $subCategory = $this->getdata->selectdata('sub_category');
        return view('admin.brand_details', compact('adminpage', 'subCategory'));
    }


    public function discount_coupon()
    {
        $adminpage = 'discount_coupon';
        return view('admin.discount_coupon', compact('adminpage'));
    }





    public function categorydata()
    {
        $cat_data = $this->getdata->selectdata('categories');

        return DataTables($cat_data)
            ->addIndexColumn()
            ->addColumn('action', function ($raw) {
                return '<div class="dropdown">
                        <a type="button" style="font-size:15px;margin:10px;" id="threeDotMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            &#8942;
                        </a>
                        <div class="dropdown-menu" aria-labelledby="threeDotMenu">
                            <a class="dropdown-item editbtn" id="editbtn" value="' . $raw->id . '" data-id="' . $raw->id . '">Edit</a>
                            <a class="dropdown-item deletebtn" id="deletebtn" value="' . $raw->id . '" data-id="' . $raw->id . '">Delete</a>
                        </div>
                    </div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function addcategory(Request $request)
    {
        $this->admin->add_category($request);
        return back()->with('addcategorysuccess', 'Category Add SuccessFully');
    }

    public function editcategory(Request $request)
    {
        return $this->admin->edit_category($request->id);
    }

    public function updatecategory(Request $request)
    {
        $data = $this->admin->update_category($request);
        return back()->with('UpdateCategorySuccessfully', 'Update Category SuccessFully');
    }

    public function deletecategory(Request $request)
    {
        $this->admin->delete_category($request->id);
        return response()->json();
    }





    public function addsubcategory(Request $request)
    {
        return $this->admin->add_sub_category($request);
    }

    public function getsubcategory(Request $request)
    {
        return sub_category::with('parent_category')->get();
        // return $this->getdata->selectdata('sub_category');
    }

    public function editsubcategory(Request $request)
    {
        return $this->getdata->selectdata('sub_category', [['id', $request->id]])->first();
    }

    public function updatesubcategory(Request $request)
    {
        return $this->admin->updateSubCategory($request);
    }

    public function deletesubcategory(Request $request)
    {
        return $this->getdata->deletedata('sub_category', [['id', $request->id]]);
    }




    public function addbrand(Request $request)
    {
        $this->data = $this->admin->add_brand($request);
        if ($this->data == 1) {
            return back()->with('addBrandSuccessFully', 'Brand Add SuccessFully');
        }
    }

    public function get_brand_data()
    {
        $brandData = $this->getdata->selectdata('brand');
        foreach ($brandData as $key => $value) {
            $subCatId = explode(",", $value->sub_category_id);
            $subCatName = "";
            foreach ($subCatId as $key => $subCatvalue) {
                $subCatName .= DB::table('sub_category')->select('sub_category_name')->where("id", intval($subCatvalue))->value('sub_category_name') . ",";
            }
            $subCatName = substr($subCatName, 0, -1);
            $value->sub_category_id = $subCatName;
        }
        return $brandData;
    }

    public function delete_brand_data(Request $request)
    {
        return $this->admin->delete_brand($request->id);
    }

    public function edit_brand(Request $request)
    {
        $this->data = $this->admin->edit_brand($request->id);
        return $this->data;
    }

    public function update_brand(Request $request)
    {
        $this->data = $this->admin->update_brand($request);
        return $this->data;
    }





    public function product_add()
    {
        $adminpage = 'product_details';
        $cat_data = $this->getdata->selectdata('categories');
        $subCatData = $this->getdata->selectdata('sub_category');
        $brand = $this->getdata->selectdata('brand');
        return view('admin.add_product', compact('adminpage', 'cat_data', 'subCatData', 'brand'));
    }

    public function addproduct(Request $request)
    {
        // dd($request->all());
        // $data = $request->all();
        // $j = 2;


        $error = $this->admin->add_product($request);
        return $error;
    }

    public function getproducts()
    {
        $product_data = $this->admin->get_products();
        return $product_data;
    }

    public function editproduct(Request $request)
    {
        return $this->admin->edit_product($request->id);
    }

    public function edit___product($id)
    {
        $data = $this->getdata->selectdata('products', [['id', $id]])->first();
        $variantData = $this->getdata->selectdata('variant_details', [['product_id', $data->id]]);
        $adminpage = 'product_details';
        $cat_data = $this->getdata->selectdata('categories');
        $subCatData = $this->getdata->selectdata('sub_category');
        $brand = $this->getdata->selectdata('brand');
        return view('admin.edit_product', compact('adminpage', 'cat_data', 'subCatData', 'brand', 'data', 'variantData'));
    }

    public function updateproduct(Request $request)
    {
        // dd($request->all());
        $update = $this->admin->update_product($request);
        return $update;
    }

    public function deleteproduct(Request $request)
    {
        $this->admin->delete_product($request->id);
        return response()->json();
    }

    public function getproductinfo(Request $request)
    {

        return $this->admin->get_productinfo($request->id);
    }

    public function get_sub_category(Request $request)
    {
        return $this->getdata->selectdata('sub_category', [['parent_category_id', $request->catid]]);
    }
    public function get_brand(Request $request)
    {
        return $this->getdata->selectdata('brand');
    }





    public function orderdetails()
    {
        $adminpage = 'order_details';
        return view('admin.order_details', compact('adminpage'));
    }

    public function getorders()
    {
        $this->data =  DB::table('place_order')
            ->join('users', 'users.id', '=', 'place_order.user_id')
            ->select('users.name as user_name', 'place_order.*')
            ->get();
        return $this->data;
    }

    public function updateorderstatus(Request $request)
    {
        return $this->admin->updateorderstatus($request->all());
    }

    public function deleteorder(Request $request)
    {
        return $this->admin->deleteorder($request->all());
    }


    public function adddiscountcoupon(Request $request)
    {
        $discount_coupon = $this->admin->adddiscountcoupon($request);

        if ($discount_coupon == 1) {
            if ($request->discount_counpon_type == "Private") {
                return $this->admin->mailtoluckyuser($request);
            }
            return true;
        }
    }

    public function updatediscountcoupondata(Request $request)
    {
        return $this->admin->updatediscountcoupondata($request);
    }

    public function getdiscountcoupondata(Request $request)
    {
        return $this->admin->getdiscountcoupondata($request);
    }

    public function deletediscountcoupon(Request $request)
    {
        return $this->admin->deletediscountcoupon($request);
    }
}
