<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable=['user_id','product_id','rate','review','status'];

    public function user_info(){
        return $this->hasOne('App\User','id','user_id');
    }

    public static function getAllReview(){
        // $reviews = DB::table('product_reviews')
        // ->join('products','product_reviews.product_id',"products.id")
        // ->select("product_reviews.*","products.title")
        // ->latest()->paginate(10);


        return ProductReview::with('user_info')->paginate(10);
        // return view('backend.review.index',compact('reviews'));
    }
    public static function getAllUserReview(){
        return ProductReview::where('user_id',auth()->user()->id)->with('user_info')->paginate(10);
    }

    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }

}
