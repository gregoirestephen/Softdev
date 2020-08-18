@extends('home')

@section('css-wizard')
    <link href="{{asset('css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('css/material-bootstrap-wizard.css')}}" rel="stylesheet" />
@endsection

@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Gestion des patient
                <small>Home > <a href="#">Historique Antecedent</a></small>

            </h2>
            <div>

            </div>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="" style="margin: 10px 0px ;">
                            Historique Antecedent et Medication
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{route('historique.search')}}" method="POST">
                            @csrf
                            @method('GET')

                            <div class="row clearfix mt-lg-4" style="margin: auto 27%;">
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <div class="col-6">
                                            <label>Nom Patient</label>
                                            <select class="form-control" name="patient_id" required>
                                                @foreach($patient as $p)
                                                    <option value="{{$p->id}}">{{$p->nom_patient}} {{$p->prenom_patient}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <div class="col-6" >
                                            <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Rechercher</button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>


                        @if(isset($pat))
                            <div id="demo" class="collapse show">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table display table-bordered table-striped table-hover js-basic-example dataTable" id="example">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nom Patient</th>
                                                <th>Prenom Patient</th>
                                                <th>Medication</th>
                                                <th>Antecedent</th>
                                                <th>Date</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Nom Patient</th>
                                                <th>Prenom Patient</th>
                                                <th>Medication</th>
                                                <th>Antecedent</th>
                                                <th>Date</th>
                                            </tr>
                                            </tfoot>
                                            <tbody>

                                            <tr  v-for="(p,index) in patients" :key="index" :index="index">
                                                <td>HIST00@{{ ++index }}</td>
                                                <td>@{{ p.nom_patient }}</td>
                                                <td>@{{ p.prenom_patient }}</td>
                                                <td>@{{ p.lib_med }}</td>
                                                <td >@{{ p.lib_ant }}</td>
                                                <td >@{{ p.date_M }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div >
                        @else
                            <h3 class="text-center alert alert-danger">Aucun Historique ne correspond à ce Patient</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if(isset($pat))
@section('script-header')
    <script>
        const app = new Vue({
            el: '#app-b',
            filters:{
                etape:function (val) {
                    if (val==1){
                        return 'En Attente'
                    }
                    else if (val==2){
                        return 'Valide'
                    }
                    else{
                        return 'Annule'
                    }
                }
            },
            data:{
                bienvenue:false,
                isActive:true,
                yes:false,
                name: 'Vue Instance #1',
                patients:{!! json_encode($pat) !!},
            },

            methods:{
                annuler(id){

                },

                deleteAntecedent: function(id) {


                },
            },

        });

    </script>
@endsection
@endif

@section('script-wizard')
    <script src="{{asset('js/paper-bootstrap-wizard.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>
@endsection



