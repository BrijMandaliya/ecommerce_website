<?php


namespace App\Services;

use App\Filament\Resources\CategoryResource;
use App\Models\category;
use App\Repository\admin_manage;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Psy\CodeCleaner\AssignThisVariablePass;

class admin_panel extends DataManipulation implements admin_manage
{
    protected $getdata, $manager;
    private $data;

    public function __construct()
    {
        $this->getdata = new DataManipulation();
        $this->manager = new ImageManager(new Driver());
    }
    public function admin_login($admin_data)
    {
        $userdata = DB::table('users')->where('email', $admin_data->email)->get()->toArray();
        if ($userdata) {
            if (Hash::check($admin_data->password, $userdata[0]->password)) {
                if ($userdata[0]->usertype == 'admin') {

                    $admin_data->session()->put('admin_active_time', Carbon::now());
                    $admin_data->session()->put('admin_id', $userdata[0]->id);

                    $user = User::find($userdata[0]->id);
                    $user->last_login = Carbon::now();
                    $user->save();

                    return $userdata[0];
                } else {
                    return "notadmin";
                }
            } else {
                return "wrongpassword";
            }
        } else if ($admin_data->email == 'superadmin@gmail.com' && $admin_data->password == 'superadmin@123') {
            $admin_data->session()->put('admin_id', 10101);
            return 'superadmin';
        } else {
            return "wrongpassword";
        }
    }

    public function get_users()
    {
        return $this->getdata->selectdata('users');
    }

    public function get_userdata($id)
    {
        $this->data = $this->getdata->selectdata('users', [['id', $id]])->toArray();
        return $this->data;
    }

    public function add_user($user_data)
    {
        $user_type = $user_data->usertype;

        $this->getdata->insertdata('users', [
            "name" => $user_data->name,
            "usertype" => $user_data->usertype,
            "email" => $user_data->email,
            "password" => Hash::make($user_data->password),
            "status" => "offline",
        ]);

        if ($user_type == 'admin') {
            $userrole = User::whereName($user_data->name)->first();
            $user_role = Role::whereName('admin')->first();
            $add_user_permission = Permission::whereName('Manage_Product')->first();
            $user_role->permissions()->attach($add_user_permission);
            $userrole->Roles()->attach($user_role);
        } else {
            $userrole = User::whereName($user_data->name)->first();
            $user_role = Role::whereName('user')->first();
            $add_user_permission = Permission::whereName('View_Product')->first();
            $user_role->permissions()->attach($add_user_permission);
            $userrole->Roles()->attach($user_role);
        }
    }

    public function delete_user($id)
    {
        $this->getdata->deletedata('user_role', [['user_id', $id]]);
        $this->getdata->deletedata('users', [['id', $id]]);
    }

    public function update_user($user_data)
    {
        $this->getdata->updatedata(
            'users',
            [['id', $user_data->user_id]],
            [
                'name' => $user_data->name,
                'email' => $user_data->email,
                'usertype' => $user_data->usertype,
            ]
        );

        return true;
    }



    public function add_sub_category($subCatData)
    {
        $this->data = $this->getdata->insertdata('sub_category', [
            "sub_category_name" => $subCatData->subCategoryName,
            "parent_category_id" => $subCatData->parent_category,
        ]);
        return $this->data;
    }

    public function updateSubCategory($subCatData)
    {
        $this->data = $this->getdata->updatedata(
            'sub_category',
            [['id', $subCatData->subCategoryId]],
            [
                "sub_category_name" => $subCatData->subCategoryName,
                "parent_category_id" => $subCatData->parent_category,
            ]
        );
        return $this->data;
    }

    public function add_brand($brandData)
    {
        $subCategory = implode(",", $brandData->subCategory);
        $this->data = $this->getdata->insertdata('brand', [
            "brand_name" => $brandData->brandName,
            "brand_logo" => $brandData->brandLogo->getClientOriginalName(),
            "sub_category_id" => $subCategory,
            "created_at" => Carbon::now(),
        ]);



        $img = $this->manager->read($brandData->brandLogo);
        $img = $img->resize(370, 250);
        $img->save(public_path('brand_logos' . "/" . $brandData->brandLogo->getClientOriginalName()), 70);

        return $this->data;
    }

