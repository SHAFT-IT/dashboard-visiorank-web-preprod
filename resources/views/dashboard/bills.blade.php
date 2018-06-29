@extends('layouts.main')

@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Liste des factures <small>VISIORANK</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> <a href="{{ action('DashboardController@index') }}">Tableau de bord</a> > <i class="fa fa-money"></i> Liste des factures
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <h2>Liste de vos factures</h2>
                <div class="table-responsive">
                    @if(Auth::user()->type == 1)
                    <p><a href="{{ action('DashboardController@add_bill') }}" class="btn btn-primary">Ajouter une facture</a></p>
                    @endif
                    @if($user)
                    <table class="table table-responsive table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($user->bills as $bill)
                            <tr>
                                <td>{{ $bill->filename }}</td>
                                <td>{{ date('d/m/Y à H:i', strtotime($bill->created_at)) }}</td>
                                <td><a target="_blank" href="{{ action('DashboardController@get_bill', array('filename' => $bill->filename)) }}"><span class="fa fa-download"></span></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@stop