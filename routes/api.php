<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product; // Don't forget to import the Model!
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    // The code goes HERE, inside the class
    public function index() {
        return response()->json(Product::with('category')->where('is_active', 1)->get());
    }
}