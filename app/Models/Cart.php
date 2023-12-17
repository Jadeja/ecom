<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'session_id',
        'quantity',
        'size',
        'user_id'
    ];

    public static function getCartDetails(){

        $session_id = Session::get("session_id");
        if(empty($session_id)){
            $session_id = Session::getId();
            Session::put('session_id',$session_id);
        }
        
        if(Auth::check()){
            $card_detail = Cart::with('product')->where(['user_id'=>Auth::user()->id])->orderBy('id','desc')->get()->toArray();
        }else{
            $card_detail = Cart::with('product')->where(['session_id'=>$session_id])->orderBy('id','desc')->get()->toArray();
        }

        return $card_detail;
    }

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }

}
