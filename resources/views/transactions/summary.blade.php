@extends('layouts.master')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Transactions Table</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Category Type</th>
                                <th>Category</th>
                                <th>Notes</th>
                                <th>Transaction Amount</th>
                                <th>Created date</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{$transaction->category->category_type->category_type_name}}</td>
                                    <td>{{$transaction->category->category_name}}</td>
                                    <td>{{$transaction->note}}</td>


                                    <td>
                                        @if($transaction->category->category_type->id == 1)
                                            <span class="badge bg-success">{{$transaction->amount}}</span>
                                        @else
                                            <span class="badge bg-danger">{{$transaction->amount}}</span>
                                        @endif
                                    </td>

                                    <td>{{$transaction->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-4 col-6">
                        <div class="description-block border-right">
                            <h5 class="description-header ">{{$walletAmount}}</h5>
                            <span class="description-text">WALLET BALANCE</span>
                        </div>

                    </div>

                    <div class="col-sm-4 col-6">
                        <div class="description-block border-right">
                            <h5 class="description-header text-success">{{$totalIncome}}</h5>
                            <span class="description-text">TOTAL OF INCOMES</span>
                        </div>

                    </div>

                    <div class="col-sm-4 col-6">
                        <div class="description-block">
                            <h5 class="description-header text-danger">{{$totalExp}}</h5>
                            <span class="description-text">TOTAL OF EXPENSES</span>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
