<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\category;
use App\Models\Product;
use App\Services\DataManipulation;
use Illuminate\Http\Request;
use App\Services\user_panel;
use Hamcrest\Type\IsString;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;
use function PHPUnit\Framework\isJson;

use Barryvdh\DomPDF\Facade;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class user_manager extends Controller
{

    public function errors($errorstatus, $errormessage)
    {
        return view('errors.minimal', ['error_message' => $errormessage, 'error_code' => $errorstatus]);
    }

    protected $user, $getdata, $data;
    public function __construct(user_panel $user, DataManipulation $getdata)
    {
        $this->user = $user;
        $this->getdata = $getdata;
    }

    public function login(Request $request)
    {
        $this->data =  $this->user->user_login($request);
        if (is_string($this->data)) {
            $request->session()->put('userlogin', $this->data);
            return redirect('/homepage');
        } else {
            return back()->with('wrongcredentials', 'Invalid Email or password');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'logname' => 'required|string|regex:/^[^\d]+$/',
            'logemail' => 'required|max:255|email',
            'logpass' => 'required|min:6',
        ]);

        $this->data = $this->user->user_register($request);
        if ($this->data == 1) {
            redirect('/login');
        } else {
            return $this->data;
        }
    }


    public function homepage()
    {
        $this->data =  $this->user->homepage();
        return view('User.homepage',$this->data);
    }

    public function displayproducts($id)
    {
        $this->data = $this->user->display_products($id);
        return view('User.displayallproduct', $this->data);
    }

    public function productdetail($id)
    {
        $this->data = $this->user->productdetail_page($id);
        return view('User.productdetail', $this->data);
    }

    public function addtocart()
    {
        $this->data  = $this->user->addtocart_page();
        return view('User.addtocart', $this->data);;
    }

    public function wishlist()
    {
        $this->data = $this->user->wishlist_page();
        return view('User.wishlist',$this->data);
    }

    public function addproducttocart(Request $request)
    {
        $this->data = $this->user->addproducttocart($request->all());
        return $this->data;
    }

    public function updateproductprice(Request $request)
    {
        $this->data = $this->user->updateproductprice($request);
        return $this->data;
    }

    public function addtowishlist(Request $request)
    {
        $this->data = $this->user->addtowishlist($request);
        return $this->data;
    }



    public function deleteproductfromcart(Request $request)
    {
        $this->data = $this->user->delete_product_from_cart($request);
        return $this->data;
    }

    public function deleteproductfromwishlist(Request $request)
    {
        $this->data = $this->user->delete_product_from_wishlist($request);
        return $this->data;
    }

    public function checkout()
    {
        $this->data = $this->user->checkout_page();
        return view('User.checkout', $this->data);
    }

    public function billingcheckoutcheckout(Request $request)
    {
        $this->data = $request->all();
        return $this->data;
    }

    public function placeorder(Request $request)
    {
        $this->data = $this->user->place_order($request);
        return $this->data;
    }

    public function cancelorder(Request $request)
    {
        $this->data = $this->user->cancel_order($request->invoiceno);
        return $this->data;
    }

    public function order()
    {
        $this->data = $this->user->order_page_details();
        return view('User.order', $this->data);;
    }


    public function displayinvoice($invoiceno)
    {
        $this->data = $this->user->displayinvoice($invoiceno);
        return $this->data;
    }

    public function downloadinvoice($invoiceno)
    {
        $this->data = $this->user->downloadinvoice($invoiceno);
        return $this->data;
    }

    public function printinvoice($invoiceno)
    {
        $this->data = $this->user->printinvoice($invoiceno);
        return $this->data;
    }

    public function checkdiscountcode(Request $request)
    {
        $this->data = $this->user->checkdiscountcode($request->coupon);
        return $this->data;
    }
}
