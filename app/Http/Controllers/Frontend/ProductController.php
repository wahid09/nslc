<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $categories = Category::active()->get();
        $products = Product::active()->get();
        return view('frontend.products.products', compact('categories', 'products'));
    }
    public function getProduct($catId, $areaId){
        if($catId == 0){
            //$products = DB::select("select * from products where status=1");
            // $products = DB::table('products')
            //           ->join('areas', 'products.area_id', '=', 'areas.id')
            //           ->where('products.area_id', '=', $areaId)
            //           ->where('products.status', 1)
            //           ->latest()->get();
            $products = DB::table('products')
            ->where('area_id', $areaId)
            ->where('status', 1)
            ->get();
        }else{
            $products = DB::select("select * from products where categorie_id = $catId AND status=1 AND area_id = $areaId");
            // $products = DB::table('products')
            //            ->join('areas', 'products.area_id', '=', 'areas.id')
            //            ->join('categories', 'products.categorie_id', '=', 'categories.id')
            //            ->where('products.area_id', '=', $areaId)
            //            ->where('products.categorie_id', '=', $catId)
            //            ->where('products.status', 1)
            //            ->latest()->get();
        }
        //dd($products);
        return view('frontend.products.plist', compact('products'));
    }
    public function discuntProduct($catId, $areaId){
        if($catId == 0){
            $products = DB::table('products')
            ->where('area_id', $areaId)
            ->where('status', 1)
            ->get();
        }elseif($catId == 1){
            $products = DB::select("select * from products where status=1 AND area_id = $areaId AND discount > 0");
        }elseif($catId == 2){
            //$products = DB::select("select * from products where status=1 AND area_id = $areaId AND discount > 0");
            $products = Product::where('area_id', $areaId)->latest()->get();
        }
        return view('frontend.products.plist', compact('products'));
    }
}
