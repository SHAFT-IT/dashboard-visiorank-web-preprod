@extends('layouts.main')

@section('main')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gestion des demandes <small>VISIORANK</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> <a href="{{ action('ServiceDeskController@ticket') }}">Tableau de bord</a> > <i class="fa fa-ticket"></i> Gestion des demandes
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <h2>Recherches</h2>
                <div class="table-responsive" style="overflow-x:visible !important;">
                    {!! Form::model($oTicket, array('action' => 'ServiceDeskController@ticket', 'role' => 'form')) !!}
                    <div class="form-group">

                        <table class="table table-responsive table-bordered table-hover table-striped" style="width:95% !important;">
                            <tr>
                                <td>
                                    <input class="form-control" placeholder="Titre" name="titre" type="text" value="@if(isset($request['titre'])){{$request['titre']}}@endif">
                                </td>
                                <td>
                                    <select id="type" name="type" class="form-control">
                                        <option value="0"> Type de la demande</option>
                                        @foreach($oTypeTicket as $typeTicket)
                                            <option value="{{$typeTicket->type_id}}" @if(isset($request['type']) && $request['type'] != 0 && $request['type'] == $typeTicket->type_id) selected="selected" @endif> {{$typeTicket->libelle}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select id="priorite" name="priorite" class="form-control">
                                        <option value="0"> Priorité de la demande</option>
                                        @foreach($oPrioriteTicket as $prioriteTicket)
                                            <option value="{{$prioriteTicket->priorite_id}}" @if(isset($request['priorite']) && $request['priorite'] != 0 && $request['priorite'] == $prioriteTicket->priorite_id) selected="selected" @endif> {{$prioriteTicket->priorite_libelle}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select id="statut" name="statut" class="form-control">
                                        <option value="0"> Statut de la demande</option>
                                        @foreach($oStatutList as $statutList)
                                            <option value="{{$statutList->statut_id}}" @if(isset($request['statut']) && $request['statut'] != 0 && $request['statut'] == $statutList->statut_id) selected="selected" @endif> {{$statutList->statut_libelle}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <div class="container">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="input-group date" id="date1">
                                                    <input type="text" class="form-control" name="date1" value="@if(isset($request['date1'])){{$request['date1']}}@endif">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="input-group date" id="date2">
                                                    <input type="text" class="form-control" name="date2" value="@if(isset($request['date2'])){{$request['date2']}}@endif">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <button class="btn btn-default" type="submit">Rechercher</button>
                </div>
                <h2>Liste des demandes</h2>
                <div class="table-responsive" style="padding-bottom: 100px;">
                    <p><a href="{{ action('ServiceDeskController@edit_ticket') }}" class="btn btn-primary">Ajouter une demande</a></p>
                    <table class="table table-responsive table-bordered table-hover table-striped" style="font-size:13px;width:95% !important;">
                        <thead>
                            <tr>
                                <th width="20%">Titre</th>
                                <th width="20%">Description</th>
                                <th width="10%">Propriétaire</th>
                                <th style="text-align:center">Type</th>
                                <th width="5%" style="text-align:center">Priorité</th>
                                <th style="text-align:center">Utilisateur</th>
                                <th width="5%" style="text-align:center">Statut</th>
                                <th style="text-align:center">Date de création</th>
                                <th style="text-align:center">Date de modification</th>
                                <th  width="30%" style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($oTicket as $ticket)
                            <tr>
                                <td><a href="{{ action('ServiceDeskController@edit_ticket', array('id' => $ticket->ticket_id)) }}">{{ str_limit($ticket->titre, 100, ' ... ') }}</a></td>
                                <td>{!! str_limit($ticket->description, 100, ' ... ') !!}</td>
                                <td>{{ $ticket->created_nom }}&nbsp;{{ $ticket->created_prenom }}</td>
                                <td>{{ $ticket->libelle }}</td>
                                <td style="text-align:center"><span @if ($ticket->priorite_id == 1) class="btn btn-danger" @elseif ($ticket->priorite_id == 2) class="btn btn-info" @else class="btn btn-default" @endif>{{ $ticket->priorite_libelle }}</span></td>
                                <td>{{ $ticket->societe }}&nbsp;-&nbsp;{{ $ticket->nom }}&nbsp;{{ $ticket->prenom }}</td>
                                <td style="text-align:center">
                                    <span
                                            @if ($ticket->ticket_last_status == \Config::get('constants.status.STATUT_BROUILLON_KEY')) class="btn btn-default"
                                            @elseif ($ticket->ticket_last_status == \Config::get('constants.status.STATUT_PRISE_EN_CHARGE_KEY')) class="btn btn-warning"
                                            @elseif ($ticket->ticket_last_status == \Config::get('constants.status.STATUT_REFUSE_KEY')) class="btn btn-danger"
                                            @elseif ($ticket->ticket_last_status == \Config::get('constants.status.STATUT_LIVRE_KEY')) class="btn btn-info"
                                            @elseif ($ticket->ticket_last_status == \Config::get('constants.status.STATUT_VALIDE_KEY')) class="btn btn-success"
                                            @else class="btn btn-primary" @endif >{{ $ticket->statut_libelle }}</span>
                                </td>
                                <td>{{ date('d/m/Y H:i:s', strtotime($ticket->date_creation)) }}</td>
                                <td>@if (!is_null($ticket->date_modification)){{ date('d/m/Y H:i:s', strtotime($ticket->date_modification)) }} @endif</td>
                                <td style="text-align: center;">
                                    <a href="{{ action('ServiceDeskController@edit_ticket', array('id' => $ticket->ticket_id)) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>&nbsp;&nbsp;
                                    <a href="#">
                                        <script type="text/javascript">
                                            $(function () {
                                                $(".deleteTicket_{{$ticket->ticket_id}}").click(function () {
                                                    if(confirm("Etes-vous sur de vouloir supprimer ce ticket ?")){
                                                        window.location.href = "{{ action('ServiceDeskController@delete_ticket', array('id' => $ticket->ticket_id)) }}";
                                                    }
                                                    return false;
                                                });
                                            });
                                        </script>
                                        <i class="fa fa-trash deleteTicket_{{$ticket->ticket_id}}"></i>
                                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    @if($ticket->ticket_last_status == \Config::get('constants.status.STATUT_BROUILLON_KEY'))
                                        <!--Ouverte-->
                                            <div class="btn-group">
                                                <a class="btn btn-primary" href="#"><i class="fa fa-cog fa-fw"></i> Actions</a>
                                                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                                    <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_PRISE_EN_CHARGE_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_PRISE_EN_CHARGE_LABEL')}}">
                                                            <i class="fa fa-pencil fa-fw"></i> {{\Config::get('constants.status.STATUT_PRISE_EN_CHARGE_LABEL')}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_LIVRE_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_LIVRE_LABEL')}}">
                                                            <i class="fa fa-check fa-fw"></i> {{\Config::get('constants.status.STATUT_LIVRE_LABEL')}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_VALIDE_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_VALIDE_LABEL')}}">
                                                            <i class="fa fa-thumbs-up fa-fw"></i> {{\Config::get('constants.status.STATUT_VALIDE_LABEL')}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_REFUSE_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_REFUSE_LABEL')}}">
                                                            <i class="fa fa-thumbs-down fa-fw"></i> {{\Config::get('constants.status.STATUT_REFUSE_LABEL')}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_CLOS_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_CLOS_LABEL')}}">
                                                            <i class="fa fa-close fa-fw"></i> {{\Config::get('constants.status.STATUT_CLOS_LABEL')}}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                    @elseif($ticket->ticket_last_status == \Config::get('constants.status.STATUT_PRISE_EN_CHARGE_KEY'))
                                        <!--En cours-->
                                            <div class="btn-group">
                                                <a class="btn btn-primary" href="#"><i class="fa fa-cog fa-fw"></i> Actions</a>
                                                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                                    <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_BROUILLON_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}">
                                                            <i class="fa fa-forward fa-fw"></i> {{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_LIVRE_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_LIVRE_LABEL')}}">
                                                            <i class="fa fa-check fa-fw"></i> {{\Config::get('constants.status.STATUT_LIVRE_LABEL')}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_CLOS_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_CLOS_LABEL')}}">
                                                            <i class="fa fa-close fa-fw"></i> {{\Config::get('constants.status.STATUT_CLOS_LABEL')}}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                    @elseif($ticket->ticket_last_status == \Config::get('constants.status.STATUT_LIVRE_KEY'))
                                        <!--En cours-->
                                            <div class="btn-group">
                                                <a class="btn btn-primary" href="#"><i class="fa fa-cog fa-fw"></i> Actions</a>
                                                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                                    <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_BROUILLON_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}">
                                                            <i class="fa fa-forward fa-fw"></i> {{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_VALIDE_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_VALIDE_LABEL')}}">
                                                            <i class="fa fa-thumbs-up fa-fw"></i> {{\Config::get('constants.status.STATUT_VALIDE_LABEL')}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_REFUSE_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_REFUSE_LABEL')}}">
                                                            <i class="fa fa-thumbs-down fa-fw"></i> {{\Config::get('constants.status.STATUT_REFUSE_LABEL')}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_CLOS_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_CLOS_LABEL')}}">
                                                            <i class="fa fa-close fa-fw"></i> {{\Config::get('constants.status.STATUT_CLOS_LABEL')}}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                    @elseif($ticket->ticket_last_status == \Config::get('constants.status.STATUT_VALIDE_KEY'))
                                        <!--En cours-->
                                            <div class="btn-group">
                                                <a class="btn btn-primary" href="#"><i class="fa fa-cog fa-fw"></i> Actions</a>
                                                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                                    <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_BROUILLON_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}">
                                                            <i class="fa fa-forward fa-fw"></i> {{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_CLOS_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_CLOS_LABEL')}}">
                                                            <i class="fa fa-close fa-fw"></i> {{\Config::get('constants.status.STATUT_CLOS_LABEL')}}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                    @elseif($ticket->ticket_last_status == \Config::get('constants.status.STATUT_REFUSE_KEY'))
                                        <!--En cours-->
                                            <div class="btn-group">
                                                <a class="btn btn-primary" href="#"><i class="fa fa-cog fa-fw"></i> Actions</a>
                                                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                                    <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_BROUILLON_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}">
                                                            <i class="fa fa-forward fa-fw"></i> {{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_CLOS_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_CLOS_LABEL')}}">
                                                            <i class="fa fa-close fa-fw"></i> {{\Config::get('constants.status.STATUT_CLOS_LABEL')}}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                    @else
                                        <div class="btn-group">
                                            <a class="btn btn-primary" href="#"><i class="fa fa-cog fa-fw"></i> Actions</a>
                                            <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                                <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ action('ServiceDeskController@save_historique', array('id' => $ticket->ticket_id, 'status' => \Config::get('constants.status.STATUT_BROUILLON_KEY'), 'redirect'=>0)) }}" title="{{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}">
                                                        <i class="fa fa-forward fa-fw"></i> {{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10">Il n'y a aucune demande dans le système</td>
                            </tr>
                            @endforelse
                            {!! $oTicket->render() !!}
                        </tbody>
                    </table>
                    {!! $oTicket->render() !!}
                </div>
            </div>
        </div>
    <!-- /.row -->
    </div>
@stop