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
                <small>Home > <a href="#">Consultation > Facture</a></small>

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
                            Fiche de Consultation de Facture
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{route('factures.resultat')}}" method="POST">
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


                        @if(isset($facture))
                            <div id="demo" class="collapse show">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table display table-bordered table-striped table-hover js-basic-example dataTable" id="example">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Reference Facture</th>
                                                <th>Nom Patient</th>
                                                <th>Prenom Patient</th>
                                                <th>Montant Facture</th>
                                                <th>Montant Net</th>
                                                <th>Montant Restant</th>
                                                <th>Remise</th>
                                                <th>Etat</th>
                                                <th>Voir</th>
                                                <th>Annuler</th>
                                                <th>Supprimer</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Nom Patient</th>
                                                <th>Prenom Patient</th>
                                                <th>Reference Facture</th>
                                                <th>Montant Facture</th>
                                                <th>Montant Net</th>
                                                <th>Montant Restant</th>
                                                <th>Remise</th>
                                                <th>Etat</th>
                                                <th>Voir</th>
                                                <th>Annuler</th>
                                                <th>Supprimer</th>
                                            </tr>
                                            </tfoot>
                                            <tbody>

                                            <tr  v-for="(p,index) in factures" :key="index" :index="index">
                                                <td>@{{ ++index }}</td>
                                                <td>FACT00@{{ p.id }}</td>
                                                <td>@{{ p.nom_patient }}</td>
                                                <td>@{{ p.prenom_patient }}</td>
                                                <td>@{{ p.montant_fact }}</td>
                                                <td >@{{ p.montant_net }}</td>
                                                <td >@{{ p.montant_rest }}</td>
                                                <td >@{{ p.remise }}</td>
                                                <td >@{{ p.etat_facture |etape }}</td>
                                                <td>
                                                    <a type="button" class="btn btn-info btn-sm"  @click.prevent="consulter(p.id)" >
                                                        <i class="material-icons">visibility</i>
                                                        <span> </span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a type="button" class="btn btn-warning btn-sm"  @click.prevent="annuler(p.id)" >
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
                            <h3 class="text-center alert alert-danger">Aucune Facture ne correspond a cet intervalle</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if(isset($facture))
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
                message:'Nouvel Patient',
                bienvenue:false,
                isActive:true,
                yes:false,
                name: 'Vue Instance #1',
                currentAntecedent:{},
                temp:[],
                resultats:[],
                med:[],
                factures:{!! json_encode($facture) !!},


            },
            methods:{
                annuler(id){
                    let anul=''
                    axios.get('/factures/annuler/'+id).then(function (res) {
                        anul=res.data
                        if (anul==='Non'){
                            toastr.options.progressBar = true;
                            toastr.error("Annulation impossible, cette facture fait l'objet d'un reglement",{timeOut: 3000});
                        }
                        else {
                            toastr.options.progressBar = true;
                            toastr.success(' Facture Annulé',{timeOut: 3000});
                        }

                    })
                },

                consulter(id){
                    axios.get('/fact/consultation/'+id).then(function (res) {
                        console.log(res.data)
                    })
                },

                deleteAntecedent: function(id) {
                    let res=0
                    axios.get('/factures/verification/'+id )
                        .then((response) => {
                            res=response.data
                            if (res>0){
                                toastr.options.progressBar = true;
                                toastr.error('Suppression Impossible, Facture faisant objet de Reglement',{timeOut: 3000});
                            }
                            else{
                                axios.delete('/factures/'+id )
                                    .then((response) => {
                                        this.dt();
                                        toastr.options.progressBar = true;
                                        toastr.success(' Facture Supprimé',{timeOut: 3000});
                                    })
                                    .catch((err) => {
                                        console.log(err);
                                    })
                            }
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



