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
                                <div class="col-sm-6 col-md-4 col-xl-3">
                                    <div class="my-4 text-center">

                                        <!-- Small modal -->
                                        <a href="" type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add</a>
                                        {{-- <a href="{{ route('clients.create') }}" type="button" class="btn btn-primary w-xs waves-effect waves-light">Add</a> --}}
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Creer un nouveau client</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="needs-validation" action="/clients/ajout" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label for="validationCustom01" class="form-label">Raison sociale :</label>
                                                                    <input type="text" class="form-control" id="validationCustom01"
                                                                        placeholder="Entrez la raison sociale" name="Rais_Soc" required>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label for="validationCustom01" class="form-label">Contact :</label>
                                                                    <input type="text" class="form-control" id="validationCustom01"
                                                                        placeholder="Entrez le contact" name="Contact" required>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label for="validationCustom01" class="form-label">Adresse :</label>
                                                                    <input type="text" class="form-control" id="validationCustom01"
                                                                        placeholder="Entrez l'adresse" name="Adresse" required>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Ajouter</button>
                                                        </div>

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>



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
                                                <td>{{ $client->Rais_Soc }}</td>
                                                <td>{{ $client->Contact }}</td>
                                                <td>{{ $client->Adresse }}</td>
                                                <td>{{ $client->Actif }}</td>
                                                <td>{{ $client->created_date }}</td>
                                                <td>
                                                    <a href="{{ route('clients.edit', $client->id)}}" type="button"
                                                        class="btn btn-primary waves-effect waves-light"><i
                                                            class="ri-pencil-line "></i></a>
                                                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?')" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger waves-effect waves-light">
                                                                    <i class="ri-close-line"></i>
                                                                </button>
                                                            </form>


                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                                {{-- <a href="" type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add</a> --}}
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
@endsection
