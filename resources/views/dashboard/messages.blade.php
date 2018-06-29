@extends('layouts.main')

@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Liste des messages <small>VISIORANK</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> <a href="{{ action('DashboardController@index') }}">Tableau de bord</a> > <i class="fa fa-envelope"></i> Liste des messages
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        @if($user)
        <div class="row">
            <div class="col-lg-12">
                <h2>Liste des messages pour {{ $user->email }}</h2>
                <div class="table-responsive">
                    <table class="table table-responsive table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Sujet</th>
                                <th>Expéditeur</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            <tr class="{{ $message->seen ? "read" : "unread" }}">
                                <td>{{ isset($message->subject) ? $message->subject : "-" }}</td>
                                <td>{{ $message->from }}</td>
                                <td>{{ date('d/m/Y à H:i:s', $message->udate) }}</td>
                                <td style="text-align: center;"><a href="{{ action('DashboardController@read_message', array('id' => $message->uid)) }}"><i class="fa fa-eye"></i></a>&nbsp;<a href=""><i class="fa fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
        <!-- /.row -->
    </div>
@stop