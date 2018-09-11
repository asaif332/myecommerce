@extends('layouts.app')
@section('content')

<div class="card col-md-6 offset-md-3 p-0">
  <div class="card-header text-center bg-secondary text-white"> Add Product</div>
  <div class="card-body">
    <form class="" action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
      </div>
      <div class="form-group">
        <label for="name">Image</label>
        <input type="file" name="image" class="form-control">
      </div>
      <div class="form-group">
        <label for="name">Price</label>
        <input type="text" name="price" value="{{ old('price') }}" class="form-control">
      </div>
      <div class="form-group">
        <label for="name">Description</label>
        <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
      </div>
      <div class="form-group">
        <input type="submit" name="submit" value="add product" class="btn btn-secondary">
      </div>
    </form>
  </div>
</div>


@endsection
