@extends('layouts.master')
@section('title')
Dashboard
@endsection
@section('main-content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-12 ">
            <span class="text-right">Welcom, <b>{{ session('userInfo')->name }}</b>!</span>
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success flash-message" role="alert">{{ Session::get('success') }}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger flash-message" role="alert">{{ Session::get('error') }}</div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">Consignments</div>
                        <div class="col-lg-6 d-flex flex-row-reverse "><a href="{{ route('consignment_create') }}" class="btn btn-sm btn-success">Add consignment </a></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th scope="col">S.no</th>
                              <th scope="col">Company</th>
                              <th scope="col">Contact</th>
                              <th scope="col">Addressline 1</th>
                              <th scope="col">Addressline 2</th>
                              <th scope="col">Addressline 3</th>
                              <th scope="col">Country</th>
                              <th scope="col">City</th>
                            </tr>
                          </thead>
                          @foreach($consignmentData as $key => $consginment)
                          <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $consginment->company }}</td>
                            <td>{{ $consginment->contact }}</td>
                            <td>{{ $consginment->addressline1 }}</td>
                            <td>{{ $consginment->addressline2 }}</td>
                            <td>{{ $consginment->addressline3 }}</td>
                            <td>{{ $consginment->country }}</td>
                            <td>{{ $consginment->city }}</td>
                        </tr>
                         @endforeach
                        </table>
                      </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-secondary btn-sm" href="{{ route('export_pdf') }}">Export Consignments</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection