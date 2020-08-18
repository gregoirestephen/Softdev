<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facturation</title>
{{--    <link href="{{asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('css/style.css')}}" rel="stylesheet">--}}

    <style>
        .t{
            display: block !important;
            margin-left: 3%;
        }
        table {
            border-collapse: collapse;

        }

        table, th, td {
            border: 1px solid black;
        }
        th{
            width: 100px;
        }
    </style>

</head>
<body>

<div class="container" id="app-c">
    <div class="card">
        <div class="card-body">
            <div class="col col-xl-8 col-sm-12">
                <div class="d-flex text-center clearfix">
                    <div class="" style="margin: 15px 0 2px 50%;">
                        <small>Date:</small>
                        <span>{{\Carbon\Carbon::now()->format('d/m/yy H:i')}}</span>
                    </div>
                </div>
            </div>
            <div class="row mt-2 logo" style="margin-left: 1%;">
                <div class="mx-auto d-block">
                    <img src="public/teranga.jpg" alt="logo" height="90px" width="164px">

                </div>
            </div>
            <hr>
            <div class="row">
                @foreach($fact as $facture)
                <h4 style="margin-left: 3%; text-decoration-line: underline">Information Patient</h4>
                <span class="t">Numero Facture: FACT00{{$facture->id}}</span>
                <span class="t">Nom Patient: {{$facture->nom_patient}} {{$facture->prenom_patient}}</span>
                <span class="t">TEL:{{$facture->contact_patient}} </span>
                @endforeach
            </div>
            <hr>
            <div class="row" style="margin: 3%;">
                <h4 class="t" style="text-align: center; text-decoration-line: underline; color: #0d68b8">FACTURE</h4>
                <table class="table table-bordered table-responsive" cellspacing="0" width="80%">
                    <thead>
                    <tr>
                        <th>Libelle Acte</th>
                        <th>Prix Acte</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lActe as $acte)
                    <tr>
                        <td style="text-align: center;">{{$acte->lib_actes}}</td>
                        <td style="text-align: center;">{{$acte->prix_actes}}</td>
                    </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                    @foreach($fact as $facture)
                        <tr>
                            <th>MONTANT NET</th>
                            <th>{{$facture->montant_net}}</th>
                        </tr>
                    @endforeach
                    @foreach($fact as $facture)
                    <tr>
                        <th>Remise</th>
                        <th>{{$facture->remise}}</th>
                    </tr>
                    @endforeach
                    @foreach($fact as $facture)
                    <tr>
                        <th>TOTAL</th>
                        <th>{{$facture->montant_fact}}</th>
                    </tr>
                    @endforeach
                    </tfoot>
                </table>
            </div>

        </div>

    </div>
</div>

<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Core Js -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
</body>
</html>
