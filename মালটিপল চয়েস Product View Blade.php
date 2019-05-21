@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
          <h2>Add Product</h2>
          @if ($errors->all())                                        {{-- it will be auto generated from validation --}}
            <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </div>
          @endif
          <form action="{{ url('product/insert') }}" method="post">
            @csrf
            <div class="form-group">
              <label>Product Name</label>
              <input name="product_name" type="text" class="form-control">
            </div>
            <div class="form-group">
              <label>Product Price</label>
              <input name="product_price" type="number" class="form-control">
            </div>
            <div class="form-group">
              <label>Product Color</label>

              <select class="form-control color_select" name="color_id[]" multiple="multiple">
                @foreach ($colors as $color)
                  <option style="color:{{ $color->color_code }}" value="{{ $color->id }}">-{{ $color->color_name }}-</option>
                @endforeach
              </select>

            </div>
            <div class="form-group">
              <label>Product Size</label>
              <input name="product_size" type="text" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          @if (session('status'))
           <div class="alert alert-success">
             {{ session('status') }}
           </div>
         @endif
        </div>
        <div class="col-md-8 text-center">
          <h2>View Product</h2>
          @if (session('deleted_status'))
           <div class="alert alert-danger">
             {{ session('deleted_status') }}
           </div>
         @endif
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Color</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
              <tr>
                <th>{{ $product->id }}</th>
                <th>{{ title_case($product->product_name) }}</th>
                <th>{{ $product->product_price }}</th>
                <th>
                  @foreach (json_decode($product->product_color) as $product_colors)
                    @php
                      $color_code = App\Color::find($product_colors)->color_code
                    @endphp
                  <div style="background:{{ $color_code }}; height:10px; width:20px;">

                  </div>
                  @endforeach
                </th>
                <th>{{ $product->created_at }}</th>
                <th><a href="{{ url('product/delete') }}/{{ $product->id }}" class="btn btn-sm btn-danger">del</a>
                  <a href="{{ url('product/edit') }}/{{ $product->id }}" class="btn btn-sm btn-info">edit</a></th>
              </tr>
            @endforeach
            </tbody>
            {{ $products->links() }}
          </table>
        </div>
    </div>
    <div class="row justify-content-end">
      <div class="col-md-8 text-center">
          <h2>Deleted Products</h2>
        <table class="table">
           @if (session('restore_status'))
            <div class="alert alert-success">
              {{ session('restore_status') }}
            </div>
          @endif
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($deleted_products as $deleted_product)
            <tr>
              <th>{{ $deleted_product->id }}</th>
              <th>{{ title_case($deleted_product->product_name) }}</th>
              <th>{{ $deleted_product->product_price }}</th>
              <th><a href="{{ url('product/restore') }}/{{ $deleted_product->id }}" class="btn btn-sm btn-info">Restore</a></th>
            </tr>
          @endforeach
          </tbody>
          {{ $products->links() }}
        </table>
      </div>
    </div>
</div>
@endsection
