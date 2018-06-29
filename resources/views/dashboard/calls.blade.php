@extends('layouts.main')

@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Liste des appels <small>VISIORANK</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> <a href="{{ action('DashboardController@index') }}">Tableau de bord</a> > <i class="fa fa-phone"></i> Liste des appels
                    </li>
                </ol>
            </div>
        </div>
        @if($user)
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <h2>Liste des appels pour le "{{ preg_replace('/33/', '0', $user->telephone, 1) }}"</h2>
                <div class="table-responsive">
                    <table class="table table-responsive table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Debut de l'appel</th>
                                <th>Fin de l'appel</th>
                                <th>Durée</th>
                                <th>Appelant</th>
                                <th>Pertinent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($calls as $call)
                            <tr class="{{ setTerminatedCause($call) }}">
                                <td>{{ setDate($call['starttime']) }}</td>
                                <td>{{ setDate($call['starttime'], "PT1H" . $call['duration'] . "S") }}</td>
                                <td>{{ formatSeconds($call['duration']) }}</td>
                                <td>{{ preg_replace('/^33/', '0', $call['source'], 1) }}</td>
                                @if($user->type != 99)
                                <td style="text-align: center;"><input type="checkbox" value="1" onchange="setPertinance('{{ $call['id'] }}', $(this))" {{ $call['pertinant'] ? "checked" : "" }}/></td>
                                @else
                                <td style="text-align: center;"><input type="checkbox" value="1" {{ $call['pertinant'] ? "checked" : "" }}/></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
        @endif
    </div>
@stop

@section('script')

    <script type="text/javascript">
        function setPertinance(id, checkbox){
            $.post('{{ action('DashboardController@update_call') }}', {"_token": "{{ csrf_token() }}", id: id, state: checkbox.is(':checked')});
        }
    </script>
@stop