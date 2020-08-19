<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Image;
use App\ProductModel;
use App\DB;

class ProductController extends Controller
{
     //all Product------
 public function allProducts(){
    $all=ProductModel::paginate(10);
    return $all;
}   


//insert Product------
public function addProducts(Request $request){

  ////image convert--------------  
    function imageConvert($image){
        
        $explode1=explode(',', $image);
        $explode2=explode(';',$explode1[0]);
        $explode3=explode('/', $explode2[0]);
        $extention=$explode3[1];
        $filename=rand(1,999999).'.'.$extention;
    
        return $filename;
    }
 //////validation-----------------------------------
    $this->validate($request, [
        'cat_id' => 'required',
        'b_id' => 'required',
        'sub_id' => 'required',
        'product_name' => 'required',
        'product_code' => 'required',
        'product_quantity' => 'required',
        'selling_price' => 'required',
        'image_one' => 'required',
        'status' => 'required',
    ],
    [
      'cat_id.required' => 'Category name is required',
      'b_id.required'  => 'Brand name is required',
      'sub_id.required'  => 'Subcategory required',
      'product_name.required'  => 'Product name required',
      'product_code.required'  => 'Product code required',
      'product_quantity.required'  => 'Product quantity is required',
      'selling_price.required'  => 'Product selling price is required',
      'image_one.required'  => 'Image one must be fill  required',
      'status.required'  => 'Status required',
  ]
  );
       $cat_id=$request->input('cat_id');
       $b_id=$request->input('b_id');
       $sub_id=$request->input('sub_id');
       $product_name=$request->input('product_name');
       $product_code=$request->input('product_code');
       $product_quantity=$request->input('product_quantity');
       $product_details=$request->input('product_details');
       $product_color=$request->input('product_color');
       $product_size=$request->input('product_size');
       $selling_price=$request->input('selling_price');
       $discount_price=$request->input('discount_price');
       $video_link=$request->input('video_link');
       $main_slider=$request->input('main_slider');
       $mid_slider=$request->input('mid_slider');
       $hot_deal=$request->input('hot_deal');
       $hot_new=$request->input('hot_new');
       $best_rated=$request->input('best_rated');
       $buyone_getone=$request->input('buyone_getone');
       $trend=$request->input('trend');
    $image_one=$request->input('image_one');
    $image_two=$request->input('image_two');
    $image_three=$request->input('image_three');
       $status=$request->input('status');
       if($image_one!=null){
        $one=imageConvert( $image_one);
        $img_save1=Image::make($request->input('image_one'))->save(base_path('public/product_images/'.$one),50);
        $insert_img_on_id=ProductModel::insertGetId(['image_one'=>$one]);
        if($image_two!=null){
        $two=imageConvert( $image_two);
        $img_save2=Image::make($request->input('image_two'))->save(base_path('public/product_images/'.$two),50);
        $insert_img_two=ProductModel::where('id',$insert_img_on_id)->update(['image_two'=>$two]);
        }
        if($image_three!=null){
        $three=imageConvert($image_three);
      $img_save3=Image::make($request->input('image_three'))->save(base_path('public/product_images/'.$three),50); 
      $insert_img_three=ProductModel::where('id',$insert_img_on_id)->update(['image_three'=>$three]);   
        }
      }else{
        return 0;
       }
      ///check image file upload and image insert----------------------------
        if($insert_img_on_id){
            $insert=ProductModel::where('id',$insert_img_on_id)->update([
                'cat_id'=>$cat_id,
                'b_id'=> $b_id,
                'sub_id'=>$sub_id,
                'product_name'=>$product_name,
                'product_code'=>$product_code,
                'product_quantity'=>$product_quantity,
                'product_details'=>$product_details,
                'product_color'=>$product_color,
                'product_size'=>$product_size,
                'selling_price'=>$selling_price,
                'discount_price'=>$discount_price,
                'video_link'=>$video_link,
                'main_slider'=>$main_slider,
                'mid_slider'=>$mid_slider,
                'hot_deal'=>$hot_deal,
                'hot_new'=>$hot_new,
                'best_rated'=>$best_rated,
                'buyone_getone'=>$buyone_getone,
                'trend'=>$trend,
                'status'=> $status
                
                
                ]);
          if($insert){
          return 1;
          }else{
           return 0;
          }
    //insert success
    }
        
     
//     ///check image file exist end
}

///update Product----------
public function updateProducts(Request $request){

  ////image name convert--------------  
  function imageConvert($image){
        
    $explode1=explode(',', $image);
    $explode2=explode(';',$explode1[0]);
    $explode3=explode('/', $explode2[0]);
    $extention=$explode3[1];
    $filename=rand(1,999999).'.'.$extention;

    return $filename;
}
    $this->validate($request, [
        'id'=>'required',
        'cat_id' => 'required',
        'b_id' => 'required',
        'sub_id' => 'required',
        'product_name' => 'required',
        'product_code' => 'required',
        'product_quantity' => 'required',
        'selling_price' => 'required',
        'image_one' => 'required',
        'status' => 'required',
    ],
     [
      'cat_id.required' => 'Category name is required',
      'b_id.required'  => 'Brand name is required',
      'sub_id.required'  => 'Subcategory required',
      'product_name.required'  => 'Product name required',
      'product_code.required'  => 'Product code required',
      'product_quantity.required'  => 'Product quantity is required',
      'selling_price.required'  => 'Product selling price is required',
      'image_one.required'  => 'Image one must be fill  required',
      'status.required'  => 'Status required',
  ]

  
  );
       $id=$request->input('id');
       $cat_id=$request->input('cat_id');
       $b_id=$request->input('b_id');
       $sub_id=$request->input('sub_id');
       $product_name=$request->input('product_name');
       $product_code=$request->input('product_code');
       $product_quantity=$request->input('product_quantity');
       $product_details=$request->input('product_details');
       $product_color=$request->input('product_color');
       $product_size=$request->input('product_size');
       $selling_price=$request->input('selling_price');
       $discount_price=$request->input('discount_price');
       $video_link=$request->input('video_link');
       $main_slider=$request->input('main_slider');
       $mid_slider=$request->input('mid_slider');
       $hot_deal=$request->input('hot_deal');
       $hot_new=$request->input('hot_new');
       $best_rated=$request->input('best_rated');
       $buyone_getone=$request->input('buyone_getone');
       $trend=$request->input('trend');
       $image_one=$request->input('image_one');
      $image_two=$request->input('image_two');
      $image_three=$request->input('image_three');
      $imgUp1=$request->input('imgUp1');
      $imgUp2=$request->input('imgUp2');
      $imgUp3=$request->input('imgUp3');
       $status=$request->input('status');

       
       if($image_one!=null){
        $dlt_img1=ProductModel::where('id',$id)->select('products.image_one')->first();
         if($imgUp1=='1'){
        $one=imageConvert($image_one);
        $img_save1=Image::make($request->input('image_one'))->save(base_path('public/product_images/'.$one),50);
        unlink(base_path('public/product_images/'.$dlt_img1->image_one));
        $update_img_one=ProductModel::where('id',$id)->update(['image_one'=>$one]);
         }
    ///image two upload-----------------------------------    
        if($image_two!=null){
          $dlt_img2=ProductModel::where('id',$id)->select('products.image_two')->first();
          if($imgUp2=='1'){
        $two=imageConvert( $image_two);
        $img_save2=Image::make($request->input('image_two'))->save(base_path('public/product_images/'.$two),50);
        
        if($dlt_img2!=null){
        unlink(base_path('public/product_images/'.$dlt_img2->image_two));
        $update_img_two=ProductModel::where('id',$id)->update(['image_two'=>$two]);
      }else{
        $update_img_two=ProductModel::where('id',$id)->update(['image_two'=>$two]);
      }
    }
        }
////image three upload----------------------------
        if($image_three!=null){
          $dlt_img3=ProductModel::where('id',$id)->select('products.image_three')->first();
          if($imgUp3=='1') {
        $three=imageConvert($image_three);
      $img_save3=Image::make($request->input('image_three'))->save(base_path('public/product_images/'.$three),50); 
     
        if($dlt_img3!=null){
        unlink(base_path('public/product_images/'.$dlt_img3->image_three));
        $update_img_three=ProductModel::where('id',$id)->update(['image_three'=>$three]);
      }else{
        $update_img_three=ProductModel::where('id',$id)->update(['image_three'=>$three]);
      }
    }
        }
      }

////uplaod wihout image part-----------
        $update=ProductModel::where('id',$id)->update([
            'cat_id'=>$cat_id,
            'b_id'=> $b_id,
            'sub_id'=>$sub_id,
            'product_name'=>$product_name,
            'product_code'=>$product_code,
            'product_quantity'=>$product_quantity,
            'product_details'=>$product_details,
            'product_color'=>$product_color,
            'product_size'=>$product_size,
            'selling_price'=>$selling_price,
            'discount_price'=>$discount_price,
            'video_link'=>$video_link,
            'main_slider'=>$main_slider,
            'mid_slider'=>$mid_slider,
            'hot_deal'=>$hot_deal,
            'hot_new'=>$hot_new,
            'best_rated'=>$best_rated,
            'buyone_getone'=>$buyone_getone,
            'trend'=>$trend,
            'status'=> $status
            
            
            ]);
      if($update){
      return 1;
      }else{
       return 0;
      }
//insert success
}
////delete product -----------
public function deleteProducts($id){
  $dlt_img1=ProductModel::where('id',$id)->select('products.image_one')->first();
  unlink(base_path('public/product_images/'.$dlt_img1->image_one));

  $dlt_img2=ProductModel::where('id',$id)->select('products.image_two')->first();
        if($dlt_img2!=null){
        unlink(base_path('public/product_images/'.$dlt_img2->image_two));
      }

$dlt_img3=ProductModel::where('id',$id)->select('products.image_three')->first();
      if($dlt_img3!=null){
      unlink(base_path('public/product_images/'.$dlt_img3->image_three));
    }
    
    if($dlt_img1){
    $delete=ProductModel::where('id',$id)->delete();
     if($delete){
       return 1;
       }else{
        return 0;
       }
    }

}

////single Product search view------------------------------
public function singleProducts(Request $request){
    $search=$request->input('search');
    $single=ProductModel::where('product_name','like','%'.$search.'%')
    ->orWhere('product_code','like','%'.$search.'%')
    ->orWhere('status','like','%'.$search.'%')
    ->paginate(10);
    if($single){
      return $single;
      }else{
       return response()->json(['something went wrong']);
      }

}
}
