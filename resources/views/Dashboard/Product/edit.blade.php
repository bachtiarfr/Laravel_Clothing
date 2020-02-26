@extends('Dashboard.layouts.app')

@section('content')
<section class="pb-4">
        <div class="container-fluid">
          <form action="{{url('Dashboard/Products/update')}}/{{$product->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-6">
                <div class="card border-info">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="code_product">Code Product</label>
                      <input type="text" class="form-control" name="code" id="code" 
                      value="{{$product->code}}"
                      placeholder="Masukan Code Product">
                      @error("code")
                        <div class="badge badge-danger"><small>{{$message}}</small></div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="nama_product">Name</label>
                      <input type="text" class="form-control" name="name" id="name" 
                      value="{{$product->name}}"
                      placeholder="Masukan Nama Product">
                      @error("name")
                        <div class="badge badge-danger"><small>{{$message}}</small></div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="nama_product">Categorie</label>
                      <select name="categorie_id" class="form-control" id="">
                          <option selected value="{{$product->categorie_id}}">{{$product->categorie_id}}</option>
                          @foreach ($list_categorie as $item)
                          <option value="{{$item->id}}">{{$item->id}}({{$item->name}})</option>
                          @endforeach
                      </select>
                      @error("name")
                        <div class="badge badge-danger"><small>{{$message}}</small></div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="card border-info">
                  <div class="card-body">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-8">
                          <label for="price">Price</label>
                          <div class="row">
                            <div class="col-md-12">
                              <input type="text" class="form-control" name="price" id="price" aria-describedby="price" 
                                value="{{$product->price}}"
                              placeholder="Masukan Harganya">
                            </div>
                          </div>
                          @error("price")
                            <div class="badge badge-danger"><small>{{$message}}</small></div>
                          @enderror
                        </div>
                        <div class="col-md-4">
                          <label for="stock">Stock</label>
                          <div class="row">
                            <div class="col-md-12">
                              <input type="text" class="form-control" name="stock" id="stock" aria-describedby="stock" 
                              value="{{$product->stock}}"
                              placeholder="Jumlah Stock">
                            </div>
                          </div>
                          @error("stock")
                            <div class="badge badge-danger"><small>{{$message}}</small></div>
                          @enderror
                        </div>
                      </div>
                    </div>                    
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-8">
                            <input type="file" name="image" value="{{$product->image}}" class="form-control-sm" id="image" >
                          &nbsp;&nbsp;<i><small id="cover" class="form-text text-muted mt-0">**Ukuran file cover Maks. 10 MB;.</small></i>
                        </div>
                      </div>
                    </div>
                    
                    <button type="submit" name="btnSimpan" class="btn btn-success btn-lg btn-block">
                        <i class="fa fa-save"></i> SAVE
                      </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </section>
@endsection
