<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        $users = User::with('category')->with('transactions')->get()->toArray();

        foreach ($users as $key => $user) {
            $users[$key]['total_incomes'] = Transaction::where('user_id', $user['id'])->whereHas('category', function($query){
                $query->whereCategoryTypeId(1);
            })->sum('amount');

            $users[$key]['total_expenses'] = Transaction::where('user_id', $user['id'])->whereHas('category', function($query){
                $query->whereCategoryTypeId(2);
            })->sum('amount');
        }

        return view('admin.index', compact('users'));
    }
}
