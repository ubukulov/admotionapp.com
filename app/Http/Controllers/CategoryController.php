<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function show($alias)
    {
        $category = Category::whereAlias($alias)->first();
        if (!$category) abort(404);
        return view('category.index', compact('category'));
    }
}
