@extends('home')

@section('content')

    @can('isMedecin')
        <div class="row clearfix">

            <div class="col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">supervisor_account</i>
                    </div>
                    <div class="content">
                        <div class="text">PATIENTS</div>
                        <div class="number count-to" data-from="0" data-to="{{$patient}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">forum</i>
                    </div>
                    <div class="content">
                        <div class="text">RDV DU JOUR</div>
                        <div class="number count-to" data-from="0" data-to="{{$rdv}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">CONSULTATION EN COURS</div>
                        <div class="number count-to" data-from="0" data-to="{{$consult1}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">CONSULTATION VALIDES</div>
                        <div class="number count-to" data-from="0" data-to="{{$consult2}}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-8 col-sm-8 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>DETAILS RDV</h2>

                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                            <tr>
                                <th>Nom Patient</th>
                                <th>Libelle Rdv</th>
                                <th>Heure</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($rDetail as $detail)
                            <tr>
                                <td>{{$detail->nom_patient}}</td>
                                <td>{{$detail->objet_rdv}}</td>
                                <td>{{$detail->heure_rdv}}</td>
                            </tr>
                            @empty
                                <td> </td>
                               <td><p>Pas de Rdv Aujourd'hui</p></td>
                                <td> </td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-8 col-sm-8 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>DETAILS CONSULTATIONS</h2>

                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                            <tr>
                                <th>Nom Patient</th>
                                <th>Observation</th>
                                <th>Etape Consultation</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($rConsultation as $consultation)
                            <tr>
                                <td>{{$consultation->nom_patient}}</td>
                                <td>{{$consultation->observation}}</td>
                                <td>{{$consultation->etape_consult}}</td>
                            </tr>
                            @empty
                                <td> </td>
                                <td><p>Pas de Consultation Aujourd'hui</p></td>
                                <td> </td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    @can('isSecretaire')
        <div class="row clearfix">

            <div class="col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">supervisor_account</i>
                    </div>
                    <div class="content">
                        <div class="text">PATIENTS</div>
                        <div class="number count-to" data-from="0" data-to="{{$patient}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">forum</i>
                    </div>
                    <div class="content">
                        <div class="text">RDV DU JOUR</div>
                        <div class="number count-to" data-from="0" data-to="{{$rdv}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">CONSULTATION EN COURS</div>
                        <div class="number count-to" data-from="0" data-to="{{$consult1}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">CONSULTATION VALIDES</div>
                        <div class="number count-to" data-from="0" data-to="{{$consult2}}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
