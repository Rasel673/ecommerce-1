<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel;
use App\CategoryModel;
use App\SubcategoryModel;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
 */
  public function index()
    {
        $allProduct=ProductModel::all();
        return $allProduct;
    }

public function mainSlider(){
    $mainSlider=ProductModel::where(['main_slider'=>'1','status'=>'1'])->first();
        return $mainSlider;
}

public function midSlider(){
    $mid_slider=ProductModel::where(['mid_slider'=>'1','status'=>'1'])->get();
        return $mid_slider;
}
public function hotDeal(){
    $main=DB::table('products')
    ->join('categories', function ($join) {
        $join->on('products.cat_id', '=', 'categories.cat_id')
             ->where(['hot_deal'=>'1','products.status'=> '1']);
    })
    ->select('categories.en_name as cat_name','products.*')
    ->get();
 
    return $main;
}
public function hotNew(){
    $hot_deal=ProductModel::where(['hot_new'=>'1','status'=>'1'])->get();
        return $hot_deal;
}
public function bestRated(){
    $best_rated=ProductModel::where(['best_rated'=>'1','status'=>'1'])->get();
        return $best_rated;
}
public function buyone_getone(){
    $buyone_getone=ProductModel::where(['buyone_getone'=>'1','status'=>'1'])->get();
        return $buyone_getone;
}
public function ternd(){
    $trend=ProductModel::where(['trend'=>'1','status'=>'1'])->get();
        return $trend;
}
/////categories with subcategories------------------
public function Subcategories(){
   $cat=DB::table('categories')
   ->join('subcategories', function ($join) {
       $join->on('categories.cat_id', '=', 'subcategories.cat_id')
            ->where(['categories.status'=> '1']);
   })
   ->select('categories.en_name as cat_name','categories.cat_id as sub_cat_id','subcategories.en_name as sub_name','subcategories.sub_id','subcategories.status as sub_status')
   ->get();

   return $cat;
}
/////categories without subcategories------------------
public function categories(){
    $subCatIds = SubcategoryModel::pluck('cat_id')->all();
$cat = CategoryModel::whereNotIn('cat_id', $subCatIds)->Where(['categories.status'=> '1'])->get();
return $cat;

}

}
