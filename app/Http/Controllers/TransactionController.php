<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller {

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

        $categories = Category::all();

        return view('transactions.index', compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * store
     */
    public function store(Request $request) {

        $category = Category::where('id', $request->input('category_id'))->get();
        $category_type_id = $category[0]->category_type_id;

        $validatedData = $request->validate([
            'category_id' => ['required', 'not_in:0'],
            'note' => ['required'],
        ]);

        if($category_type_id == '2') {

            $totalIncome = Transaction::where('user_id', Auth::user()->id)->whereHas('category', function($query){
                $query->whereCategoryTypeId(1);
            })->sum('amount');

            $totalExpness = Transaction::where('user_id', Auth::user()->id)->whereHas('category', function($query){
                $query->whereCategoryTypeId(2);
            })->sum('amount');

            $wallet = $totalIncome - $totalExpness;

            $validatedData = $request->validate([
                'amount' => ['required', "lt:$wallet"],
            ]);
        }

        Transaction::create([
            'category_id' => $request->input('category_id'),
            'amount' => $request->input('amount'),
            'note' => $request->input('note'),
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function summary() {

        $totalIncome = 0;
        $totalExp = 0;
        $walletAmount = 0;

        $transactions = Transaction::where('user_id', Auth::user()->id)->get();

        foreach ($transactions as $transaction) {
            if($transaction->category->category_type->category_type_name == 'incomes') {
                $totalIncome = $totalIncome + $transaction->amount;
            } else {
                $totalExp = $totalExp + $transaction->amount;
            }
        }

        $walletAmount = $totalIncome - $totalExp;

        return view('transactions.summary', compact('transactions', 'walletAmount', 'totalIncome', 'totalExp'));
    }
}
