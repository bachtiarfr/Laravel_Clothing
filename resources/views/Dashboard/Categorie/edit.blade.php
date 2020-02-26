@extends('Dashboard.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <section class="pb-4 mt-2">
                  <div class="container-fluid">
                    <form action="{{url('Dashboard/Categories/update')}}/{{$categorie->id}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                        <div class="form-group row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" value="{{$categorie->name}}" name="name" class="form-control" id="inputPassword" placeholder="Password">
                          </div>
                        </div>
                        <button type="submit" class="btn btn-success">Add</button>
                    </form>
                  </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
