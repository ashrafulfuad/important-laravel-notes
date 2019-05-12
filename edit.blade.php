@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h2>Updading of <span style="color:green">{{ $edit_products->product_name }}</span></h2>
        @if (session('edit_status'))
         <div class="alert alert-warning">
           {{ session('edit_status') }}
         </div>
       @endif
          <form action="{{ url('edit/product/insert') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Product Name</label>
              <input type="hidden" name="product_id" value="{{ $edit_products->id }}">
              <input type="text" name="product_name" value="{{ $edit_products->product_name }}" class="form-control">
            </div>
            <div class="form-group">
              <label>Product Price</label>
              <input type="number" name="product_price" value="{{ $edit_products->product_price }}" class="form-control">
            </div>
            <div class="form-group">
              <label>Product Color</label>
              <input type="text" name="product_color" value="{{ $edit_products->product_color }}" class="form-control">
            </div>
            <div class="form-group">
              <label>Product Size</label>
              <input type="text" name="product_size" value="{{ $edit_products->product_size }}" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
    </div>
</div>
@endsection
