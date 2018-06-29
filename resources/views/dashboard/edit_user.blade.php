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
                        <i class="fa fa-dashboard"></i> <a href="{{ action('DashboardController@index') }}">Tableau de bord</a> > <i class="fa fa-users"></i> <a href="{{ action('DashboardController@users') }}">Gestion des utilisateurs</a> > <i class="fa fa-user"></i> Edition d'un utilisateur
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <h2>Edition d'un utilisateur</h2>
                <div class="table-responsive">
                    {!! Form::model($user, array('action' => 'DashboardController@save_user', 'role' => 'form')) !!}
                        {!! Form::hidden('id') !!}
                        <div class="form-group">
                            <label>Nom</label>
                            {!! Form::text('nom', old('nom'), array('class' => "form-control", "placeholder" => "Nom")) !!}
                        </div>
                        <div class="form-group">
                            <label>Prénom</label>
                            {!! Form::text('prenom', old('prenom'), array('class' => "form-control", "placeholder" => "Prénom")) !!}
                        </div>
                    <div class="form-group">
                        <label>Société</label>
                        {!! Form::text('societe', old('societe'), array('class' => "form-control", "placeholder" => "Société")) !!}
                    </div>
                        <div class="form-group">
                            <label>Numéro de téléphone VISIORANK</label>
                            {!! Form::text('telephone', old('telephone'), array('class' => "form-control", "placeholder" => "Numéro de téléphone VISIORANK")) !!}
                        </div>
                        <div class="form-group">
                            <label>Site Google Analytics</label>
                            {!! Form::select('analytics', $profiles, old('analytics'), array('class' => "form-control")) !!}
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            {!! Form::text('email', old('email'), array('class' => "form-control", "placeholder" => "Email")) !!}
                        </div>
                    <div class="form-group">
                        <label>Mot de passe IMAP</label>
                        {!! Form::text('imap', old('imap'), array('class' => "form-control", "placeholder" => "Mot de passe IMAP")) !!}
                    </div>
                        <div class="form-group">
                            <label>Mot de passe</label>
                            {!! Form::password('password', array('class' => "form-control", "placeholder" => "Mot de passe")) !!}
                        </div>
                        <button class="btn btn-default" type="submit">Enregistrer</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@stop