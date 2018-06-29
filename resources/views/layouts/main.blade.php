<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VisioRank Dashboard</title>

    <!-- jQuery -->
    <script src="{{ asset("js/jquery.js") }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset("js/bootstrap.min.js") }}"></script>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset("css/sb-admin.css") }}" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="{{ asset("css/plugins/morris.css") }}" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="{{ asset("font-awesome/css/font-awesome.min.css") }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Bootstrap datepicker -->
    <script src="{{ asset("js/plugins/datepicker/moment-with-locales.js") }}"></script>
    <script src="{{ asset("js/plugins/datepicker/bootstrap-datetimepicker.js") }}"></script>
    <link href="{{ asset("js/plugins/datepicker/bootstrap-datetimepicker.css") }}" rel="stylesheet" type="text/css">
    <script src="{{ asset("js/plugins/select2/select2.min.js") }}"></script>
    <link href="{{ asset("js/plugins/select2/select2.min.css") }}" rel="stylesheet" type="text/css">

    <!-- include tinymce js -->
    <script src="{{ asset("js/plugins/tinymce/tinymce.min.js") }}"></script>
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ action('DashboardController@index') }}"><img src="{{ asset('img/logo.png') }}" /></a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li style="color: white; font-size: 16px; font-weight: bold; padding: 15px;">
                Espace client : <span style="color: #f67d05;">02 22 06 99 03</span>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->prenom }} {{ Auth::user()->nom }} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ action('DashboardController@logout') }}"><i class="fa fa-fw fa-power-off"></i> Deconnexion</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                @if(Auth::user()->type == 1)
                <li>
                    {!! Form::select('user-select', getUsers(), session()->get('user', 0), array('class' => 'js-example-basic-single js-states', 'id'=> 'id-user-select', 'onchange' => 'updateUser(this.value)')) !!}
                </li>
                @endif
                <li class="@if(str_contains(Route::getCurrentRoute()->getActionName(), 'DashboardController@index')) active @endif">
                    <a href="{{ action('DashboardController@index') }}"><i class="fa fa-fw fa-dashboard"></i> Tableau de bord</a>
                </li>
                <li class="@if(str_contains(Route::getCurrentRoute()->getActionName(), 'DashboardController@stats')) active @endif">
                    <a href="{{ action('DashboardController@stats') }}"><i class="fa fa-fw fa-bar-chart-o"></i> Statistiques de campagne</a>
                </li>
                <li class="@if(str_contains(Route::getCurrentRoute()->getActionName(), 'DashboardController@calls')) active @endif">
                    <a href="{{ action('DashboardController@calls') }}"><i class="fa fa-fw fa-phone"></i> Liste des appels</a>
                </li>
                <li class="@if(str_contains(Route::getCurrentRoute()->getActionName(), 'DashboardController@messages')) active @endif">
                    <a href="{{ action('DashboardController@messages') }}"><i class="fa fa-fw fa-envelope"></i> Liste des messages</a>
                </li>
                <!--<li class="@if(str_contains(Route::getCurrentRoute()->getActionName(), 'DashboardController@bills')) active @endif">
                    <a href="{{ action('DashboardController@bills') }}"><i class="fa fa-fw fa-money"></i> Mes factures</a>
                </li>-->
                @if(Auth::user()->type == 1)
                <li class="@if(str_contains(Route::getCurrentRoute()->getActionName(), 'DashboardController@users')) active @endif">
                    <a href="{{ action('DashboardController@users') }}"><i class="fa fa-fw fa-users"></i> Gestion des utilisateurs</a>
                </li>
                @endif
                <li class="@if(str_contains(Route::getCurrentRoute()->getActionName(), 'ServiceDeskController@ticket')) active @endif">
                    <a href="{{ action('ServiceDeskController@ticket') }}"><i class="fa fa-fw fa-ticket"></i> Gestion des demandes</a>
                </li>
                <li style="color: white; font-size: 16px; font-weight: bold; padding: 15px;">
                    Des questions ? Contactez notre espace client au <span style="color: #f67d05;">02 22 06 99 03</span>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

    @yield('main', "Default")

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->



<script type="text/javascript">
    function updateUser(id){
        $.post('{{ action('DashboardController@update_user') }}', {"_token": "{{ csrf_token() }}", id: id}, function(data){
            location.reload();
        });
    }

    $('#date1').datetimepicker({format: 'DD/MM/YYYY'});
    $('#date2').datetimepicker({format: 'DD/MM/YYYY'});

    tinymce.init({
        selector:'textarea',
        width:"99,99%",
        language: 'fr_FR'
    });

    $('.btn-default-ok-commentaire').click(
        function () {
            tinyMCE.triggerSave();
            var urlaction = $('.hiddenparam').attr('urlaction');
            var status = $('.hiddenparam').attr('comment_status');
            var redirect = $('.hiddenparam').attr('comment_redirect');
            var ticket_id = $('.hiddenparam').attr('comment_ticket_id');
            var comment = $("#commentaires").val();
            $.post($('.actionDemarrer').attr('urlaction'), {"_token": "{{ csrf_token() }}", id: ticket_id, comment:comment, status:status, redirect:redirect}, function(data){
                location.reload();
            });
        }
    );

    $('#id-user-select').select2({
        theme: "classic"
    });
</script>
@yield('script')

</body>

</html>
