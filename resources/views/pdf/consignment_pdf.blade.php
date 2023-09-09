<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
    <body>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">Consignments List</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>S.no</th>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Addressline 1</th>
                            <th>Addressline 2</th>
                            <th>Addressline 3</th>
                            <th>Country</th>
                            <th>City</th>
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
            </div>
        </div>
    </body>
</html>