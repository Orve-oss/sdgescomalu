@extends('admin.layout')


@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">


                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Clients</a></li>
                                <li class="breadcrumb-item active">Edition</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 m-auto">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Editer un client</h4>
                            <form action="{{route('clients.update')}}" method="POST">
                                @csrf
                               
                                <input type="hidden" name="id" value="{{ $client->id }}">
                                <div class="row mb-3">
                                    <label for="example-search-input" class="col-sm-2 col-form-label">Raison Sociale </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="Rais_Soc" value="{{$client->Rais_Soc}}" type="search" placeholder="How do I shoot web" id="example-search-input">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-search-input" class="col-sm-2 col-form-label">Contact </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="Contact" value="{{$client->Contact}}" type="search" placeholder="How do I shoot web" id="example-search-input">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-search-input" class="col-sm-2 col-form-label">Adresse </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="Adresse" value="{{$client->Adresse}}" type="search" placeholder="How do I shoot web" id="example-search-input">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-date-input" class="col-sm-2 col-form-label">Date de creation</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" name="created_date" value="{{$client->created_date}}" id="example-date-input">
                                    </div>
                                </div>
                                <div class="row m-auto">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Modifier le client</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

@endsection
