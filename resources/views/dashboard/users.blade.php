@extends('layouts.main')

@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestion des utilisateurs <small>VISIORANK</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> <a href="{{ action('DashboardController@index') }}">Tableau de bord</a> > <i class="fa fa-users"></i> Gestion des utilisateurs
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <h2>Liste des utilisateurs</h2>
                <div class="table-responsive">
                    <p><a href="{{ action('DashboardController@edit_user') }}" class="btn btn-primary">Ajouter un utilisateur</a></p>
                    <table class="table table-responsive table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Société</th>
                                <th>Numéro VISIORANK</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>{{ $user->nom }}</td>
                                <td>{{ $user->prenom }}</td>
                                <td>{{ $user->societe }}</td>
                                <td>{{ $user->telephone }}</td>
                                <td>{{ $user->email }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ action('DashboardController@edit_user', array('id' => $user->id)) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>&nbsp;
                                    <a href="">
                                        <script type="text/javascript">
                                            $(function () {
                                                $(".deleteUser_{{$user->id}}").click(function () {
                                                    if(confirm("Etes-vous sur de vouloir supprimer cet utilisateur ?")){
                                                        window.location.href = "{{ action('DashboardController@delete_user', array('id' => $user->id)) }}";
                                                    }
                                                    return false;
                                                });
                                            });
                                        </script>
                                        <i class="fa fa-trash deleteUser_{{$user->id}}"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Il n'y a pas d'utilisateur dans le système</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@stop