<?php

namespace App\Repository;



interface user_manage
{
     function user_login($user_details);
     function user_register($user_details);
     function getdata();
     function addproducttocart($product_details);
     function updateproductprice($product_detail);
     function delete_product_from_cart($product_details);

    function addtowishlist($product_data);
    function delete_product_from_wishlist($wishlistdata);

    function checkdiscountcode($coupon);

    function checkout_page();
    function wishlist_page();
    function addtocart_page();
    function productdetail_page($id);
    function homepage();



    function display_products($id);

    function place_order($order_details);
    function cancel_order($invoice_no);
    function order_page_details();

    function downloadinvoice($invoiceno);
    function printinvoice($invoiceno);
    function displayinvoice($invoiceno);
}
?>
