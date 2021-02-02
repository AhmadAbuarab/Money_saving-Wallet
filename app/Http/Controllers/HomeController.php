<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->is_admin) {
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
        return view('home');
    }

    public function getGraph() {

        $transactions = Transaction::select(
                'categories.category_type_id as category_type_id',
                DB::raw('sum(transactions.amount) as `data`'),
                DB::raw("DATE_FORMAT(transactions.created_at, '%m-%Y') new_date"),
                DB::raw('YEAR(transactions.created_at) year, MONTH(transactions.created_at) month, DAY(transactions.created_at) day'))
            ->join("categories", "categories.id", "=", "transactions.category_id")
            ->where('transactions.user_id', Auth::user()->id)
            ->groupby('year','month','day','new_date','category_type_id')
            ->get();

        return $transactions;
    }
}
