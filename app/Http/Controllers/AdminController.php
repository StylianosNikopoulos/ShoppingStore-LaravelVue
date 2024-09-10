<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $products = Products::all();
        return view('admin.dashboard',compact('products'));
    }

    public function create(){
    }
}
