@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-4">
          <h3>Add Product</h3>
          {{-- success message --}}
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          {{-- errors message --}}
          @if ($errors->all())
            <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </div>
          @endif

          <form action="{{ url('product/insert') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label >Product Name</label>
              <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}">
            </div>
            <div class="form-group">
              <label >Product Price</label>
              <input type="" name="product_price" class="form-control" value="{{ old('product_price') }}">
            </div>
            <div class="form-group form-control form-check form-check-inline">
              @foreach ($all_colors as $color)
                <label for="{{ $color->color_name }}" style="width:50px; height:50px; background:{{ $color->color_code }}"></label>
                <input id="{{ $color->color_name }}" type="checkbox" name="color[]" class="form-control form" value="{{ $color->id }}" >
              @endforeach
            </div>
            <div class="form-group">
                <label for="">Product photo</label>
                <input type="file" name="product_photo" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
          </form>
        </div>
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-12">
              <h3>Product List</h3>
              {{-- success message --}}
              @if (session('delete_status'))
                <div class="alert alert-danger">
                  {{ session('delete_status') }}
                </div>
              @endif

              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Created At</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                    <tr>
                      <td>{{ $product->id }}</td>
                      <td>{{ title_case($product->product_name) }}</td>
                      <td>{{ $product->product_price }}Tk</td>
                      <td>{{ $product->created_at->format('d-M-y h:i:s a') }}</td>
                      <td>
                        <a type="button" class="btn btn-sm btn-danger" href="{{ url('product/delete') }}/{{ $product->id }}">Del</a>
                        <a type="button" class="btn btn-sm btn-info" href="{{ url('product/edit') }}/{{ $product->id }}">edit</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $products->links() }}
            </div>
            <div class="col-md-12">
              <h3>Deleted Product List</h3>
              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($deleted_products as $deleted_product)
                    <tr>
                      <td>{{ $deleted_product->id }}</td>
                      <td>{{ title_case($deleted_product->product_name) }}</td>
                      <td>{{ $deleted_product->product_price }}Tk</td>
                      <td>
                        <a type="button" class="btn btn-sm btn-info" href="{{ url('product/restore') }}/{{ $deleted_product->id }}">Restore</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $products->links() }}
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
