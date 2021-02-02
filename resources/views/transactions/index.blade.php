@extends('layouts.master')

@section('content')
    <div class="col-md-6">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Transactions</h3>
            </div>

            <form method="POST" action="{{ route('transactions/add') }}">
                @csrf
                <div class="box-body">

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            <option value="">Select</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>

                        @error('category_id')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>



                    <div class="form-group">
                        <label>Amount</label>
                        <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount" autofocus>

                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Notes</label>
                        <textarea id="note" name="note" class="form-control @error('note') is-invalid @enderror" rows="3" placeholder="Notes" value="{{ old('note') }}"></textarea>
                        @error('note')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>


    </div>
@endsection
