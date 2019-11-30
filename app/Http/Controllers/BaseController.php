<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Partner;
use Illuminate\Http\Request;
use View;

class BaseController extends Controller
{
    protected $cats;

    public function __construct()
    {
        $this->cats = Category::all();
        View::share('cats', $this->cats);
        View::share('partners', Partner::all());
    }
}
