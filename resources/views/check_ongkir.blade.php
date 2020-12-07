@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Check ongkir
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="ongkir" method="POST" action="/submit_check_ongkir">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="control-label col-sm-3">Provinsi:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="province_origin" name="province_origin" required="">
                                    <option value="">--Provinsi-- </option>
                                    @foreach ($provinces as $province => $value)
                                    <option value="{{$province}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Kota Asal:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="city_origin" name="city_origin" required="">
                                    <option>--Kota-- </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Provinsi Tujuan</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="province_destination" name="province_destination" required="">
                                    <option value="">--Provinsi-- </option>
                                    @foreach ($provinces as $province => $value)
                                    <option value="{{$province}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Kota Tujuan</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="city_destination" name="city_destination" required="">
                                <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Kurir</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="courier" name="courier" required="">
                                    <option value="pos">POS INDONESIA</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Berat (Kg)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="weight" name="weight" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-8">
                                <button type="submit" class="btn btn-default">Cek Ongkir</button>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection