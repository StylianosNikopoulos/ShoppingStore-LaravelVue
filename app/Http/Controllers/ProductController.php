<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Products::all();
        return view('products', compact('products'));
    }

    public function about(){
        return view('about');
    }

}
