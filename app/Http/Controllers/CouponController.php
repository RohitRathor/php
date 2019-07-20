<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupons;
use DB;

class CouponController extends Controller
{
    public function couponData(Request $req){

    	$coupon_code=$req->input('coupon_code');
 		$valid_from=$req->input('valid_from');
        $valid_till=$req->input('valid_till');
        $discount_type=$req->input('discount_type');
        $discount_amount=$req->input('discount_amount');
        $minimum_amount=$req->input('minimum_amount');
        $maximum_discount=$req->input('maximum_discount');
        $category_id=$req->input('category_id');
        $brand_id=$req->input('brand_id');
        $product_id=$req->input('product_id');
        $is_active=$req->input('is_active');
        $is_approved=$req->input('is_approved');
        $country_id=$req->input('country_id');
        $airport_id=$req->input('airport_id');
        $created_by=$req->input('created_by');
        $updated_by=$req->input('updated_by');
        $deleted_by=$req->input('deleted_by');
        $created_at=$req->input('created_at');
        $updated_at=$req->input('updated_at');
        $deleted_at=$req->input('deleted_at');

        $array=[
        "coupon_code"=>$coupon_code,
        "valid_from"=>$valid_from,
        "valid_till"=>$valid_till,
        "discount_type"=>$discount_type,
        "discount_amount"=>$discount_amount,
        "minimum_amount"=>$minimum_amount,
        "maximum_discount"=>$maximum_discount,
        "category_id"=>$category_id,
        "brand_id"=>$brand_id,
        "product_id"=>$product_id,
        "is_active"=>$is_active,
        "is_approved"=>$is_approved,
        "country_id"=>$country_id,
        "airport_id"=>$airport_id,
        "created_by"=>$created_by,
        "updated_by"=>$updated_by,
        "deleted_by"=>$deleted_by,
        "created_at"=>$created_at,
        "updated_at"=>$updated_at,
        "deleted_at"=>$deleted_at,
    ];

       	  DB::table('coupons')->insert($array);

 	      return "data insert Successfully!..";
    }

    public function coupons(Request $request){
    	$query = DB::table('coupons');
                     $query->where('is_approved',1);
                     if($request->id !==null){
                     
                       $query->where('id',$request->id);
                     }
                     if($request->coupon_code !==null){
                     
                       $query->where('coupon_code',$request->coupon_code);
                     }
                     if($request->is_active !==null){
                      
                       $query->where('is_active',$request->is_active);
                     }
            $coupon_detail=$query->get();
            return $coupon_detail;
    }

    public function apply(Request $request){
    	$coupon_code=$request->input('coupon_code');
        $token = $request->header('access-token');                
        try{
                $user = DB::table('users')->where('access_token', $token)->first();
                // return $user->access_token;
            }catch(\Exception $e) {
            return response()->json([
                    'code'         =>200,
                    'status'       =>'fail',
                    'message' => 'Invalid AccessToken user not found',
                ]);
            }
        $date = date('Y-m-d');
        $query = DB::table('coupons')->where('coupon_code',$coupon_code)->first();
             if ( $query->valid_till >= $date &&  $query->valid_from <= $date) {
                    echo "valid- ";
                 }else{
                    echo "invalid coupon code!";
                 }


            $total = 0;
            $data = DB::table('carts')
            ->join('products', 'products.parent_muin', '=', 'carts.product_muin')
            ->join('product_variation_detail', 'products.parent_muin', '=', 'product_variation_detail.parent_product_muin')
            ->select('carts.*', 'product_variation_detail.*', 'products.*', 'products.id as product_id')
            ->get();
            // print_r ($data);die;
            foreach ($data as $value) {
               $product_id = $value->product_id;
               $category_id = $value->category_id;
               $brand_id = $value->brand_id;
               $selling_price = $value->selling_price;
               $quantity = $value->quantity;
                // return $selling_price;
            
             // return $product_id;
            if($query->product_id == $product_id || $query->category_id == $category_id || $query->brand_id == $brand_id ){
                        $price    = floatval( $selling_price );
                        if( $query->discount_type = 0 )
                        {
                            $total  += $price * $quantity - $query->discount_amount;
                            return $total;
                        }
                        if($query->discount_type = 1){
                            $total  += $price * $quantity * ((100 - $query->discount_amount)/100);
                            return $total;
                        }
                }else{
                  echo "this coupon code is not valid for these products!";
                }
            }
            
    }
}
