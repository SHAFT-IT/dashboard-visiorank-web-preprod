@extends('layouts.main')

@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Tableau de bord <small>VISIORANK</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Tableau de bord
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- /.row -->

        @if(Auth::user()->type == 0 || session()->get('user', 0) || Auth::user()->type == 99)

        <div class="row">
            <div class="col-lg-4 col-md-6" style="width: 25% !important;">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <a href="{{ action('DashboardController@stats') }}">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-bar-chart fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $visits }}</div>
                                <div>Visites</div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <a href="{{ action('DashboardController@stats') }}">
                        <div class="panel-footer">
                            <span class="pull-left">Voir les détails</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" style="width: 25% !important;">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <a href="{{ action('DashboardController@calls') }}">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-phone fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ count($calls) }}</div>
                                <div>Appels</div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <a href="{{ action('DashboardController@calls') }}">
                        <div class="panel-footer">
                            <span class="pull-left">Voir les détails</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" style="width: 25% !important;">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <a href="{{ action('DashboardController@messages') }}">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-envelope fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $messages }}</div>
                                <div>Message(s) non lu(s)</div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <a href="{{ action('DashboardController@messages') }}">
                        <div class="panel-footer">
                            <span class="pull-left">Voir les détails</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" style="width: 25% !important;">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <a href="{{ action('ServiceDeskController@ticket') }}">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-ticket fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ $demande }}</div>
                                    <div>Demandes</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <a href="{{ action('ServiceDeskController@ticket') }}">
                        <div class="panel-footer">
                            <span class="pull-left">Voir les détails</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        @endif

    </div>
    <!-- /.container-fluid -->

@stop