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
                        <i class="fa fa-dashboard"></i> <a href="{{ action('DashboardController@index') }}">Tableau de bord</a> > <i class="fa fa-envelope"></i> <a href="{{ action('DashboardController@messages') }}">Liste des messages</a> > <i class="fa fa-envelope-square"></i> Lecture d'un message
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        @if($user)
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td>De</td>
                            <td>{{ $message['header']->fromaddress }}</td>
                        </tr>
                        <tr>
                            <td>Pour</td>
                            <td>{{ $message['header']->toaddress }}</td>
                        </tr>
                        <tr>
                            <td>Sujet</td>
                            <td>{{ $message['header']->subject }}</td>
                        </tr>
                        <tr>
                            <td>Message</td>
                            <td>
                                <iframe id="iframe" style="width: 100%; height: 500px; border: 0;overflow:visible;">
                                    {!! $message['body'] !!}
                                </iframe>
                            </td>
                        </tr>
                        @if(count($message['attachments']) > 0)
                        <tr>
                            <td>Pièce(s) jointe(s)</td>
                            <td>
                                <ul>
                                @foreach($message['attachments'] as $part => $attachment)
                                    <li><a href="{{ action('DashboardController@get_attachment', array('id' => $message['uid'], 'part' => $part, 'encoding' => $attachment['encoding'])) }}">Piece n° {{ $part }} -  {{ $attachment['name'] }}</a></li>
                                @endforeach
                                </ul>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        @endif
        <!-- /.row -->
    </div>
<script type="text/javascript">
    var $iframe = $('#iframe');
    $iframe.ready(function() {
        $iframe.contents().find("body").append($iframe.html());
    });
</script>
@stop