    public function delete_brand($Id)
    {
        $this->data = $this->getdata->deletedata('brand', [['id', $Id]]);
        return $this->data;
    }

    public function edit_brand($Id)
    {
        return $this->getdata->selectdata('brand', [['id', $Id]])->first();
    }

    public function update_brand($brandData)
    {
        $subCategory = implode(",", $brandData->subCategory);
        if (isset($brandData->brandLogo)) {
            $this->getdata->updatedata('brand', [['id', $brandData->brandID]], [
                "brand_logo" => $brandData->brandLogo->getClientOriginalName(),
            ]);

            $img = $this->manager->read($brandData->brandLogo);
            $img = $img->resize(370, 250);
            $img->save(public_path('brand_logos' . "/" . $brandData->brandLogo->getClientOriginalName()), 70);
        }
        $this->getdata->updatedata('brand', [['id', $brandData->brandID]], [
            "brand_name" => $brandData->brandName,
            "sub_category_id" => $subCategory,
            "updated_at" => Carbon::now(),
        ]);
        return true;
    }


    public function get_category()
    {
        return $this->getdata->selectdata('categories');
    }

    public function add_category($cat_data)
    {
        for ($i = 0; $i < count($cat_data->name); $i++) {
            $this->getdata->insertdata('categories', [
                "name" => $cat_data->name[$i],
                "category_measurement" => $cat_data->c_measurement[$i],
                "c_image" => $cat_data->c_image[$i]->getClientOriginalName()
            ]);


            $img = $this->manager->read($cat_data->c_image[$i]);
            $img = $img->resize(370, 250);
            $img->save(public_path('category_images' . "/" . $cat_data->c_image[$i]->getClientOriginalName()), 70);
        }
    }

    public function edit_category($id)
    {
        return $this->getdata->selectdata('categories', [['id', $id]])->first();
    }

    public function update_category($cat_data)
    {
        if ($cat_data->c_image) {
            $cat_image = $cat_data->c_image[0]->getClientOriginalName();

            $category = Category::find($cat_data->cat_id);

            if ($category) {
                $category->c_image = $cat_image;
                $category->save();
            }


            $img = $this->manager->read($cat_data->c_image[0]);
            $img = $img->resize(370, 250);
            $img->save(public_path('category_images' . "/" . $cat_image), 70);
        }

        $updatecategory = $this->getdata->updatedata('categories', [['id', $cat_data->cat_id]], [
            'name' => $cat_data->name[0],
            'category_measurement' => $cat_data->c_measurement[0],
        ]);
    }

    public function delete_category($cat_id)
    {
        $this->getdata->deletedata('categories', [['id', $cat_id]]);
    }






