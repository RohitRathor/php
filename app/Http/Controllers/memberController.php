<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use DB;

class memberController extends Controller
{
    public function plans(){
    	$data = Member::all();
    	
    	 $data = $data->reject(function ($data){
                                          // return $trips->total_amount==null;
                                        })->map(function ($data) { 
                                        	$data->description=unserialize($data->description);
                                            return $data;
                                        }); 
                                        return $data;
    }

     public function data(){
    	
     		$description=array("Unlocks secret sales & promotional offers only applicable to Gold & Platinum members.",
                        "Twice a year get free Gift Wrapping/Personal Message service.",
                        "Once a year get free delivery of your order at your gate.",
                        "Once a year get free Porter Service at the Airport.");
     		$serializedArr = serialize($description);

 		$record = DB::table('members')->insert(array(
 			'member_type'=> '1',
 			'description'=>$serializedArr,
             'discount'=>'12%',
             'shipping_free'=>'yes',
             'extra discount'=>'5%' 
 		));
    	 print_r($record);
    	
    }
//     function order(){
//         $array =[1,2,3,1,2];
//    return array_unique(array_diff_assoc($array,array_unique($array)));
// }
    // public function order(){
    //     $array = [12,13,11,9];
    //      $ary = asort($array);
    //      print_r($ary);
    }
}
