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
                <small>Home > <a href="https://datatables.net/" target="_blank">Consultations</a></small>

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
                            Table Consultation
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table display table-bordered table-striped table-hover js-basic-example dataTable" id="example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reference Consultation</th>
                                    <th>Nom Patient</th>
                                    <th>Prenom Patient</th>
                                    <th>Observation Patient</th>
                                    <th>Etape Consultation</th>
                                    <th>Date</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Reference Consultation</th>
                                    <th>Nom Patient</th>
                                    <th>Prenom Patient</th>
                                    <th>Observation Patient</th>
                                    <th>Etape Consultation</th>
                                    <th>Date</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                <tr  v-for="(p,index) in temp" :key="index" :index="index">
                                    <td>@{{ ++index }}</td>
                                    <td>CSLT00@{{ p.id }}</td>
                                    <td>@{{ p.nom_patient }}</td>
                                    <td>@{{ p.prenom_patient }}</td>
                                    <td>@{{ p.observation }}</td>
                                    <td>@{{ p.etape_consult | etape }}</td>
                                    <td >@{{ p.dateConsultation | moment }}</td>
                                    <td><a type="button" class="btn btn-warning btn-sm" data-toggle="modal"  @click.prevent="getAntecedent(p.id)" >
                                            <i class="material-icons">create</i>
                                            <span> </span>
                                        </a>

                                        <div class="modal fade" id="editArticleModal" tabindex="-1" role="dialog" aria-labelledby="editArticleModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modifier Consultation</h5>
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

                                                            <div class="form-group">
                                                                <label  class="col-4 control-label">Observation</label>
                                                                <div class="form-line col-6">
                                                                    <textarea class="form-control" v-model="currentAntecedent.observation" required>
                                                                    </textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Etat Consultation</label>
                                                                <div class="col-6">
                                                                    <select class="form-control" v-model="currentAntecedent.etape_consult" required>
                                                                        <option :value="1">En Attente</option>
                                                                        <option :value="2">Valide</option>
                                                                        <option :value="3">Annule</option>
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
                },
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
                name: 'Vue Instance #1',
                currentAntecedent:{},
                temp:[],
                patients:{!! json_encode($patient) !!},
                newAntecedent: {
                    patient_id: null,
                    observation: null,
                    etape_consult: null
                },


            },
            methods:{
                getAll:function(){
                    var app=this;
                    axios.get('/consultations/index').then(function (res) {
                        for (let i=0;i<res.data.length;i++){
                            app.temp.push(res.data[i]);
                        }
                    }).catch((err) => {
                        console.log(err);
                    })

                },
                getAntecedent:function (id) {
                    var app=this
                    axios.get('/consultations/'+id).then(function (res) {
                        app.currentAntecedent =res.data
                        $("#editArticleModal").modal('show');
                    }).catch((err) => {
                        console.log(err);
                    })
                },

                addAntecedent: function() {
                    var app=this;
                    axios.post('/consultations',this.newAntecedent).then((response) => {
                        app.dt();
                        app.temp=[];
                        app.getAll();
                        $('#exampleModal').modal('hide');


                    })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                updateAntecedent: function() {
                    var app=this;
                    axios.put('/consultations/'+this.currentAntecedent.id,this.currentAntecedent)
                        .then((response) => {
                            this.currentAntecedent = response.data
                            $('#editArticleModal').removeClass("fade").modal('hide');
                            this.dt()
                            app.temp=[];
                            app.getAll();
                            toastr.options.progressBar = true;
                            toastr.success(' Consultation Modifié',{timeOut: 3000});
                        })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                deleteAntecedent: function(id) {
                    var app=this
                    axios.get('/consultations/verification/'+id).then(function (res) {
                        var result=res.data
                        if (result>0){
                            toastr.options.progressBar = true;
                            toastr.error('Suppression impossible, Consultation en relation avec un Ordonnance',{timeOut: 3000});
                        }
                        else {
                            axios.delete('/consultations/'+id )
                                .then((response) => {
                                    $('#example').find('td').remove();
                                    app.temp=[]
                                    app.getAll();
                                    toastr.options.progressBar = true;
                                    toastr.success(' Consultation Supprimé',{timeOut: 3000});
                                })
                                .catch((err) => {
                                    console.log(err);
                                })
                        }
                    })
                },
                dt(){
                    $('#example').find('td').remove();
                },

            },
            created: function(){
                this.getAll()
            }
        });


    </script>
@endsection
