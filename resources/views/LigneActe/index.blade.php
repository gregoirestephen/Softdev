@extends('home')

@section('content')
    {{--    affichage des messages d'erreurs--}}
    @if (session()->has('error'))
        <div class="alert alert-danger">
            <strong>{{session()->get('error')}}</strong>
        </div>

    @endif
    @if (session()->has('success'))
        <div class="alert alert-success">
            <strong>{{session()->get('success')}}</strong>
        </div>
    @endif

    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Gestion des patient
                <small>Home > <a href="https://datatables.net/" target="_blank"> Ligne Acte</a></small>

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
                            Table  Ligne Acte
                        </h2>
                    </div>
                    <div class="body">
                        <div class="button-demo">
                            <button type="button" class="btn bg-blue waves-effect" data-toggle="modal" data-target="#exampleModal">Nouvel  Ligne Acte</button>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nouvel Ligne Acte</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form @submit.prevent="addAntecedent()">
                                            @csrf
                                            <div class="form-group ">
                                                <label  class="col-4 control-label"> Nom Patient</label>
                                                <div class="col-6">
                                                    <select class="form-control" v-model="newAntecedent.patient_id" required>
                                                        <option :value="patient.id" v-for="patient in patients" :key="patient.id">@{{patient.nom_patient}}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label  class="col-4 control-label"> Libelle Acte</label>
                                                <div class="col-6">
                                                    <select class="form-control" v-model="newAntecedent.acte_id" required>
                                                        <option :value="acte.id" v-for="acte in actes" :key="acte.id">@{{acte.lib_actes}}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label  class="col-4 control-label">Date Acte</label>
                                                <div class="form-line col-6">
                                                    <input type="date"  class="form-control" v-model="newAntecedent.date_execut" required>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table display table-bordered table-striped table-hover js-basic-example dataTable" id="example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reference Ligne Acte</th>
                                    <th>Nom patient</th>
                                    <th>Prenom Patient</th>
                                    <th>Libelle Acte</th>
                                    <th>Prix Acte(PU)</th>
                                    <th>Date Execution Acte</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Reference Ligne Acte</th>
                                    <th>Nom patient</th>
                                    <th>Prenom Patient</th>
                                    <th>Libelle Acte</th>
                                    <th>Prix Acte(PU)</th>
                                    <th>Date Execution Acte</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                <tr  v-for="(p,index) in temp" :key="index" :index="index">
                                    <td>@{{ ++index }}</td>
                                    <td>LGA00@{{ p.id }}</td>
                                    <td>@{{ p.nom_patient }}</td>
                                    <td>@{{ p.prenom_patient }}</td>
                                    <td>@{{ p.lib_actes }}</td>
                                    <td>@{{ p.prix_actes }}</td>
                                    <td>@{{ p.date_execut | moment}}</td>
                                    <td><a type="button" class="btn btn-warning btn-sm" data-toggle="modal"  @click.prevent="getAntecedent(p.id)" >
                                            <i class="material-icons">create</i>
                                            <span> </span>
                                        </a>

                                        <div class="modal fade" id="editArticleModal" tabindex="-1" role="dialog" aria-labelledby="editArticleModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modifier Ligne Acte</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form @submit.prevent="updateAntecedent()">
                                                            @csrf

                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label"> Nom Patient</label>
                                                                <div class="col-6">
                                                                    <select class="form-control" v-model="currentAntecedent.patient_id" required>
                                                                        <option :value="patient.id" v-for="patient in patients" :key="patient.id">@{{patient.nom_patient}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label"> Libelle Acte</label>
                                                                <div class="col-6">
                                                                    <select class="form-control" v-model="currentAntecedent.acte_id" required>
                                                                        <option :value="acte.id" v-for="acte in actes" :key="acte.id">@{{acte.lib_actes}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Date Acte</label>
                                                                <div class="form-line col-6">
                                                                    <input type="date"  class="form-control" v-model="currentAntecedent.date_execut" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label"> Libelle Acte</label>
                                                                <div class="col-6">
                                                                    <select class="form-control" v-model="currentAntecedent.etat_ligne" required>
                                                                        <option :value="1" >En Attente</option>
                                                                        <option :value="2" >Validé</option>
                                                                        <option :value="3" >Annuler</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-header')
    <script>
        const app = new Vue({
            el: '#app-b',
            filters:{
                moment:function (date) {
                    return moment(date).format('DD MMMM YYYY');
                }
            },
            data:{
                name: 'Vue Instance #1',
                currentAntecedent:{},
                temp:[],
                patients:{!! json_encode($patient) !!},
                actes:{!! json_encode($acte) !!},
                newAntecedent: {
                    acte_id: null,
                    patient_id: null,
                    date_execut:null,
                },


            },
            methods:{
                getAll:function(){
                    var app=this;
                    axios.get('/ligne-acte/index').then(function (res) {
                        for (let i=0;i<res.data.length;i++){
                            app.temp.push(res.data[i]);
                        }
                    }).catch((err) => {
                        console.log(err);
                    })

                },
                getAntecedent:function (id) {
                    var app=this
                    axios.get('/ligne-acte/'+id).then(function (res) {
                        app.currentAntecedent =res.data
                        $("#editArticleModal").modal('show');
                    }).catch((err) => {
                        console.log(err);
                    })
                },

                addAntecedent: function() {
                    var app=this;
                    axios.post('/ligne-acte',this.newAntecedent).then((response) => {
                        app.dt();
                        app.temp=[];
                        app.getAll();
                        $('#exampleModal').modal('hide');
                        toastr.options.progressBar = true;
                        toastr.success('Ligne acte Enregistré',{timeOut: 3000});


                    })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                updateAntecedent: function() {
                    var app=this;
                    axios.put('/ligne-acte/'+this.currentAntecedent.id,this.currentAntecedent)
                        .then((response) => {
                            this.currentAntecedent = response.data
                            this.dt()
                            app.temp=[];
                            app.getAll();
                            app.closeModale();
                            toastr.options.progressBar = true;
                            toastr.success('Ligne acte Modifié',{timeOut: 3000});
                        })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                deleteAntecedent: function(id) {
                    axios.delete('/ligne-acte/'+id )
                        .then((response) => {
                            this.dt();
                            this.temp=[]
                            this.getAll();
                            toastr.options.progressBar = true;
                            toastr.success('Ligne acte Supprimé',{timeOut: 3000});
                        })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                dt(){
                    $('#example').find('td').remove();
                },
                closeModale(){
                    $('#editArticleModal').modal('hide');
                    // $("#editArticleModal").on('hidden.bs.modal', function () {
                    //     $(this).data('bs.modal', null);
                    // });
                }

            },
            created: function(){
                this.getAll()
            }
        });


    </script>
@endsection
