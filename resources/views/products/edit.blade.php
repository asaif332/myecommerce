@extends('layouts.app')
@section('content')

<div class="card col-md-6 offset-md-3 p-0">
  <div class="card-header text-center bg-secondary text-white"> Edit Product </div>
  <div class="card-body">
    <form class="" action="{{route('products.update' , ['id' => $product->id])}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      @method('put')
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ $product->name }}" class="form-control">
      </div>
      <div class="form-group">
        <label for="name">Image</label>
        <input type="file" name="image" class="form-control">
      </div>
      <div class="form-group">
        <label for="name">Price</label>
        <input type="text" name="price" value="{{ $product->price }}" class="form-control">
      </div>
      <div class="form-group">
        <label for="name">Description</label>
        <textarea name="description" rows="4" class="form-control">{{ $product->description }}</textarea>
      </div>
      <div class="form-group">
        <input type="submit" name="submit" value="Edit product" class="btn btn-secondary">
      </div>
    </form>
  </div>
</div>


@endsection
