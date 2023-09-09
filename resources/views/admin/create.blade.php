@extends('layouts.master')
@section('title')
Dashboard
@endsection
@section('main-content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-12 ">
            <span class="text-right d-flex justify-content-end">{{ session('userInfo')->name }}</span>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Create Consignment
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('consignment_store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" name="company" class="form-control" id="company" placeholder="Enter Company">
                        </div>
                        <div class="form-group">
                            <label for="contact">contact</label>
                            <input type="text" name="contact" class="form-control" id="contact" placeholder="Enter contact">
                        </div>
                        <div class="form-group">
                            <label for="addressline1">Addressline1</label>
                            <input type="text" name="addressline1" class="form-control" id="addressline1" placeholder="Enter addressline1">
                        </div>
                        <div class="form-group">
                            <label for="addressline2">Addressline2</label>
                            <input type="text" name="addressline2" class="form-control" id="addressline2" placeholder="Enter addressline2">
                        </div>
                        <div class="form-group">
                            <label for="addressline3">Addressline3</label>
                            <input type="text" name="addressline3" class="form-control" id="addressline3" placeholder="Enter addressline3">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" name="country" class="form-control" id="country" placeholder="Enter country">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" class="form-control" id="city" placeholder="Enter city">
                        </div>
                        <br>
                        <div class="form-group">
                           <button class="btn btn-success btn-lg">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection