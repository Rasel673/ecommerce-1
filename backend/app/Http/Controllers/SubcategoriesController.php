<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubcategoryModel;
use DB;
class SubcategoriesController extends Controller
{

    ////show su-Category================
    public function showSubcategories(){
        $all=SubcategoryModel::all();
        return $all;
    }   
    //all Sub-categories------
 public function allSubcategories(){
    $all=SubcategoryModel::paginate(10);
    return $all;
}   
//insert Sub-categories------
public function addSubcategories(Request $request){
   $this->validate($request, [
       'cat_id'=>'required',
       'en_name' => 'required',
       'bn_name' => 'required',
       'status' => 'required',
   ],
   [
    'cat_id.required' => 'Category  is required',
    'en_name.required' => 'English name is required',
    'bn_name.required'  => 'Bangla name is required',
    'status.required'  => 'Status required',
   
]

);
      $cat_id=$request->input('cat_id');
      $en_name=$request->input('en_name');
      $bn_name=$request->input('bn_name');
      $status=$request->input('status');

      $insert=SubcategoryModel::insert(['cat_id'=>$cat_id,'en_name'=>$en_name,'bn_name'=> $bn_name,'status'=> $status]);
      if($insert){
      return response()->json(['Sub-Category Inserted']);
      }else{
       return response()->json(['Sub-Category insert failed']);
      }
}

///update Sub-categories----------
public function updateSubcategories(Request $request){
   $this->validate($request, [
       'sub_id'=>'required',
       'cat_id' => 'required',
       'en_name' => 'required',
       'bn_name' => 'required',
       'status' => 'required',
   ]);
   $id=$request->input('sub_id');
   $cat_id=$request->input('cat_id');
   $en_name=$request->input('en_name');
    $bn_name=$request->input('bn_name');
   $status=$request->input('status');
   $update=SubcategoryModel::where('sub_id',$id)->update(['cat_id'=>$cat_id,'en_name'=>$en_name,'bn_name'=> $bn_name,'status'=> $status]);
   if($update){
       return response()->json(['Sub-Category Updated']);
       }else{
        return response()->json(['Sub-Category update failed']);
       }

}
////delete Sub-categories -----------
public function deleteSubcategories($sub_id){
    $delete=SubcategoryModel::where('sub_id',$sub_id)->delete();
     if($delete){
       return response()->json(['Sub-Category Deleted']);
       }

}

////single Sub-category view------------------------------
public function singleSubcategories(Request $request){
    $search=$request->input('search');
    $single=SubcategoryModel::where('en_name','like','%'.$search.'%')
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
