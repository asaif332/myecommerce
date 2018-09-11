@extends('layouts.app')

@section('content')
<div class="col-md-8 offset-md-2">
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead>
        <th>image</th>
        <th>name</th>
        <th>price</th>
        <th>actions</th>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr>
          <td>
            <img src="{{ asset($product->image) }}" alt="" width="40px" height="40px">
          </td>
          <td>{{ $product->name }}</td>
          <td>{{ $product->price }}</td>
          <td>
            <a href="{{route('products.edit' , ['id' => $product->id])}}" class="btn btn-sm btn-secondary">edit</a>
            <form class="d-inline" action="{{route('products.destroy' , ['id' => $product->id])}}" method="post">
              {{ csrf_field() }}
              @method('delete')
              <input type="submit" class="btn btn-sm btn-danger" name="delete" value="delete" onclick="
              var yes = confirm('Do you want to delete this product?');
              if(yes){ return true}
              return false;
              ">
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>


@endsection