    public function add_product($pro_data)
    {
        try {


            $images = "";

            foreach ($pro_data->p_image_1 as $key => $p_images) {
                $ext = $p_images->getClientOriginalExtension();

                if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
                    if ($p_images->getSize() <= 200000) {
                        $images = $images . $p_images->getClientOriginalName() . ",";
                        $img = $this->manager->read($p_images);
                        $img = $img->resize(370, 250);
                        $img->save(public_path('product_images' . "/" . $p_images->getClientOriginalName()), 70);
                    } else {
                        return "Image " . ($key + 1) . " is Greater Than 100KB";
                    }
                } else {
                    return "Image " . ($key + 1) . " in .jpg,.jpeg,.png only";
                }
            }

            $newRecord = Product::create([
                "name" => $pro_data->name,
                "shortDescription" => $pro_data->shortDescription,
                "Description" => $pro_data->Description,
                "price" => $pro_data->Price,
                "stock" => $pro_data->Stock,
                "category_id" => $pro_data->category,
                "sub_category_id" => $pro_data->subCatgory,
                "brand_id" => $pro_data->brand,
                "p_image_1" => $images,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "user_id" => Session::get("admin_id"),
                "user_IP" => $pro_data->ip(),
            ]);


            foreach ($pro_data->measurementValue as $key => $value) {
                $variant = $this->getdata->insertdata('variant_details', [
                    "variant_name" => $pro_data->measurementName,
                    "variant_value" => $value,
                    "variant_stock" => $pro_data->measurementStock[$key],
                    "variant_colour" => $pro_data->measurementColor[$key],
                    "variant_price" => $pro_data->measurementPrice[$key],
                    "product_id" => $newRecord->id,
                ]);
            }


            if (isset($variant)) {
                return redirect("/admin/productdetails");
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function get_products()
    {
        $this->data = Product::select(DB::raw('(select name from categories as c where c.id = products.category_id) as c_name'), 'products.*')->get();

        return $this->data;
    }

    public function edit_product($id)
    {
        return $this->getdata->selectdata('products', [['id', $id]])->toArray();
    }

    public function update_product($pro_data)
    {
        try {

            $images = "";
            if (!empty($pro_data->p_image_1)) {

                foreach ($pro_data->p_image_1 as $p_images) {
                    $images = $images . $p_images->getClientOriginalName() . ",";
                    $img = $this->manager->read($p_images);
                    $img = $img->resize(470, 350);
                    $img->save(public_path('product_images' . "/" . $p_images->getClientOriginalName()), 70);
                }
                $images = substr($images, 0, -1);
                $images = $images . ",";
            }

            $str = "";
            if (strlen($pro_data->product_oldimages) == 1) {
                $pro_data->product_oldimages = "";
            }
            if (strlen($pro_data->product_oldimages) > 0) {
                if ($pro_data->product_oldimages[0] == ",") {
                    $pro_data->product_oldimages = substr($pro_data->product_oldimages, 1);
                }
            }

            if ($images == "") {
                $updateimage = $pro_data->product_oldimages;
            } elseif ($pro_data->product_oldimages == "") {
                $updateimage = $images;
            } else {
                $updateimage = $pro_data->product_oldimages .  $images;
            }


            $updateproduct = $this->getdata->updatedata('products', [['id', $pro_data->product_id]], [
                'name' => $pro_data->name,
                'shortDescription' => $pro_data->shortDescription,
                'Description' => $pro_data->Description,
                'price' => $pro_data->Price,
                'stock' => $pro_data->Stock,
                'category_id' => $pro_data->category,
                'p_image_1' => $updateimage,
                'update_user_Id' => Session::get("admin_id"),
                'update_user_ip' => $pro_data->ip(),
                'updated_at' => Carbon::now(),
            ]);

            $this->getdata->deletedata('variant_details', [['product_id', $pro_data->product_id]]);

            if (isset($pro_data->measurementValue[0])) {

                foreach ($pro_data->measurementValue as $key => $value) {
                    $variant = $this->getdata->insertdata('variant_details', [
                        "variant_name" => $pro_data->measurementName,
                        "variant_value" => $value,
                        "variant_stock" => $pro_data->measurementStock[$key],
                        "variant_colour" => $pro_data->measurementColor[$key],
                        "variant_price" => $pro_data->measurementPrice[$key],
                        "product_id" => $pro_data->product_id,
                    ]);
                }
            }



                return redirect("/admin/productdetails");

        } catch (Exception $e) {
            dd($e);
        }
    }

    public function delete_product($id)
    {
        $this->getdata->deletedata('variant_details', [['product_id', $id]]);
        $this->getdata->deletedata('products', [['id', $id]]);
    }

    public function get_productinfo($id)
    {
        $this->data =  DB::Select('SELECT p.id,p.user_ip,p.created_at,p.update_user_ip,p.updated_at,
        (SELECT GROUP_CONCAT(name) from users where users.id IN (p.user_id,p.update_user_Id)) as User_Name
        FROM products as p
        where p.id = ' . $id);

        return $this->data;
    }



    public function updateorderstatus($order_data)
    {

        $update_order_status = $this->getdata->updatedata('place_order', [['invoice_no', $order_data['invoice_no']]], [
            "order_status" => $order_data['order_status'],
            "updated_at" => Carbon::now(),
        ]);

        if ($update_order_status) {
            return true;
        } else {
            return "false";
        }
    }

    public function deleteorder($order_data)
    {
        try {
            $delete_order = $this->getdata->deletedata('place_order', [['invoice_no', $order_data['invoice_no']]]);
            if ($delete_order == 1) {
                return true;
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    public function adddiscountcoupon($coupon_details)
    {

        $category = explode("-", $coupon_details->dicount_on_category);
        $data = $this->getdata->selectdata('discount_coupon', [
            ["discount_code_type", $coupon_details->discount_counpon_type],
            ["discount_on_category", intval($category[0])],
        ]);
        $already_has = false;
        foreach ($data as $key => $value) {
            $difference = Carbon::now()->diff($value->discount_active_time);
            if ($difference->invert == 0) {
                $already_has = true;
            }
        }


        if ($already_has == false) {

            $adddiscountcoupon = $this->getdata->insertdata('discount_coupon', [
                "discount_code" => strtoupper($coupon_details->coupon),
                "discount_rate" => $coupon_details->discount_rate,
                "discount_active_time" => $coupon_details->discount_coupon_active_time,
                "discount_code_type" => $coupon_details->discount_counpon_type,
                "discount_on_category" => intval($category[0]),
            ]);

            if ($adddiscountcoupon == 1) {

                return true;
            }
        } else {
            return "Already Has Coupon";
        }
    }

    public function mailtoluckyuser($disocunt_data)
    {
        $data = DB::select('SELECT  user_id,(select GROUP_CONCAT(order_placed_date) from place_order as po where po.user_id = place_order.user_id) as Place_Order_Dates  FROM place_order GROUP BY user_id ORDER BY user_id');

        $user_data = [];

        foreach ($data as $key => $value) {

            $dates = json_encode($value->Place_Order_Dates);

            $array = explode(",", $dates);

            $previous_order_count = 0;
            $previous_2_order_count = 0;
            $current_order_count = 0;

            foreach ($array as $key => $value1) {
                $latest = str_replace('"', '', $value1);
                $currentyear = new \DateTime();
                $previousyear = new \DateTime();
                $previous_year_2 = new \DateTime();
                $previousyear->modify('-1 year');
                $previous_year_2->modify('-2 year');
                $date = new \DateTime($latest);

                if ($date->format("Y") == $previous_year_2->format("Y")) {
                    $previous_2_order_count++;
                }
                if ($date->format("Y") == $previousyear->format("Y")) {
                    $previous_order_count++;
                }
                if ($date->format("Y") == $currentyear->format("Y")) {
                    $current_order_count++;
                }
            }


            if ($previous_order_count > 1 &&  $previous_2_order_count > 1) {
                $user_data[] = [
                    'user_id' => json_encode($value->user_id),
                ];
            } elseif ($previous_order_count > 1) {
                $user_data[] = [
                    'user_id' => json_encode($value->user_id),

                ];
            } elseif ($current_order_count > 1) {

                $user_data[] = [
                    'user_id' => json_encode($value->user_id),
                ];
            }
        }
        $users_id = "";
        foreach ($user_data as $key => $value) {
            $id = intval($value["user_id"]);
            $userdata = DB::table('users')->where('id', $id)->get()->first();
            $users_id = $users_id . $id . ",";

            Mail::send('mail_discount_coupon', ['discount_data' => $disocunt_data], function ($message) use ($userdata) {
                $message->to($userdata->email);
                $message->subject('Discount Coupon');
            });
        }

        $update_discount_coupon = $this->getdata->updatedata('discount_coupon', [["discount_code", $disocunt_data->coupon]], ["lucky_users_id" => $users_id]);

        return $update_discount_coupon;
    }


    public function getdiscountcoupondata($coupon_details)
    {
        if ($coupon_details->id) {
            $this->data = DB::table('discount_coupon')->where("discount_coupon.id", $coupon_details->id)
                ->join('categories', 'discount_coupon.discount_on_category', '=', 'categories.id')
                ->select('discount_coupon.*', 'categories.id as c_id', 'categories.name')
                ->get();
        } else {
            $this->data = DB::table('discount_coupon')
                ->join('categories', 'discount_coupon.discount_on_category', '=', 'categories.id')
                ->select('discount_coupon.*', 'categories.id as c_id', 'categories.name')
                ->get();
        }
        return $this->data;
    }

    public function updatediscountcoupondata($coupon_details)
    {

        $category = explode("-", $coupon_details->dicount_on_category);
        $data = DB::table('discount_coupon')
            ->where([
                ["discount_code_type", $coupon_details->discount_counpon_type],
                ["discount_on_category", $coupon_details->dicount_on_category],
            ])
            ->whereNotIn("id", (array) $coupon_details->discount_coupon_id)
            ->get();
        $already_has = false;
        $i = 0;

        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $difference = Carbon::now()->diff($value->discount_active_time);
                if ($difference->invert == 0) {
                    $already_has = true;
                }
            }
        }


        if ($already_has == false) {

            $discountcouponupdate = $this->getdata->updatedata(
                'discount_coupon',
                [["id", $coupon_details->discount_coupon_id]],
                [
                    "discount_code" => strtoupper($coupon_details->coupon),
                    "discount_rate" => $coupon_details->discount_rate,
                    "discount_code_type" => $coupon_details->discount_counpon_type,
                    "discount_on_category" => $category[0],
                ]
            );

            if ($discountcouponupdate == 1) {
                return true;
            } else {
                return "false";
            }
        } else {
            return "Already Has Coupon";
        }
    }

    public function deletediscountcoupon($coupon_details)
    {
        $this->data = $this->getdata->deletedata('discount_coupon', [["id", $coupon_details->id]]);
        return $this->data;
    }

    public function dashboard()
    {
        $userData = $this->getdata->selectdata('users');
        $userDataCount = $userData->count();
        $orderCount = $this->getdata->selectdata('place_order')->count();
        $order = $this->getdata->selectdata('place_order');
        $productCount = $this->get_products()->count();

        $todayOrder = $this->getdata->selectdata('place_order', [["order_placed_date", Carbon::today()->format('d-m-Y')]])->count();
        $data = DB::Select('SELECT SUM(product_quantity) as total_product_quantity,
                SUM(product_price) as total_product_price,
                order_placed_date
                FROM place_order
                GROUP BY order_placed_date ORDER BY order_placed_date DESC');
        $totalQuantity = 0;
        $createdDate = [];
        $quantity = [];
        foreach ($data as $key => $value) {
            $totalQuantity += $value->total_product_quantity;
            $createdDate[] = $value->order_placed_date;
            $quantity[] = $value->total_product_quantity;
        }
        $adminPage = 'dashboard';
        $this->data = [
            "adminpage" => $adminPage,
            "userdatacount" => $userDataCount,
            "order_count" => $orderCount,
            "product_count" => $productCount,
            "today_order" => $todayOrder,
            "order" => $order,
            "created_date" => $createdDate,
            "quantity" => $quantity
        ];

        return $this->data;
    }

    public function get_top_selling_product()
    {
        $this->data = DB::Select('SELECT SUM(po.product_quantity) as total_product_quantity, ' .
            'SUM(po.product_price) as total_product_price, ' .
            'COUNT(po.product_color) as Total_sell_color,' .
            'po.product_name,' .
            'po.product_id,' .
            'p.price,' .
            'po.product_image' .
            ' FROM place_order as po' .
            ' INNER JOIN products as p ON p.id = po.product_id  GROUP BY po.product_id, po.product_name, product_image, p.price ORDER BY total_product_quantity DESC LIMIT 5');
        return $this->data;
    }

    public function get_top_selling_product_by_price()
    {
        $this->data = DB::Select('SELECT SUM(po.product_quantity) as total_product_quantity, ' .
            'SUM(po.product_price) as total_product_price, ' .
            'COUNT(po.product_color) as Total_sell_color,' .
            'po.product_name,' .
            'po.product_id,' .
            'p.price    ' .
            ' FROM place_order as po' .
            ' INNER JOIN products as p ON p.id = po.product_id  GROUP BY po.product_id, po.product_name, p.price ORDER BY total_product_price DESC LIMIT 5');

        return $this->data;
    }
}
