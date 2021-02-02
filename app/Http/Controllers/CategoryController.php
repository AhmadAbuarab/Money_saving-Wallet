<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        $categories = CategoryType::all();

        return view('category.index', compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * store
     */
    public function store(Request $request) {

        $validatedData = $request->validate([
            'category_name' => ['required', 'string', 'max:255'],
        ]);

        Category::create([
            'user_id' => Auth::user()->id,
            'category_type_id' => $request->input('category_type_id'),
            'category_name' => $request->input('category_name'),
        ]);

        return redirect()->back();
    }
}
