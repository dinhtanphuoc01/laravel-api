<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APISearchController extends Controller
{
    public function searchCategory(Request $request)
    {
        $categories = Category::where('name', 'LIKE', '%' . $request->input('name') . '%')
            ->orWhere('parent_id', 'LIKE', '%' . $request->input('name'), '%')
            ->orWhere('created_at', 'LIKE', '%' . $request->input('name') . '%')
            ->orWhere('updated_at', 'LIKE', '%' . $request->input('name') . '%')
            ->get();

        $categories_array = $categories->toArray();
        foreach ($categories_array as $key => $value) {
            $created_at                           = strtotime($value['created_at']);
            $created_at                           = date('Y-m-d\TH:i:s.u\Z', $created_at);
            $categories_array[$key]['created_at'] = $created_at;

            $updated_at                           = strtotime($value['updated_at']);
            $updated_at                           = date('Y-m-d\TH:i:s.u\Z', $updated_at);
            $categories_array[$key]['updated_at'] = $updated_at;
        }

        return response()->json([
            'status'     => 200,
            'categories' => $categories_array,
        ]);
    }

    public function searchProduct(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%' . $request->input('name') . '%')
            ->orWhere('detail', 'LIKE', '%' . $request->input('name') . '%')
            ->orWhere('image', 'LIKE', '%' . $request->input('name'), '%')
            ->orWhere('price', 'LIKE', '%' . $request->input('name'), '%')
            ->orWhere('created_at', 'LIKE', '%' . $request->input('name') . '%')
            ->orWhere('updated_at', 'LIKE', '%' . $request->input('name') . '%')
            ->get();

        $products_array = $products->toArray();
        foreach ($products_array as $key => $value) {
            $created_at                         = strtotime($value['created_at']);
            $created_at                         = date('Y-m-d\TH:i:s.u\Z', $created_at);
            $products_array[$key]['created_at'] = $created_at;

            $updated_at                         = strtotime($value['updated_at']);
            $updated_at                         = date('Y-m-d\TH:i:s.u\Z', $updated_at);
            $products_array[$key]['updated_at'] = $updated_at;
        }
        return response()->json([
            'status'   => 200,
            'products' => $products_array,
        ]);
    }
}
