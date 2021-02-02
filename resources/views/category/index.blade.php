@extends('layouts.master')

@section('content')
    <div class="col-md-6">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Categories</h3>
            </div>

            <form method="POST" action="{{ route('categories/add') }}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Category type</label>
                        <select name="category_type_id" class="form-control @error('category_type_id') is-invalid @enderror">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_type_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Category name</label>
                        <input id="category_name" type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ old('category_name') }}" required autocomplete="category_name" autofocus>

                        @error('category_name')
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
