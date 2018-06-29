@extends('layouts.main')

@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Statistiques de campagne pour votre site <small>VISIORANK</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> <a href="{{ action('DashboardController@index') }}">Tableau de bord</a> > <i class="fa fa-bar-chart"></i> Statistiques de visite
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        @if($user)
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Visites du mois</h3>
                    </div>
                    <div class="panel-body">
                        <div id="morris-stats-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-map-marker fa-fw"></i> Géolocalisation des visites @if($noGeo > 0) - <i>(Sans localisation : {{ $noGeo }})</i>@endif</h3>
                    </div>
                    <div class="panel-body">
                        <div id="geoloc-stats" style="height: 500px;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-phone-square"></i> Répartition des heures d'appel</h3>
                    </div>
                    <div class="panel-body">
                        <div class="flot-chart">
                            <div class="flot-chart-content" id="flot-pie-chart"></div>
                        </div>
                        <div class="text-right">
                            <a href="{{ action('DashboardController@calls') }}">Voir le détail <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        @endif
    </div>
    <!-- /.container-fluid -->

@stop

@section('script')
    @if($user)
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        var map;
        $(function() {

            var data = [{
                label: "Avant 8h",
                data: {{ $aube }}
            },{
                label: "Entre 8h et 12h",
                data: {{ $matin }}
            }, {
                label: "Entre 12h et 14h",
                data: {{ $midi }}
            }, {
                label: "Entre 14h et 18h",
                data: {{ $apresmidi }}
            }, {
                label: "Après 18h",
                data: {{ $soir }}
            }];

            $.plot('#flot-pie-chart', data, {
                series: {
                    pie: {
                        show: true
                    },
                },
                grid: {
                    hoverable: true
                },
                tooltip: true,
                tooltipOpts: {
                    content: "%s : %p.0%", // show percentages, rounding to 2 decimal places
                    shifts: {
                        x: 20,
                        y: 0
                    },
                    defaultTheme: true
                }
            });

            // Area Chart
            Morris.Area({
                element: 'morris-stats-chart',
                data: [
                @foreach($visits as $visit)
                {
                    period: '{{ $visit['label'] }}',
                    visit: '{{ $visit['value'] }}'
                },
                @endforeach
                ],
                xkey: 'period',
                ykeys: ['visit'],
                labels: ['Vistes'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });

            var latlng = new google.maps.LatLng(48.856, 2.352);
            // Options relatives à la carte
            var optionsGmaps = {
                center:latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                zoom: 5
            };
            

            // Initialisation de la carte pour l'élément portant l'id "map"
            map = new google.maps.Map(document.getElementById("geoloc-stats"), optionsGmaps);

            @if($noGeo < count($cities))
            @foreach($cities as $city)
            @if($city['latlng'])
            new google.maps.Marker({
                position: new google.maps.LatLng({{ $city['latlng']['lat'] }}, {{ $city['latlng']['lng'] }}),
                map: map,
                title: '{{ $city['ville'] }}',
            });
            @endif
            @endforeach
            @endif


            });






    </script>
    @endif
@stop