<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ApiTester extends Controller
{
    public function getProductData()
    {
        $productData = DB::Select('select p.name,p.shortDescription,p.Description,p.price,p.stock,c.name from products as p Left join categories as c  on c.id = p.category_id ');

        $data = [
            "status" => "200",
            "data" => $productData,
        ];

        return response()->json($data);
    }

    public function addbranddetails(Request $request)
    {
        $validate = Validator::make($request->all(),
        [
            "brand_name" => "required",
            "brand_logo" => "required",
            "sub_category_id" => "required",
        ]);

        if($validate->fails())
        {
            $data = [
                "status"=>"202",
                "data"=>$validate->messages(),
            ];
            return response()->json($data);
        }
        else
        {
            DB::table('brand')
            ->insert(
                [
                    "brand_name" => $request->brand_name,
                    "brand_logo" => $request->brand_logo,
                    "sub_category_id" => $request->sub_category_id,
                ]);

                $data = [
                    "status"=>"200",
                    "data"=>"Data inserted SuccessFully",
                ];

                return response()->json($data);
        }
    }

    public function deletebranddetails(Request $request,$id)
    {
        DB::table('brand')->where('id',$id)->delete();

        $data = [
            "status"=>"200",
            "data"=>"Data Deleted SuccessFully",
        ];

        return response()->json($data);
    }
}
