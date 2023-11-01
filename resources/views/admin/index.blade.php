@extends('layouts.adminLayout')
@section('title', 'Tableau de bord')
@section('content')
    @if (Auth::user()->hasRole(1))
        @switch($temp)
            @case(1)
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <!-- [ breadcrumb ] start -->
                                        <div class="page-header">
                                            <div class="page-block">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <div class="page-header-title">
                                                            <h5>Accueil</h5>
                                                        </div>
                                                        <ul class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="index.blade.php"><i
                                                                        class="feather icon-home"></i></a></li>
                                                            <li class="breadcrumb-item"><a href="#!">Tableau de bord</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- [ breadcrumb ] end -->
                                        <!-- [ Main Content ] start -->
                                        <div class="row">

                                            <!-- product profit start -->
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card prod-p-card bg-c-red">
                                                    <div class="card-body">
                                                        <div class="row align-items-center m-b-25">
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-white">Entreprises</h6>
                                                                <h3 class="m-b-0 text-white">
                                                                    @if (isset($entreprises))
                                                                        <h3 class="m-b-0 text-white">{{ count($entreprises) }}</h3>
                                                                    @else
                                                                        <p>No data.</p>
                                                                    @endif
                                                                </h3>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-building"></i>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card prod-p-card bg-c-blue">
                                                    <div class="card-body">
                                                        <div class="row align-items-center m-b-25">
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-white">Stagiaires</h6>
                                                                <h3 class="m-b-0 text-white">
                                                                    @if (isset($stg))
                                                                        <h3 class="m-b-0 text-white">{{ count($stg) }}</h3>
                                                                    @else
                                                                        <p>No data.</p>
                                                                    @endif

                                                                </h3>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-user-graduate"></i>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card prod-p-card bg-c-green">
                                                    <div class="card-body">
                                                        <div class="row align-items-center m-b-25">
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-white">Stagiaires inscrits</h6>
                                                                <h3 class="m-b-0 text-white">
                                                                    @if (isset($loginaction))
                                                                        <h3 class="m-b-0 text-white">{{ count($loginaction) }}</h3>
                                                                    @else
                                                                        <p>Not data.</p>
                                                                    @endif
                                                                </h3>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-user-plus"></i>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card prod-p-card bg-c-yellow">
                                                    <div class="card-body">
                                                        <div class="row align-items-center m-b-25">
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-white">Entretiens</h6>
                                                                <h3 class="m-b-0 text-white">
                                                                    @if (isset($Entretien))
                                                                        <h3 class="m-b-0 text-white">{{ count($Entretien) }}</h3>
                                                                    @else
                                                                        <p>Not data.</p>
                                                                    @endif
                                                                </h3>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-briefcase"></i>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            @include('admin/TableStg', ['action' => 1])

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @break

            {{-- part admin --}}
            @case(2)
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <!-- [ breadcrumb ] start -->
                                        <div class="page-header">
                                            <div class="page-block">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <div class="page-header-title">
                                                            <h5>Space</h5>
                                                        </div>
                                                        <ul class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="index.blade.php"><i
                                                                        class="feather icon-home"></i></a></li>
                                                            <li class="breadcrumb-item"><a href="#!">Ajouter Admin</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('alert'))
                                            <div class="alert {{ $errors->first('style') }}">{{ $errors->first('alert') }}</div>
                                        @endif
                                        <div class="row">
                                            <div class="offset col-3"></div>
                                            <form method="POST" class="col-6" action="{{ route('admin.ajouter.add_A') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name"
                                                        placeholder="Enter Admin Name" name="name">
                                                    @error('name')
                                                        <bold class="text-danger">{{ $message }}</bold>
                                                    @enderror

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Password</label>
                                                    <input type="password" class="form-control" id="exampleInputPassword1"
                                                        placeholder="Password" name="password">
                                                    @error('password')
                                                        <bold class="text-danger">{{ $message }}</bold>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="role">Role</label>
                                                    <select class="form-select" name="role" id="role">
                                                        <option value="0" selected>Coordonateur</option>
                                                        <option value="1">Administrateur</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn mt-3 btn-primary">Ajouter</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @break

            {{-- part entreprises --}}
            @case(3)
                <div class="pcoded-main-container text-capitalize">
                    <div class="pcoded-wrapper">
                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <!-- [ breadcrumb ] start -->
                                        <div class="page-header">
                                            <div class="page-block">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <div class="page-header-title">
                                                            <h5>Space</h5>
                                                        </div>
                                                        <ul class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="index.blade.php"><i
                                                                        class="feather icon-home"></i></a></li>
                                                            <li class="breadcrumb-item"><a>Ajouter entreprises</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('alert'))
                                            <div class="alert {{ $errors->first('style') }}">{{ $errors->first('alert') }}</div>
                                        @endif

                                        <form method="POST" action="{{ route('admin.ajouter.add_E') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="raisonsociale">Raison sociale :</label>
                                                        <input type="text" class="form-control" id="raisonsociale"
                                                            value="{{ old('raisonsociale') }}" placeholder="raison sociale"
                                                            name="raisonsociale">
                                                        @error('raisonsociale')
                                                            <bold class="text-danger">{{ $message }}</bold>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="raisonabregee">Raison abregee :</label>
                                                        <input type="text" class="form-control" id="raisonabregee"
                                                            value="{{ old('raisonabregee') }}" placeholder="Raison abregee"
                                                            name="raisonabregee">
                                                        @error('raisonabregee')
                                                            <bold class="text-danger">{{ $message }}</bold>
                                                        @enderror

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="representant">Representant :</label>
                                                        <input type="text" class="form-control" id="representant"
                                                            value="{{ old('representant') }}" placeholder="Representant"
                                                            name="representant">
                                                        @error('representant')
                                                            <bold class="text-danger">{{ $message }}</bold>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email :</label>
                                                        <input type="email" class="form-control" id="email"
                                                            value="{{ old('email') }}" placeholder="example@mail.com"
                                                            name="email">
                                                        @error('email')
                                                            <bold class="text-danger">{{ $message }}</bold>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="web">site web :</label>
                                                        <input type="url" class="form-control" id="web"
                                                            value="{{ old('web') }}" placeholder="https://www.yourdomain.com"
                                                            name="web">
                                                        @error('web')
                                                            <bold class="text-danger">{{ $message }}</bold>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="logo">Logo :</label>
                                                        <input type="url" class="form-control" id="logo"
                                                            value="{{ old('logo') }}" placeholder="https://www.yourdomain.com"
                                                            name="logo">
                                                        @error('logo')
                                                            <bold class="text-danger">{{ $message }}</bold>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="stand">Stand :</label>
                                                        <input type="number" class="form-control" id="stand"
                                                            value="{{ old('stand') }}" placeholder="stand" name="stand">
                                                        @error('stand')
                                                            <bold class="text-danger">{{ $message }}</bold>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>


                                            <button type="submit" class="mt-3 btn btn-primary">Ajouter</button>
                                        </form>

                                        <hr class="my-5">
                                        <div>
                                            <div class="wrapper_upload">
                                                @if ($errors->has('backupAlert'))
                                                    <div class="alert {{ $errors->first('style') }} mb-3">
                                                        {{ $errors->first('backupAlert') }}
                                                    </div>
                                                @endif
                                                <div class="container_upload">
                                                    <h1>Upload a file</h1>
                                                    <form action="{{ route('admin.backup.importEntreprises') }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <label for="upETAB" class="upload-container_upload">
                                                            <div class="border-container_upload">
                                                                <div class="icons_upload fa-4x">
                                                                    <i class="fas fa-file-csv"
                                                                        data-fa-transform="shrink-3 down-2 right-6 rotate-45"></i>
                                                                </div>
                                                                <p>Drag and drop files here, or
                                                                    <a href="#" id="file-browser_upload">browse</a> your
                                                                    computer.
                                                                </p>
                                                            </div>
                                                        </label>
                                                        <input type="file" name="file" accept=".csv" id="upETAB" class="d-none">
                                                        @error('file')
                                                            <br>
                                                            <span style="color: red">
                                                                <i class="fas fa-exclamation-circle"></i>
                                                                {{ $message }}</span>
                                                        @enderror
                                                        <div class="button-container">
                                                            <button class="w-25 btn btn-primary btn-lg btn-radius mt-4">
                                                                <i class="fas fa-cloud-upload-alt"></i> import</button>
                                                    </form>
                                                    <a href="{{ route('admin.backup.exportEntreprises') }}"
                                                        class="w-25 btn btn-primary btn-lg btn-radius mt-4">
                                                        <i class="fas fa-cloud-download-alt"></i> Export</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            @break

            {{-- part Stagiaires --}}
            @case(5)
                <div class="pcoded-main-container text-capitalize">
                    <div class="pcoded-wrapper">
                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <!-- [ breadcrumb ] start -->
                                        <div class="page-header">
                                            <div class="page-block">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <div class="page-header-title">
                                                            <h5>Space</h5>
                                                        </div>
                                                        <ul class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="index.blade.php"><i
                                                                        class="feather icon-home"></i></a></li>
                                                            <li class="breadcrumb-item"><a>Ajouter Stagiaire</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('alert'))
                                            <div class="alert {{ $errors->first('style') }}">{{ $errors->first('alert') }}</div>
                                        @endif
                                        <form method="POST" action="{{ route('admin.ajouter.add_S') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="matricule">matricule :</label>
                                                        <input type="number" class="form-control" id="matricule"
                                                            value="{{ old('matricule') }}" placeholder="matricule"
                                                            name="matricule">
                                                        @error('matricule')
                                                            <bold class="text-danger">{{ $message }}</bold>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="cin">cin :</label>
                                                        <input type="text" class="form-control" id="cin"
                                                            value="{{ old('cin') }}" placeholder="cin" name="cin">
                                                        @error('cin')
                                                            <bold class="text-danger">{{ $message }}</bold>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nom">nom :</label>
                                                        <input type="text" class="form-control" id="nom"
                                                            value="{{ old('nom') }}" placeholder="nom" name="nom">
                                                        @error('nom')
                                                            <bold class="text-danger">{{ $message }}</bold>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="prenom">prénom :</label>
                                                        <input type="test" class="form-control" id="prenom"
                                                            value="{{ old('prenom') }}" placeholder="prenom" name="prenom">
                                                        @error('prenom')
                                                            <bold class="text-danger">{{ $message }}</bold>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="dateNaissance">dateNaissance :</label>
                                                        <input type="date" class="form-control" id="dateNaissance"
                                                            value="{{ old('dateNaissance') }}" placeholder="YY-MM-DD"
                                                            name="dateNaissance">
                                                        @error('dateNaissance')
                                                            <bold class="text-danger">{{ $message }}</bold>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">email :</label>
                                                        <input type="email" class="form-control" id="email"
                                                            value="{{ old('email') }}" placeholder="email" name="email">
                                                        @error('email')
                                                            <bold class="text-danger">{{ $message }}</bold>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="telephone">telephone :</label>
                                                        <input type="number" class="form-control" id="telephone"
                                                            value="{{ old('telephone') }}" placeholder="telephone"
                                                            name="telephone">
                                                        @error('telephone')
                                                            <bold class="text-danger">{{ $message }}</bold>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="filiere">filiere :</label>
                                                        <input type="text" class="form-control" id="filiere"
                                                            value="{{ old('filiere') }}" placeholder="filiere" name="filiere">
                                                        @error('filiere')
                                                            <bold class="text-danger">{{ $message }}</bold>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="stg">Sexe</label>
                                                        <select class="form-select mt-2" id="stg" name="sexe">
                                                            <option selected value="F">Femme</option>
                                                            <option value="H">Homme</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="GFGDataList" class="form-label">
                                                            etablissement
                                                        </label>

                                                        <input class="form-control" list="GFGOptions" id="GFGDataList"
                                                            placeholder="Etablissement">
                                                        <datalist id="GFGOptions">
                                                            @foreach ($etabs as $etab)
                                                                <option value="{{ $etab->nom }}">
                                                            @endforeach

                                                        </datalist>

                                                    </div>
                                                </div>
                                            </div>


                                            {{-- <input type="number" class="d-none" value="1" name="role"> --}}
                                            <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
                                        </form>

                                        <hr class="my-5">
                                        <div>
                                            <div class="wrapper_upload">
                                                @if ($errors->has('backupAlert'))
                                                    <div class="alert {{ $errors->first('style') }} mb-3">
                                                        {{ $errors->first('backupAlert') }}
                                                    </div>
                                                @endif
                                                <div class="container_upload">
                                                    <h1>Upload a file</h1>
                                                    <form action="{{ route('admin.backup.importStagiaires') }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <label for="upETAB" class="upload-container_upload">
                                                            <div class="border-container_upload">
                                                                <div class="icons_upload fa-4x">
                                                                    <i class="fas fa-file-csv"
                                                                        data-fa-transform="shrink-3 down-2 right-6 rotate-45"></i>
                                                                </div>
                                                                <p>Drag and drop files here, or
                                                                    <a href="#" id="file-browser_upload">browse</a>
                                                                    your
                                                                    computer.
                                                                </p>
                                                            </div>
                                                        </label>
                                                        <input type="file" name="file" accept=".csv" id="upETAB" class="d-none">
                                                        @error('file')
                                                            <br>
                                                            <span style="color: red">
                                                                <i class="fas fa-exclamation-circle"></i>
                                                                {{ $message }}</span>
                                                        @enderror
                                                        <div class="button-container">
                                                            <button class="w-25 btn btn-primary btn-lg btn-radius mt-4">
                                                                <i class="fas fa-cloud-upload-alt"></i> import</button>
                                                    </form>
                                                    <a href="{{ route('admin.backup.exportStagiaires') }}"
                                                        class="w-25 btn btn-primary btn-lg btn-radius mt-4">
                                                        <i class="fas fa-cloud-download-alt"></i> Export</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @break

            {{-- part Etablissements --}}
            @case(6)
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <!-- [ breadcrumb ] start -->
                                        <div class="page-header">
                                            <div class="page-block">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <div class="page-header-title">
                                                            <h5>Space</h5>
                                                        </div>
                                                        <ul class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="index.blade.php"><i
                                                                        class="feather icon-home"></i></a></li>
                                                            <li class="breadcrumb-item"><a href="#!">Ajouter
                                                                    etablissement</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('alert'))
                                            <div class="alert {{ $errors->first('style') }}">{{ $errors->first('alert') }}</div>
                                        @endif
                                        <div class="row">
                                            <div class="offset col-3"></div>
                                            <form class="col-6" method="POST" action="{{ route('admin.ajouter.add_Etab') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nom">Etablissement</label>
                                                    <input type="text" class="form-control" id="nom"
                                                        placeholder="Nom abregee" name="nom">
                                                    @error('nom')
                                                        <bold class="text-danger">{{ $message }}</bold>
                                                    @enderror

                                                </div>
                                                <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
                                            </form>
                                        </div>
                                        <hr class="my-5">
                                        <div>
                                            <div class="wrapper_upload">
                                                @if ($errors->has('backupAlert'))
                                                    <div class="alert {{ $errors->first('style') }} mb-3">
                                                        {{ $errors->first('backupAlert') }}
                                                    </div>
                                                @endif
                                                <div class="container_upload">
                                                    <h1>Upload a file</h1>
                                                    <form action="{{ route('admin.backup.importEtablissements') }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <label for="upETAB" class="upload-container_upload">
                                                            <div class="border-container_upload">
                                                                <div class="icons_upload fa-4x">
                                                                    <i class="fas fa-file-csv"
                                                                        data-fa-transform="shrink-3 down-2 right-6 rotate-45"></i>
                                                                </div>
                                                                <p>Drag and drop files here, or
                                                                    <a href="#" id="file-browser_upload">browse</a>
                                                                    your
                                                                    computer.
                                                                </p>
                                                            </div>
                                                        </label>
                                                        <input type="file" name="file" accept=".csv" id="upETAB"
                                                            class="d-none">
                                                        @error('file')
                                                            <br>
                                                            <span style="color: red">
                                                                <i class="fas fa-exclamation-circle"></i>
                                                                {{ $message }}</span>
                                                        @enderror
                                                        <div class="button-container">
                                                            <button class="w-25 btn btn-primary btn-lg btn-radius mt-4">
                                                                <i class="fas fa-cloud-upload-alt"></i> import</button>
                                                    </form>
                                                    <a href="{{ route('admin.backup.exportEtablissements') }}"
                                                        class="w-25 btn btn-primary btn-lg btn-radius mt-4">
                                                        <i class="fas fa-cloud-download-alt"></i> Export</a>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @break

            {{-- analyse --}}
            @case(7)
                <style>
                    @media (min-width: 768px) {
                        .table-card .col-md-6 {
                            width: 60%;
                        }
                    }
                </style>
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <!-- [ breadcrumb ] start -->
                                        <div class="page-header">
                                            <div class="page-block">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <div class="page-header-title">
                                                            <h5>Home</h5>
                                                        </div>
                                                        <ul class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="index.blade.php"><i
                                                                        class="feather icon-home"></i></a></li>
                                                            <li class="breadcrumb-item"><a href="#">Analyse</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- [ breadcrumb ] end -->
                                        <!-- [ Main Content ] start -->
                                        <div class="row">
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card prod-p-card bg-c-blue">
                                                    <div class="card-body">
                                                        <div class="row align-items-center m-b-25">
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-white">Total</h6>
                                                                <h3 class="m-b-0 text-white">
                                                                    <h3 class="m-b-0 text-white">{{ $stagiaires }}</h3>
                                                                </h3>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-user-graduate"></i>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card prod-p-card bg-c-blue">
                                                    <div class="card-body">
                                                        <div class="row align-items-center m-b-25">
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-white ">Non confirmé</h6>
                                                                <h3 class="m-b-0 text-white">
                                                                    <h3 class="m-b-0 text-white">{{ count($stgNotConfirmed) }}
                                                                    </h3>
                                                                </h3>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-user-graduate"></i>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card prod-p-card bg-c-blue">
                                                    <div class="card-body">
                                                        <div class="row align-items-center m-b-25">
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-white">Inscrits</h6>
                                                                <h3 class="m-b-0 text-white">
                                                                    <h3 class="m-b-0 text-white">{{ count($stgConfirmed) }}</h3>
                                                                </h3>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-user-graduate"></i>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card prod-p-card bg-c-blue">
                                                    <div class="card-body">
                                                        <div class="row align-items-center m-b-25">
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-white">participants</h6>
                                                                <h3 class="m-b-0 text-white">
                                                                    <h3 class="m-b-0 text-white">{{ $attended }}</h3>
                                                                </h3>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-user-graduate"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- row --}}
                                        <div class="row">
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card prod-p-card bg-c-blue">
                                                    <div class="card-body">
                                                        <div class="row align-items-center m-b-25">
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-white">Entreprises</h6>
                                                                <h3 class="m-b-0 text-white">
                                                                    <h3 class="m-b-0 text-white">{{ $entreprises }}</h3>
                                                                </h3>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-building"></i>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-xl-3 col-md-6">
                                                <div class="card prod-p-card bg-c-blue">
                                                    <div class="card-body">
                                                        <div class="row align-items-center m-b-25">
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-white">Entretiens</h6>
                                                                <h3 class="m-b-0 text-white">
                                                                    <h3 class="m-b-0 text-white">{{ $entretiens }}</h3>
                                                                </h3>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-briefcase"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- data --}}

                                        @include('admin/TableEntretien')
                                        @include('admin/TableEfp')
                                        @include('admin/TableStg', [
                                            'stg' => $stgConfirmed,
                                            'title' => 'List nominative des participants',
                                            'temp' => true,
                                        ])
                                        @include('admin/tableStg', [
                                            'stg' => $stgNotConfirmed,
                                            'title' => 'List nominative des stagiaires qui n\'ont pas confirmé',
                                            'temp' => false,
                                        ])

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @break

            @case(8)
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <!-- [ breadcrumb ] start -->
                                        <div class="page-header">
                                            <div class="page-block">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <div class="page-header-title">
                                                            <h5>Box</h5>
                                                        </div>
                                                        <ul class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="index.blade.php"><i
                                                                        class="feather icon-home"></i></a></li>
                                                            <li class="breadcrumb-item"><a href="#!">List Messages</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <section>
                                            <div class="container my-5 py-5 text-dark">
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-md-12 col-lg-10 col-xl-8">
                                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                                            <h4 class="text-dark mb-0">Unread comments ({{ count($msgs) }})</h4>
                                                            <div class="card">
                                                                <div class="card-body p-2 d-flex align-items-center">
                                                                    <h6 class="text-primary fw-bold small mb-0 me-1">Comments "ON"
                                                                    </h6>
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="flexSwitchCheckChecked" checked />
                                                                        <label class="form-check-label"
                                                                            for="flexSwitchCheckChecked"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @foreach ($msgs as $msg)
                                                            @if (isset($msg))
                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <div class="d-flex flex-start">
                                                                            <img class="rounded-circle shadow-1-strong me-3"
                                                                                src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(26).webp"
                                                                                alt="avatar" width="40" height="40" />
                                                                            <div class="w-100">
                                                                                <div
                                                                                    class="d-flex justify-content-between align-items-center mb-3">
                                                                                    <b class="text-primary fw-bold mb-0">
                                                                                        <span class="text-dark">
                                                                                            {{ $msg->title }} </span><br>
                                                                                        <strong>{{ $msg->name }}</strong>
                                                                                    </b>

                                                                                    <p class="mb-0"> {{ $msg->created_at }}</p>
                                                                                </div>
                                                                                <div
                                                                                    class="d-flex justify-content-between align-items-center">
                                                                                    <p class="small mb-0" style="color: #aaa;">
                                                                                        <a href="#!"
                                                                                            class="link-grey">Remove</a> •
                                                                                        <a href="#!"
                                                                                            class="link-grey">Reply</a> •
                                                                                    </p>
                                                                                    <div class="d-flex flex-row">
                                                                                        <i
                                                                                            class="fas fa-star text-warning me-2"></i>
                                                                                        <i class="far fa-check-circle"
                                                                                            style="color: #aaa;"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach



                                                        {{-- <div class="card mb-3">
                                                            <div class="card-body">
                                                                <div class="d-flex flex-start">
                                                                    <img class="rounded-circle shadow-1-strong me-3"
                                                                        src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(21).webp"
                                                                        alt="avatar" width="40" height="40" />
                                                                    <div class="w-100">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center mb-3">
                                                                            <h6 class="text-primary fw-bold mb-0">
                                                                                the_sylvester_cat
                                                                                <span class="text-dark ms-2">Loving your work and
                                                                                    profile! </span>
                                                                            </h6>
                                                                            <p class="mb-0">3 days ago</p>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <p class="small mb-0" style="color: #aaa;">
                                                                                <a href="#!" class="link-grey">Remove</a> •
                                                                                <a href="#!" class="link-grey">Reply</a> •
                                                                                <a href="#!" class="link-grey">Translate</a>
                                                                            </p>
                                                                            <div class="d-flex flex-row">
                                                                                <i class="far fa-check-circle text-primary"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}

                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @break
        @endswitch
    @else
        <style>
            .main__alert {
                position: fixed;
                top: 50%;
                left: 50%;
                translate: -50% -50%;
            }
        </style>
        <div class="main__alert">
            <h2>
                Veuillez scanner un code QR!
            </h2>

        </div>
    @endif
@endsection
