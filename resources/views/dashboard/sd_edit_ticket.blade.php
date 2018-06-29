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
                        <i class="fa fa-dashboard"></i> <a href="{{ action('DashboardController@index') }}">Tableau de bord</a> > <i class="fa fa-ticket"></i> <a href="{{ action('ServiceDeskController@ticket') }}">Gestion des demandes</a> > <i class="fa fa-ticket"></i> Edition d'une demandes
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <h2>Edition d'une demande @if (isset($id) && $id != null && $id > 0)> {{$ticket->titre}} @endif</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="table-responsive">
                    {!! Form::model($ticket, array('action' => 'ServiceDeskController@save_ticket', 'role' => 'form')) !!}
                        {!! Form::hidden('ticket_id') !!}
                        <input type="hidden" name="uploadedfiles" id="uploadedfiles">

                        @if (isset($id) && $id != null && $id > 0)
                            <div class="form-group">
                                <label>Statut Actuel : </label>
                                @if ($ticket->ticket_last_status == \Config::get('constants.status.STATUT_BROUILLON_KEY')) <span class="btn btn-default">{{ \Config::get('constants.status.STATUT_BROUILLON_LABEL') }}</span>
                                @elseif ($ticket->ticket_last_status == \Config::get('constants.status.STATUT_PRISE_EN_CHARGE_KEY')) <span class="btn btn-warning">{{ \Config::get('constants.status.STATUT_PRISE_EN_CHARGE_LABEL') }}</span>
                                @elseif ($ticket->ticket_last_status == \Config::get('constants.status.STATUT_REFUSE_KEY')) <span class="btn btn-danger">{{ \Config::get('constants.status.STATUT_REFUSE_LABEL') }}</span>
                                @elseif ($ticket->ticket_last_status == \Config::get('constants.status.STATUT_LIVRE_KEY')) <span class="btn btn-info">{{ \Config::get('constants.status.STATUT_LIVRE_LABEL') }}</span>
                                @elseif ($ticket->ticket_last_status == \Config::get('constants.status.STATUT_VALIDE_KEY')) <span class="btn btn-success">{{ \Config::get('constants.status.STATUT_VALIDE_LABEL') }}</span>
                                @else <span class="btn btn-primary">{{ \Config::get('constants.status.STATUT_CLOS_LABEL') }}</span>@endif
                                <label>&nbsp;&nbsp;>&nbsp;&nbsp;</label>
                                <div class="btn-group">
                                    <a class="btn btn-primary" style="color: #333 !important; background-color: #ebeef1 !important; border-color: #bdbdbd !important;" href="#"><i class="fa fa-cog fa-fw"></i> Modifier le statut de la demande</a>
                                    <a class="btn btn-primary dropdown-toggle" style="color: #333!important; background-color: #ebeef1!important; border-color: #bdbdbd !important;" data-toggle="dropdown" href="#">
                                        <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
                                    </a>
                                @if($ticket->ticket_last_status == \Config::get('constants.status.STATUT_BROUILLON_KEY'))
                                        <ul class="dropdown-menu" style="width: 273px;">
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_PRISE_EN_CHARGE_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_PRISE_EN_CHARGE_LABEL')}}">
                                                    <i class="fa fa-pencil fa-fw"></i> {{\Config::get('constants.status.STATUT_PRISE_EN_CHARGE_LABEL')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_LIVRE_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_LIVRE_LABEL')}}">
                                                    <i class="fa fa-check fa-fw"></i> {{\Config::get('constants.status.STATUT_LIVRE_LABEL')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_VALIDE_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_VALIDE_LABEL')}}">
                                                    <i class="fa fa-thumbs-up fa-fw"></i> {{\Config::get('constants.status.STATUT_VALIDE_LABEL')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_REFUSE_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_REFUSE_LABEL')}}">
                                                    <i class="fa fa-thumbs-down fa-fw"></i> {{\Config::get('constants.status.STATUT_REFUSE_LABEL')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_CLOS_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_CLOS_LABEL')}}">
                                                    <i class="fa fa-close fa-fw"></i> {{\Config::get('constants.status.STATUT_CLOS_LABEL')}}
                                                </a>
                                            </li>
                                        </ul>
                                @elseif($ticket->ticket_last_status == \Config::get('constants.status.STATUT_PRISE_EN_CHARGE_KEY'))
                                        <ul class="dropdown-menu" style="width: 273px;">
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_BROUILLON_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}">
                                                    <i class="fa fa-forward fa-fw"></i> {{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_LIVRE_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_LIVRE_LABEL')}}">
                                                    <i class="fa fa-check fa-fw"></i> {{\Config::get('constants.status.STATUT_LIVRE_LABEL')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_CLOS_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_CLOS_LABEL')}}">
                                                    <i class="fa fa-close fa-fw"></i> {{\Config::get('constants.status.STATUT_CLOS_LABEL')}}
                                                </a>
                                            </li>
                                        </ul>
                                @elseif($ticket->ticket_last_status == \Config::get('constants.status.STATUT_LIVRE_KEY'))
                                        <ul class="dropdown-menu" style="width: 273px;">
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_BROUILLON_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}">
                                                    <i class="fa fa-forward fa-fw"></i> {{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_VALIDE_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_VALIDE_LABEL')}}">
                                                    <i class="fa fa-thumbs-up fa-fw"></i> {{\Config::get('constants.status.STATUT_VALIDE_LABEL')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_REFUSE_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_REFUSE_LABEL')}}">
                                                    <i class="fa fa-thumbs-down fa-fw"></i> {{\Config::get('constants.status.STATUT_REFUSE_LABEL')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_CLOS_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_CLOS_LABEL')}}">
                                                    <i class="fa fa-close fa-fw"></i> {{\Config::get('constants.status.STATUT_CLOS_LABEL')}}
                                                </a>
                                            </li>
                                        </ul>
                                @elseif($ticket->ticket_last_status == \Config::get('constants.status.STATUT_VALIDE_KEY'))
                                        <ul class="dropdown-menu" style="width: 273px;">
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_BROUILLON_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}">
                                                    <i class="fa fa-forward fa-fw"></i> {{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_CLOS_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_CLOS_LABEL')}}">
                                                    <i class="fa fa-close fa-fw"></i> {{\Config::get('constants.status.STATUT_CLOS_LABEL')}}
                                                </a>
                                            </li>
                                        </ul>
                                @elseif($ticket->ticket_last_status == \Config::get('constants.status.STATUT_REFUSE_KEY'))
                                        <ul class="dropdown-menu" style="width: 273px;">
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_BROUILLON_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}">
                                                    <i class="fa fa-forward fa-fw"></i> {{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_CLOS_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_CLOS_LABEL')}}">
                                                    <i class="fa fa-close fa-fw"></i> {{\Config::get('constants.status.STATUT_CLOS_LABEL')}}
                                                </a>
                                            </li>
                                        </ul>
                                @else
                                        <ul class="dropdown-menu" style="width: 273px;">
                                            <li>
                                                <a class="actionDemarrer" data-toggle="modal" data-target="#myModal" href="#" comment_status="{{\Config::get('constants.status.STATUT_BROUILLON_KEY')}}" comment_redirect="1" comment_ticket_id="{{$ticket->ticket_id}}" urlaction="{{ action('ServiceDeskController@save_historique_comment'), array() }}" title="{{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}">
                                                    <i class="fa fa-forward fa-fw"></i> {{\Config::get('constants.status.STATUT_BROUILLON_LABEL')}}
                                                </a>
                                            </li>
                                        </ul>
                                @endif
                                    </div>
                                </div>
                        @endif
                        <div class="form-group">
                            <label>Titre *</label>
                            {!! Form::text('titre', old('titre'), array('class' => "form-control", "placeholder" => "Titre")) !!}
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            {!! Form::textarea('description', old('description'), array('class' => "form-control", "placeholder" => "Description")) !!}
                        </div>
                        <div class="form-group">
                            <label>Type de la demande</label>
                            <div class="btn-group" style="margin-left: 5px;margin-bottom: 5px;">
                                @foreach($oTypeTicket as $typeTicket)
                                    <button type="button" class="btn btn-type btn-default @if(isset($ticket->ticket_id) && $ticket->ticket_id > 0) disabled @endif " value="{{$typeTicket->type_id}}">{{$typeTicket->libelle}}</button>
                                @endforeach
                            </div>
                            <select id="type" name="type" class="form-control" @if (isset($ticket->ticket_id) && $ticket->ticket_id > 0) readonly="readonly" disabled @endif>
                                <option value="0"> Type de la demande</option>
                                @foreach($oTypeTicket as $typeTicket)
                                    <option value="{{$typeTicket->type_id}}" @if(isset($ticket->type) && $ticket->type != 0 && $ticket->type == $typeTicket->type_id) selected="selected" @endif> {{$typeTicket->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Priorité de la demande</label>
                            <div class="btn-group" style="margin-left: 5px;margin-bottom: 5px;">
                                @foreach($oPrioriteTicket as $prioriteTicket)
                                    <button type="button" @if ($prioriteTicket->priorite_id == 1) class="btn btn-priorite btn-danger" @elseif ($prioriteTicket->priorite_id == 2) class="btn btn-priorite btn-info" @else class="btn btn-priorite btn-default" @endif value="{{$prioriteTicket->priorite_id}}">{{$prioriteTicket->priorite_libelle}}</button>
                                @endforeach
                            </div>
                            <select id="ticket_priorite_id" name="ticket_priorite_id" class="form-control">
                                <option value="0"> Priorité de la demande</option>
                                @foreach($oPrioriteTicket as $prioriteTicket)
                                    <option value="{{$prioriteTicket->priorite_id}}"
                                            @if(isset($ticket->ticket_priorite_id) && $ticket->ticket_priorite_id != 0 && $ticket->ticket_priorite_id == $prioriteTicket->priorite_id)
                                            selected="selected"
                                            @else
                                            @if($prioriteTicket->priorite_id == 2)
                                            selected="selected"
                                            @endif
                                            @endif> {{$prioriteTicket->priorite_libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Utilisateur</label>
                            <select name="user_id" class="js-example-basic-single js-states form-control" id="id_label_single">
                                <option value="0"> Choisissez un utilisateur </option>
                                @if(!is_null($user))
                                    @foreach($toUser as $oUser)
                                        <option value="{{$oUser->id}}" @if(isset($user->id) && $user->id > 0 && $user->id == $oUser->id) selected="selected" @endif>{{ $oUser->societe }}&nbsp;-&nbsp;{{ $oUser->nom }}&nbsp;{{ $oUser->prenom }}</option>
                                    @endforeach
                                @else
                                    @foreach($toUser as $oUser)
                                        <option value="{{$oUser->id}}" @if(isset($ticket->user_id) && $ticket->user_id > 0 && $ticket->user_id == $oUser->id) selected="selected" @endif>{{ $oUser->societe }}&nbsp;-&nbsp;{{ $oUser->nom }}&nbsp;{{ $oUser->prenom }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pièces jointes</label>
                            @if (isset($id) && $id != null && $id > 0 & isset ($toPj) && sizeof($toPj)>0)
                            <table class="table table-responsive table-bordered table-hover table-striped" style="font-size:13px;">
                                <thead>
                                <tr>
                                    <th width="40%">Date</th>
                                    <th width="40%">Fichiers</th>
                                    <th width="20%">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($toPj as $oPj)
                                    <tr>
                                        <td>{{ date('d/m/Y H:i:s', strtotime($oPj->pj_date)) }}</td>
                                        <td><a href="{{asset ("/uploads/" . $oPj->pj_file)}}" title="{{ $oPj->pj_file }}" target="_blank"><i class="fa {{$oPj->icon}}"></i> {{ $oPj->pj_file }}</a></td>
                                        <td  style="text-align: center;">
                                            <a href="#" title="Supprimer">
                                                <script type="text/javascript">
                                                    $(function () {
                                                        $(".deletePjTicket_{{$oPj->pj_id}}").click(function () {
                                                            if(confirm("Etes-vous sur de vouloir supprimer ce fichier ?")){
                                                                window.location.href = "{{ action('ServiceDeskController@delete_pj_ticket', array('idpj' => $oPj->pj_id, 'id' => $ticket->ticket_id)) }}";
                                                            }
                                                            return false;
                                                        });
                                                    });
                                                </script>
                                                <i class="fa fa-trash deletePjTicket_{{$oPj->pj_id}}"></i>
                                            </a>
                                            &nbsp;&nbsp;
                                            <a title="Telecharger" href="{{ action('ServiceDeskController@download_pj_ticket', array('file' => $oPj->pj_file)) }}">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endif
                            <br />
                            <div id="boatAddForm"></div>
                            <div class="container">
                                <div class="dropzone" id="dropzoneFileUpload" style="border:2px dotted rgba(0,0,0,0.3);background:#f9f9f9;"></div>
                            </div>
                        </div>
                        @if (isset($id) && $id != null && $id > 0 & isset ($toHistoriqueTicket) && sizeof($toHistoriqueTicket)>0)
                            <div class="form-group">
                                <label>Historique de la demande</label>
                                    <table class="table table-responsive table-bordered table-hover table-striped" style="font-size:13px;">
                                        <thead>
                                            <tr>
                                                <th width="20%">Date</th>
                                                <th width="20%">Action par</th>
                                                <th width="20%">Statut</th>
                                                <th width="40%">Commentaires</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($toHistoriqueTicket as $oHistoriqueTicket)
                                            <tr>
                                                <td>{{ date('d/m/Y H:i:s', strtotime($oHistoriqueTicket->historique_date)) }}</td>
                                                <td>{{ $oHistoriqueTicket->nom }}&nbsp;{{ $oHistoriqueTicket->prenom }}</td>
                                                <td>{{ $oHistoriqueTicket->statut_libelle }}</td>
                                                <td>{!! $oHistoriqueTicket->historique_comment !!}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        @endif
                        <button class="btn btn-default" type="submit">Enregistrer</button>

                        <!-- Modal -->
                    @if (isset($id) && $id != null && $id > 0)
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">{{$ticket->titre}}</h4>
                                        <div class="hiddenparam"/>
                                    </div>
                                    <div class="form-group">
                                        <p style="padding: 20px;">
                                            <label>Commentaires</label>
                                            {!! Form::textarea('commentaires', old('commentaires'), array('class' => "form-control", "placeholder" => "Commentaires")) !!}
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-default-ok-commentaire" data-dismiss="modal">OK</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                        <!-- Modal -->

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
    <script type="text/javascript">
        var baseUrl = "{{ url('/') }}";
        var token = "{{ Session::getToken() }}";
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("div#dropzoneFileUpload", {
            url: baseUrl+"/dropzone/uploadFiles",
            addRemoveLinks: true,
            maxFilesize: 10, // MB
            dictRemoveFile: "Supprimer",
            dictDefaultMessage: "Drag & Drop : Ajouter vos fichiers ici...<br />Taille maximum : 10Mo",
            params: {
                _token: token
            },
            init:function(){
                this.on ('removedfile', function(file) {
                    var uploadedfiles = $('#uploadedfiles').val();
                    $('#uploadedfiles').val(uploadedfiles.replace(file.name , ""));
                });
            },
            success: function (resp){
                var uploadedfiles = $('#uploadedfiles').val();
                var newuploadedfiles = "";
                if (uploadedfiles == "")
                    newuploadedfiles = resp.name;
                else
                    newuploadedfiles = uploadedfiles + ";" + resp.name;

                $('#uploadedfiles').val(newuploadedfiles);
            }
        });

        $('.btn-priorite').click (function (){
            var selected = $(this).attr("value");
            $('#ticket_priorite_id').val(selected);
        });
        $('.btn-type').click (function (){
            var selected = $(this).attr("value");
            $('#type').val(selected);
        });

        $('#id_label_single').select2({
        });

        $(".actionDemarrer").click(function(){
            $('.hiddenparam').attr('urlaction', $(this).attr('urlaction'));
            $('.hiddenparam').attr('comment_status', $(this).attr('comment_status'));
            $('.hiddenparam').attr('comment_redirect', $(this).attr('comment_redirect'));
            $('.hiddenparam').attr('comment_ticket_id', $(this).attr('comment_ticket_id'));
        });
    </script>
@stop