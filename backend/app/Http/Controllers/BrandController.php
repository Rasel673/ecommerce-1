<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Image;
use App\BrandModel;
use DB;

class BrandController extends Controller
{

         //show Brand--------------------
 public function showBrands(){
    $all=BrandModel::all();
    return $all;
}   
     //all Brand--------------------
 public function allBrands(){
    $all=BrandModel::paginate(10);
    return $all;
}   
//insert Brand------
public function addBrands(Request $request){
   $this->validate($request, [
       'en_name' => 'required',
       'bn_name' => 'required',
       'status' => 'required',
       'brand_img' => 'required',
   ],
   [
    'en_name.required' => 'English name is required',
    'bn_name.required'  => 'Bangla name is required',
    'status.required'  => 'Status required',
    'brand_img.required'  => 'Brand Image required',
    
]
);

      $en_name=$request->input('en_name');
      $bn_name=$request->input('bn_name');
      $status=$request->input('status');
      
      if( $request->input('brand_img')){
        $explode1=explode(',', $request->input('brand_img'));
        $explode2=explode(';',$explode1[0]);
        $explode3=explode('/', $explode2[0]);
        $extention=$explode3[1];
        $filename=time().'.'.$extention;
        $img_save=Image::make($request->input('brand_img'))->save(base_path('public/brand_images/'.$filename),50);
    if( $img_save){
        $insert=BrandModel::insert(['en_name'=>$en_name,'bn_name'=> $bn_name,'brand_img'=>$filename,'status'=> $status]);
      if($insert){
      return 1;
      }else{
       return 0;
      }
//insert success

    }
///check image file upload
    }
   ///check image file exist end
      
}

///update Brand----------
public function updateBrands(Request $request){

    ////image name convert--------------  
  function imageConvert($image){
        
    $explode1=explode(',', $image);
    $explode2=explode(';',$explode1[0]);
    $explode3=explode('/', $explode2[0]);
    $extention=$explode3[1];
    $filename=rand(1,999999).'.'.$extention;
    return  $filename;
}

   $this->validate($request, [
       'b_id'=>'required',
       'en_name' => 'required',
       'bn_name' => 'required',
       'status' => 'required',
       'brand_img' => 'required',
   ],
   [
    'b_id.required' => 'Brand Id is required',
    'en_name.required' => 'English name is required',
    'bn_name.required'  => 'Bangla name is required',
    'status.required'  => 'Status required',
    'brand_img.required'  => 'Brand Image required',
    
]


);
   $id=$request->input('b_id');
   $en_name=$request->input('en_name');
    $bn_name=$request->input('bn_name');
    $brand_img=$request->input('brand_img');
   $status=$request->input('status');
   $imgUp1=$request->input('imgUp1');

   if($imgUp1=='1'){
  $one=imageConvert($brand_img);
  $dlt_img1=BrandModel::where('b_id',$id)->select('brands.brand_img')->first();
  $brand_img=Image::make($request->input('brand_img'))->save(base_path('public/brand_images/'.$one),50);
  unlink(base_path('public/brand_images/'.$dlt_img1->brand_img));
  $update_img=BrandModel::where('b_id',$id)->update(['brand_img'=>$one]);
   }

$update=BrandModel::where('b_id',$id)->update([
    'en_name'=>$en_name,
    'bn_name'=>$bn_name,
    'status'=> $status
    ]);
    if($update){
        return 1;
        }
  

}
////delete Brand -----------
public function deleteBrands($b_id){

    $dlt_img=BrandModel::where('b_id',$b_id)->select('brands.brand_img')->first();
    unlink(base_path('public/brand_images/'.$dlt_img->brand_img));
    if($dlt_img){
    $delete=BrandModel::where('b_id',$b_id)->delete();
     if($delete){
       return response()->json(['Brand Deleted']);
       }
    }
}

////single Brand view------------------------------
public function singleBrands(Request $request){
    $search=$request->input('search');
    $single=BrandModel::where('en_name','like','%'.$search.'%')
    ->orWhere('bn_name','like','%'.$search.'%')
    ->orWhere('status','like','%'.$search.'%')
    ->paginate(10);
    if($single){
      return $single;
      }else{
       return response()->json(['something went wrong']);
      }

}
}
