@extends('layouts.main')

@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestion des factures <small>VISIORANK</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> <a href="{{ action('DashboardController@index') }}">Tableau de bord</a> > <i class="fa fa-money"></i> <a href="{{ action('DashboardController@bills') }}">Gestion des factures</a> > <i class="fa fa-money"></i> Ajout d'une facture
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <h2>Ajout d'une facture</h2>
                <div class="table-responsive">
                    {!! Form::open(array('action' => 'DashboardController@save_bill', 'role' => 'form', 'files' => true)) !!}
                        <div class="form-group">
                            <label>Utilisateur</label>
                            {!! Form::select('user', $users, old('user'), array('class' => "form-control")) !!}
                        </div>
                        <div class="form-group">
                            <label>Fichier PDF</label>
                            {!! Form::file('facture', array('class' => "form-control")) !!}
                        </div>
                        <button class="btn btn-default" type="submit">Enregistrer</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@stop