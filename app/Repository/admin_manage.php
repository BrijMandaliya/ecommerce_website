<?php

namespace App\Repository;

use GuzzleHttp\Psr7\Request;

interface admin_manage
{
     function admin_login($admin_data);
     function get_users();
     function get_userdata($id);
     function add_user($user_data);
     function delete_user($id);
     function update_user($user_data);

     function get_category();
     function add_category($cat_data);
     function edit_category($id);
     function update_category($cat_data);
     function delete_category($cat_id);

     function add_sub_category($subCatData);
     function updateSubCategory($subCatData);

     function add_brand($brandData);
     function delete_brand($Id);
     function edit_brand($Id);
     function update_brand($brandData);

     function add_product($pro_data);
     function get_products();
     function edit_product($id);
     function update_product($pro_data);
     function delete_product($id);
     function get_productinfo($id);

     function updateorderstatus($order_data);
     function deleteorder($order_data);

     function adddiscountcoupon($coupon_details);
     function getdiscountcoupondata($coupon_details);
     function updatediscountcoupondata($coupon_details);
     function deletediscountcoupon($coupon_details);

     function mailtoluckyuser($discount_data);

     function dashboard();
     function get_top_selling_product();
     function get_top_selling_product_by_price();
}
?>
