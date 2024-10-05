@extends('admin.layout')

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Liste</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Manage Customers</a></li>
                                    <li class="breadcrumb-item active">Liste des clients</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Liste des clients</h4>

                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Raison sociale</th>
                                            <th>Contact</th>
                                            <th>Adresse</th>
                                            <th>Actif</th>
                                            <th>Created date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $key => $client)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $client->Rais_soc }}</td>
                                                <td>{{ $client->Contact }}</td>
                                                <td>{{ $client->Adresse }}</td>
                                                <td>{{ $client->Actif }}</td>
                                                <td>{{ $client->created_date }}</td>
                                                <td>
                                                    <a href="#" type="button"
                                                        class="btn btn-success waves-effect waves-light"><i
                                                            class="ri-pencil-line align-middle ms-2"></a>
                                                    <a href="#" type="button"
                                                        class="btn btn-success waves-effect waves-light"><i
                                                            class="ri-trash-line align-middle ms-2"></a>

                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
@endsection
