<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->products = collect(json_decode(file_get_contents('http://67.209.121.4/products.json')));
        // $this->products = json_decode(file_get_contents('http://67.209.121.4/products.json'));
    }

    public function categoryInput(Request $request) {
        return view('category-input');
    }

    public function categorySearch(Request $request) {
        $category = $request->category;
        $filtered = $this->products->filter(function ($value, $key) use ($category) {
            return trim(strtolower($value->MasterCategory)) == trim(strtolower($category));
        });

        $category_result = $filtered->groupBy('SubCategory')->map(function ($product) {
            return $product->count();
        })->all();
        return view('category-search', compact('category_result', 'category'));
    }

    public function subcategorySearch(Request $request) {
        $category = $request->category;
        $subcategory = $request->subcategory;
        $page = intval($request->page ?? 1);
        $filtered = $this->products->filter(function ($value, $key) use ($category, $subcategory) {
            return (trim(strtolower($value->MasterCategory)) == trim(strtolower($category)) && trim(strtolower($value->SubCategory)) == trim(strtolower($subcategory)));
        });
        // dd(sizeof($filtered));
        $product_result = $filtered->forPage($page, 10)->all();
        $product_result = $this->generatePagenation($product_result, $page, sizeof($filtered), 10);
        return view('subcategory-search', compact('product_result', 'category', 'subcategory'));
    }

    public function generatePagenation($resultData, $current_page, $result_number, $size = 21, $max_show_page = null)
    {
        $max_show_page = $max_show_page ?? 11;
        $all_pages = intval(ceil($result_number / $size));
        $current_page = intval($current_page ?? 1);
        $current_page = min(max(1, $current_page), $all_pages);

        $current_range_start = $current_page - round($max_show_page /2);
        $current_range_end = $current_range_start + $max_show_page;

        if ($current_range_start < 1) $current_range_end = $max_show_page;
        if ($current_range_end > $all_pages) $current_range_start = $all_pages - $max_show_page;

        $current_range_start = max(1, $current_range_start);
        $current_range_end = min($all_pages, $current_range_end);

        if (is_object($resultData))
        {
            $resultData->all_pages = $all_pages;
            $resultData->current_range_start = $current_range_start;
            $resultData->current_range_end = $current_range_end;
            $resultData->current_page = $current_page;
        } else {
            $resultData['all_pages'] = $all_pages;
            $resultData['current_range_start'] = $current_range_start;
            $resultData['current_range_end'] = $current_range_end;
            $resultData['current_page'] = $current_page;
        }

        return $resultData;
    }
    
}
