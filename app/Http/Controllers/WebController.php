<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MajorCategory;
use App\Models\Product;

class WebController extends Controller
{
    public function index(){
    $categories = Category::all();//トップページの実装にかかわる。すべてのカテゴリを取得して大カテゴリ名でソートして表示させる
    $major_categories = MajorCategory::all();

    $recently_products = Product::orderBy('created_at', 'desc')->take(4)->get();//商品の登録日時（created_at）でソートして、新しい順に4つ取得してビューに渡す

    $recommend_products = Product::where('recommend_flag', true)->take(3)->get();

    $featured_products = Product::withAvg('reviews', 'score')->orderBy('reviews_avg_score', 'desc')->take(4)->get();
    
    return view('web.index', compact('major_categories', 'categories', 'recently_products', 'recommend_products', 'featured_products'));
    }
}
