<?php

namespace App\Services;

use App\Services\DataManipulation;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Repository\user_manage;
use Carbon\Carbon;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Except;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Http\Response;

use Barryvdh\DomPDF\Facade\Pdf;

class user_panel extends DataManipulation implements user_manage
{
    protected $getdata,$data;
    public function __construct()
    {
        $this->getdata = new DataManipulation();
    }

    public function user_login($user_details)
    {
        $userdata = $this->getdata->selectdata('users',[['email', $user_details->logemail]])->first();
        if ($userdata) {
            if (Hash::check($user_details->logpass, $userdata->password)) {
                $user_details->session()->put('user_id', $userdata->id);

                $this->getdata->updatedata('users',[['id',$userdata->id]],["status" => "online","last_login" => Carbon::now()]);

                $user_details->session()->put('user_active_time', Carbon::now());

               return $userdata->name;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function user_register($user_details)
    {
        try {

            $user = $this->getdata->insertdata('users',[
                "name" => $user_details->logname,
                "usertype" => "user",
                "email" => $user_details->logemail,
                "password" => Hash::make($user_details->logpass),
                "status" => "offline",

            ]);

            $userrole = User::query()->whereName($user_details->logname)->with('roles')->first();
            $user_role = Role::whereName('user')->first();
            $add_user_permission = Permission::whereName('View_Product')->first();

            $user_role->permissions()->attach($add_user_permission);

            $userrole->Roles()->attach($user_role);


            return true;

        } catch (Exception $e) {
            dd($e);
        }
    }

    public function getdata()
    {
        return $this->getdata->selectdata('users');
    }

    public function addproducttocart($product_details)
    {

        $pro = $this->getdata->selectdata('addtocart', [
            ['user_id', '=', Session::get('user_id')],
            ['product_name', '=', $product_details['product_name']],
            ['product_measurement', '=', $product_details['product_measurement']],
            ['product_measurement_value', '=', $product_details['product_measurement_value']],
            ['product_color', '=', $product_details['product_color']],
        ]);

        if ($pro->count() <= 0) {
            $product = $this->getdata->insertdata('addtocart',[
                "product_id" => $product_details['product_id'],
                "product_name" => $product_details['product_name'],
                "product_measurement" => $product_details['product_measurement'],
                "product_measurement_value" => $product_details['product_measurement_value'],
                "product_color" => $product_details['product_color'],
                "product_quantity" => $product_details['product_quantity'],
                "product_image" => $product_details['product_image'],
                "product_price" => $product_details['product_price'],
                "category_id" => $product_details['category_id'],
                "user_id" => Session::get('user_id'),
            ]);
            return $product;

        } else {
            $quantity = intval($pro->first()->product_quantity);
            $price = intval($pro->first()->product_price);
            $quantity += 1;
            $price *= $quantity;


            $product = $this->getdata->updatedata('addtocart', [['id', $pro->first()->id]],
            [
                "product_quantity" => $quantity,
                "product_price" => $price,
            ]);

            return $product;
        }
    }

    public function delete_product_from_cart($product_details)
    {
        $deleteproduct_fromcart = DB::table('addtocart')->where('id', $product_details->id)->delete();
        if ($deleteproduct_fromcart == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateproductprice($product_detail)
    {
        try {
            $updateprice = $this->getdata->updatedata('addtocart', [['id', $product_detail->productid]], [
                "product_quantity" => $product_detail->product_quantity,
            ]);

            return $updateprice;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function addtowishlist($product_data)
    {
        // $checkwishlist = DB::table('wishlist')->where([
        //     ['product_id', '=', $product_data->productid],
        //     ['user_id', '=', $product_data->userid]
        // ])->get();

        $checkwishlist = $this->getdata->selectdata('wishlist', [
            ['product_id', '=', $product_data->productid],
            ['user_id', '=', $product_data->userid]
        ]);

        if (count($checkwishlist) > 0) {
            return "already in Wishlist";
        } else {
            // $addtowishlist = DB::table('wishlist')
            //     ->insert([
            //         "product_id" => $product_data->productid,
            //         "user_id" => $product_data->userid,
            //         "created_at" => Carbon::now(),
            //     ]);

            $addtowishlist = $this->getdata->insertdata('wishlist', [
                "product_id" => $product_data->productid,
                "user_id" => $product_data->userid,
                "created_at" => Carbon::now(),
            ]);

            if ($addtowishlist == 1) {
                return true;
            } else {
                return false;
            }
        }
    }


    public function delete_product_from_wishlist($wishlistdata)
    {
        try {
            $deleteproduct_fromwishlist = DB::table('wishlist')->where('id', $wishlistdata->id)->delete();
            if ($deleteproduct_fromwishlist == 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    public function checkdiscountcode($coupon)
    {
        try {
            $data = $this->getdata->selectdata('discount_coupon', [["discount_code", $coupon]]);

            if (count($data) > 0) {
                $difference = Carbon::now()->diff($data->first()->discount_active_time);

                if ($difference->invert == 1) {
                    return "Coupon Has Expiry";
                } else {

                    if ($data->first()->discount_code_type == "Private") {
                        $valid_user = false;
                        $array = explode(",", $data->first()->lucky_users_id);
                        array_pop($array);
                        foreach ($array as $key => $value) {
                            if ($value == Session::get("user_id")) {
                                $valid_user = true;
                            }
                        }

                        if ($valid_user == true) {
                            $order_data = $this->getdata->selectdata('place_order', [['discount_coupon_id', $data->first()->id]]);

                            if (count($order_data) < 1) {
                                return $data;
                            } else {
                                return "Coupon Has Already Used";
                            }
                        } else {
                            return "This Coupun is not Applicable For You";
                        }
                    } else {
                        $order_data = $this->getdata->selectdata('place_order', [
                            ['discount_coupon_id', $data->first()->id],
                            ['user_id', Session::get("user_id")]
                        ]);

                        if (count($order_data) < 1) {
                            return $data;
                        } else {
                            return "Coupon Has Already Used";
                        }
                    }
                }
            } else {
                return "Invalid Coupon";
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    public function checkout_page()
    {
        $userId = Session::get('user_id');
        $orders = $this->getdata->selectdata('place_order',[['user_id',$userId]])->first();
        $proData = $this->getdata->selectdata('addtocart',[['user_id',$userId]]);
        $userPanelPage = "checkout";
        $this->data = ["pro_data"=>$proData,"user_panel_page"=>$userPanelPage,"orders"=>$orders];
        return $this->data;
    }

    public function wishlist_page()
    {
        $proData = DB::select('select w.id as wishlist_id,w.product_id,w.user_id,p.* from wishlist as w INNER JOIN products as p ON w.product_id = p.id');
        $userPanelPage = 'wishlist';
        $this->data = ["user_panel_page"=>$userPanelPage,"pro_data"=>$proData];
        return $this->data;
    }

    public function addtocart_page()
    {
        $userId = Session::get('user_id');
        $proData = $this->getdata->selectdata('addtocart',[['user_id', $userId]]);
        $userPanelPage = 'addtocart';
        $this->data = ["pro_data"=>$proData,"user_panel_page"=>$userPanelPage];
        return $this->data;
    }

    public function productdetail_page($id){

        $proData = $this->getdata->selectdata('products',[['id',$id]])->first();
        $catData = $this->getdata->selectdata('categories',[['id', $proData->category_id]])->first();
        $userPanelPage = "productdetail";
        $variantData = DB::select('SELECT variant_name,GROUP_CONCAT(variant_value) AS variant_value,GROUP_CONCAT(variant_colour) AS colours,GROUP_CONCAT(variant_stock) AS stocks, SUM(variant_stock) AS sumstocks, GROUP_CONCAT(variant_price) AS prices,MIN(variant_price) as min_price
        FROM variant_details
        where product_id='.$id.'
        GROUP BY variant_name');

        $this->data = ["pro_data"=>$proData,"cat_data"=>$catData,"user_panel_page"=>$userPanelPage,"variantData"=>$variantData];
        return $this->data;
    }

    public function homepage()
    {
        $discountData = DB::table('discount_coupon')
        ->join('categories', 'discount_coupon.discount_on_category', '=', 'categories.id')
        ->select('discount_coupon.*','categories.name as c_name')
        ->get();

        $proData = $this->getdata->selectdata('products');
        $userPanelPage = "homepage";
        $products = $proData->first();
        $catData = DB::select(
        '
        SELECT
            COUNT(p.category_id) AS count,
            c.id,
            c.name,
            c.c_image
        FROM
            (SELECT * FROM categories) AS c
        RIGHT JOIN
            (SELECT * FROM products) AS p
        ON
            c.id = p.category_id
        GROUP BY
            p.category_id
        ORDER BY
            p.category_id'
        );
        $this->data = ["cat_data"=>$catData,"pro_data"=>$proData,"user_panel_page"=>$userPanelPage,"discount_data"=>$discountData];
        return $this->data;
    }

    public function display_products($id){
        $catData = $this->getdata->selectdata('categories');
        if ($id != 0) {
            $proData = $this->getdata->selectdata('products',[['category_id', $id]]);
        } else {
            $proData = $this->getdata->selectdata('products');
        }
        $brandData = $this->getdata->selectdata('brand');
        $userPanelPage = "shop";

        $this->data = ["pro_data"=>$proData,"user_panel_page"=>$userPanelPage,"cat_data"=>$catData,"brandData"=>$brandData];
        return $this->data;
    }

    public function place_order($order_details)
    {
        $user_id = $order_details->product_detail[0]['user_id'];
        $placeorder_detail = $order_details->placeorder;
        $productdetail = $order_details->product_detail;
        $discount_data = $order_details->discountdata;
        $shippingaddress = "same as billing address";
        $billingaddress = $placeorder_detail['old_billing_address'] !=null ? $placeorder_detail['old_billing_address'] : " ";

        if ($placeorder_detail['shiptodiffadddress'] == "true") {
            $shippingaddress = $placeorder_detail['shipFirstName'] . " " . $placeorder_detail['shipLastName'] . "/n" . $placeorder_detail['shipEmail'] . "/n" . $placeorder_detail['shipPhoneNumber'] . "/n" . $placeorder_detail['shipAddressLine1'] . ",/n" . $placeorder_detail['shipAddressLine2'] . ",/n" . $placeorder_detail['shipCity'] . ", " . $placeorder_detail['shipState'] . ", " . $placeorder_detail['shipcountry'] . ", " . $placeorder_detail['shipZIPCode'];
        }
        if ($placeorder_detail['billingtodiffaddress'] == "true") {
            $billingaddress = $placeorder_detail['firstName'] . " " . $placeorder_detail['lastName'] . "/n" . $placeorder_detail['email'] . "/n" . $placeorder_detail['phoneNumber'] . "/n" . $placeorder_detail['addressLine1'] . "/n" . $placeorder_detail['addressLine2'] . "/n" . $placeorder_detail['city'] . ", " . $placeorder_detail['state'] . ", " . $placeorder_detail['country'] . ", " . $placeorder_detail['zipCode'];
        }

        $date = new \DateTime();
        $order_place_date = new \DateTime();
        $expected_delivery_date = $date->modify('+5 day')->format('Y-m-d');
        $randomNumber = rand(100000, 999999);
        $invoiceno = '#' . $randomNumber;

        foreach ($productdetail as $key => $product) {

            $final_product_price = $product['product_price'];
            $discount_id = 0;
            if ($discount_data['discountapply_on_category'] != null) {

                if ($discount_data['discountapply_on_category'] == $product['category_id']) {

                    $discount_price = (intval($final_product_price) * intval($discount_data['discountrate'])) / 100;
                    $final_product_price -= $discount_price;
                    $discount_id = $discount_data['discount_id'];
                }
            }

            $data = [
                "user_id" => $user_id,
                "product_id" => $product['product_id'],
                "product_name" => $product['product_name'],
                "product_quantity" => $product['product_quantity'],
                "product_price" => $final_product_price,
                "product_measurement" => $product['product_measurement'],
                "product_measurement_value" => $product['product_measurement_value'],
                "product_color" => $product['product_color'],
                "product_image" => $product['product_image'],
                "billingaddress" => $billingaddress,
                "shippingaddress" => $shippingaddress,
                "expected_delivery_date" => $expected_delivery_date,
                "invoice_no" => $invoiceno,
                "discount_coupon_id" => $discount_id == 0 ? null : $discount_id,
                "order_status" => "Preparing Order",
                "order_placed_date" => $order_place_date->format('Y-m-d'),
            ];
            $place_order = $this->getdata->insertdata('place_order',$data);
            if ($place_order == 1) {

                $this->getdata->deletedata('addtocart',[['id', $product['id']]]);

                $stockupdate = DB::table('variant_details')
                    ->where([
                        ['variant_value',$product['product_measurement_value']],
                        ['variant_colour',$product['product_color']],
                        ['product_id',$product['product_id']]
                    ])
                    ->decrement('variant_stock', $product['product_quantity']);
            }
            else
            {
                return $place_order;
            }
        }

        if ($stockupdate == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function cancel_order($invoice_no)
    {
        return $this->getdata->deletedata('place_order',[['invoice_no',$invoice_no]]);
    }

    public function order_page_details()
    {
        $orderDetail = $this->getdata->selectdata('place_order',[['user_id', Session::get('user_id')]]);
        $userPanelPage = "order";
        $this->data = ["user_panel_page" => $userPanelPage , "order_detail" => $orderDetail];
        return $this->data;
    }


    public function downloadinvoice($invoiceno)
    {
        $orders = $this->getdata->selectdata('place_order',[['invoice_no', '#' . $invoiceno]]);
        $downloadbtn = false;
        $pdf = Pdf::loadView('pdf', ['orders' => $orders, 'downloadbtn' => $downloadbtn]);
        return $pdf->download('invoice.pdf');
    }

    public function printinvoice($invoiceno)
    {
        $orders = $this->getdata->selectdata('place_order',[['invoice_no', '#' . $invoiceno]]);
        $downloadbtn = false;
        $pdf = Pdf::loadView('pdf', ['orders' => $orders, 'downloadbtn' => $downloadbtn]);
        return $pdf->stream('invoice.pdf');


    }

    public function displayinvoice($invoiceno)
    {
        if (Session::has('user_id')) {
            $orders = $this->getdata->selectdata('place_order',[['invoice_no', '#' . $invoiceno]]);
            $downloadbtn = true;
            return view('pdf', compact('orders', 'downloadbtn'));
        } else {
            return redirect('/login');
        }
    }
}
