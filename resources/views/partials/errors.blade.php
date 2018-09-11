@if(session()->has('success'))

  <div class="alert alert-success alert-dismissible fade show" role="alert" style="position:fixed;top:1px;right:1px;z-index:99999999 !important">
    {{ session()->get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@endif
@if(session()->has('error'))


  <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:fixed;top:1px;right:1px;z-index:99999999 !important">
    {{ session()->get('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@endif

@if($errors->any())

  <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:fixed;top:1px;right:1px;z-index:99999999 !important">
    @foreach($errors->all() as $err)
    {{ $err }} <br>
  @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@endif
