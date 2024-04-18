<?php 

use Illuminate\Support\Str;

function getRandomNumber($min,$max){
    
    return rand($min,$max);

}

function showTitle($title, $limit){

    if(Str::length($title) > $limit){
        return Str::limit($title, $limit);
    }

    return $title;

}
function getAmount($amount = null){

    $takaSymbol = '৳';
    if($amount == null){
        return $takaSymbol;
    }
    $amount = $takaSymbol . number_format(round($amount,2));
    return $amount;

}
function getImage($image,$type){

    return asset("/uploads/" . $type . "/images/" . $image);
}