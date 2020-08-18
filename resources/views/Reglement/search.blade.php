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
                <small>Home > <a href="#">Reglement > Historique</a></small>

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
                            Fiche de Reglement
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{route('reglements.search')}}" method="POST">
                            @csrf
                            @method('GET')

                            <div class="row clearfix mt-lg-4" style="margin: auto 27%;">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <div class="form-line col-6">
                                            <label>Date Debut</label>
                                            <input type="date"  class="form-control" name="date1" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <div class="form-line col-6">
                                            <label>Date Fin</label>
                                            <input type="date"  class="form-control" name="date2" required>
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


                        @if(isset($reglement))
                            <div id="demo" class="collapse show">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table display table-bordered table-striped table-hover js-basic-example dataTable" id="example">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Reference Ordonnance</th>
                                                <th>Reference Facture</th>
                                                <th>Montant Regle</th>
                                                <th>Date Reglement</th>
                                                <th>Etape Reglement</th>
                                                <th>Voir</th>
                                                <th>Annuler</th>
                                                <th>Supprimer</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Reference Ordonnance</th>
                                                <th>Reference Facture</th>
                                                <th>Montant Regle</th>
                                                <th>Date Reglement</th>
                                                <th>Etape Reglement</th>
                                                <th>Voir</th>
                                                <th>Annuler</th>
                                                <th>Supprimer</th>
                                            </tr>
                                            </tfoot>
                                            <tbody>

                                            <tr  v-for="(p,index) in reglements" :key="index" :index="index">
                                                <td>@{{ ++index }}</td>
                                                <td>REF00@{{ p.id }}</td>
                                                <td>FACT00@{{ p.facture_id }}</td>
                                                <td>@{{ p.montant_regle }}</td>
                                                <td>@{{ p.date_reg }}</td>
                                                <td >@{{ p.etat |etape }}</td>
                                                <td>
                                                    <a type="button" class="btn btn-info btn-sm" @click.prevent="consulter(p.id)" >
                                                        <i class="material-icons">visibility</i>
                                                        <span> </span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a type="button" class="btn btn-warning btn-sm" @click.prevent="annuler(p.id,p.facture_id)" >
                                                        <i class="material-icons">shuffle</i>
                                                        <span> </span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-danger btn-sm " @click="deleteAntecedent(p.id)">
                                                        <i class="material-icons">delete</i>
                                                        <span> </span>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div >
                        @else
                            <h3 class="text-center alert alert-danger">Aucun Reglement ne correspond a cet intervalle</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if(isset($reglement))
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
                reglements:{!! json_encode($reglement) !!},
            },

            methods:{
                annuler: function(reg,facto) {
                    var app=this;
                    axios.get('/reglements/annuler/'+reg+'/'+facto).then(function (res){
                        toastr.options.progressBar = true;
                        toastr.success('Reglement Annulé',{timeOut: 3000});
                        app.reste=0
                        app.newAntecedent.facture_id=null
                        app.newAntecedent.montant_regle=null
                    })
                        .catch((err) => {
                            console.log(err);
                        })
                },

                consulter:function (id){
                    axios.get('/reglement/consultation/'+id).then(function (){
                    })
                },

                deleteAntecedent: function(id) {
                    var app=this
                    axios.delete('/reglements/'+id )
                        .then((response) => {
                            if (response.data==='Non'){
                                toastr.options.progressBar = true;
                                toastr.error('Suppression Impossible, reglement lié à une facture',{timeOut: 3000});
                            }
                            else{
                                toastr.options.progressBar = true;
                                toastr.success('Reglement Supprimé',{timeOut: 3000});
                            }

                        })
                        .catch((err) => {
                            console.log(err);
                        })

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



