<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryModel;

class CategoriesController extends Controller
{

  //all categories------
 public function showCategories(){
    $all=CategoryModel::all();
    return $all;
}     

    //all categories------
 public function allCategories(){
     $all=CategoryModel::paginate(10);
     return $all;
 }   
//insert categories------
public function addCategories(Request $request){
    $this->validate($request, [
        'en_name' => 'required',
        'bn_name' => 'required',
        'status' => 'required',
    ],
    [
        'en_name.required' => 'English name is required',
        'bn_name.required'  => 'Bangla name is required',
        'status.required'  => 'Status required',
    ]

);
       
       $en_name=$request->input('en_name');
       $bn_name=$request->input('bn_name');
       $status=$request->input('status');

       $insert=CategoryModel::insert(['en_name'=>$en_name,'bn_name'=> $bn_name,'status'=> $status]);
       if($insert){
       return response()->json(['Category Inserted']);
       }else{
        return response()->json(['Category insert failed']);
       }
}

///update categories----------
public function updateCategories(Request $request){
    $this->validate($request, [
        'cat_id' => 'required',
        'en_name' => 'required',
        'bn_name' => 'required',
        'status' => 'required',
    ],

    [
        'en_name.required' => 'English name is required',
        'bn_name.required'  => 'Bangla name is required',
        'status.required'  => 'Status required',
    ]


);
    $id=$request->input('cat_id');
    $en_name=$request->input('en_name');
     $bn_name=$request->input('bn_name');
    $status=$request->input('status');
    $update=CategoryModel::where('cat_id',$id)->update(['en_name'=>$en_name,'bn_name'=> $bn_name,'status'=> $status]);
    if($update){
        return response()->json(['Category Updated']);
        }else{
         return response()->json(['Category update failed']);
        }

}
////delete categories -----------
public function deleteCategories($cat_id){
     $delete=CategoryModel::where('cat_id',$cat_id)->delete();
      if($delete){
        return response()->json(['Category Deleted']);
        }

}

////single category view------------------------------
public function singleCategories(Request $request){
    $search=$request->input('search');
    $single=CategoryModel::where('en_name','like','%'.$search.'%')
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