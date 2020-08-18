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
                <small>Home > <a href="https://datatables.net/" target="_blank"> Ligne Medications</a></small>

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
                            Table Ligne Medications
                        </h2>
                    </div>
                    <div class="body">
                        <div class="button-demo">
                            <button type="button" class="btn bg-blue waves-effect" @click.prevent="colapse()">@{{ message }}</button>
                        </div>

                        <div id="demo" class="collapse">
                            <div class="wizard-container">

                                <div class=" card wizard-card" data-color="red" id="wizardProfile">
                                    <form @submit.prevent="addAntecedent()">
                                        @csrf
                                        <div class="wizard-header text-center">
                                            <h3 class="wizard-title">Formulaire Medication</h3>
                                            <p class="category">Les informations saisies permettront de mieux vous connaitre.</p>
                                        </div>

                                        <div class="wizard-navigation">
                                            <div class="progress-with-circle">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="#about" data-toggle="tab">
                                                        <div class="icon-circle">
                                                            <i class="material-icons">user</i>
                                                        </div>
                                                        Medications
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="tab-content">

                                            <div class="row clearfix">
                                                <div class="col-sm-5">
                                                    <div class="form-group ">
                                                        <label  class="col-4 control-label"> Nom Patient</label>
                                                        <div class="col-6">
                                                            <select class="form-control" v-model="newAntecedent.patient_id" required>
                                                                <option :value="patient.id" v-for="patient in patients" :key="patient.id">@{{patient.nom_patient}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-5">
                                                    <div class="form-group ">
                                                        <label  class="col-4 control-label">MEDICATIONS</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix" v-for="medication in medications">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="checkbox" :id="'med_checkbox'+medication.id" :value="medication.id" class="chk-col-red" v-model="resultats"/>
                                                        <label  class="col-4 control-label" :for="'med_checkbox'+medication.id">@{{medication.lib_med}}</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="wizard-footer">
                                            <div class="pull-right">
                                                <input type='button' class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='Next' />
                                                <input type='submit' class='btn btn-finish btn-fill btn-danger btn-wd' name='finish' value='Finish' />
                                            </div>

                                            <div class="pull-left">
                                                <input type='button' class='btn btn-previous btn-default btn-wd' name='previous' value='Previous' />
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>
                                </div>
                            </div> <!-- wizard container -->
                        </div>
                        <div id="best" class="collapse" :class="{'show':isActive}">
                            <div class="table-responsive">
                                <table class="table display table-bordered table-striped table-hover js-basic-example dataTable" id="example">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom patient</th>
                                        <th>Prenom Patient</th>
                                        <th>Medication</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom patient</th>
                                        <th>Prenom Patient</th>
                                        <th>Medication</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    <tr  v-for="(p,index) in temp" :key="index" :index="index">
                                        <td>@{{ ++index }}</td>
                                        <td>@{{ p.nom_patient }}</td>
                                        <td>@{{ p.prenom_patient }}</td>
                                        <td>@{{ p.lib_med }}</td>
                                        <td><a type="button" class="btn btn-warning btn-sm" data-toggle="modal"  @click.prevent="getAntecedent(p.id)" >
                                                <i class="material-icons">create</i>
                                                <span> </span>
                                            </a>

                                            <div class="modal fade" id="editArticleModal" tabindex="-1" role="dialog" aria-labelledby="editArticleModal" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modifier  Ligne Medication</h5>
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
                                                                    <label  class="col-4 control-label"> Libelle Medications</label>
                                                                    <div class="col-6">
                                                                        <select class="form-control" v-model="currentAntecedent.medication_id" required>
                                                                            <option :value="medication.id" v-for="medication in medications" :key="medication.id">@{{medication.lib_med}}</option>
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
    </div>
@endsection

@section('script-header')
    <script>
        const app = new Vue({
            el: '#app-b',
            data:{
                name: 'Vue Instance #1',
                message:'Nouvel Ligne Medications',
                bienvenue:false,
                isActive:true,
                resultats:[],
                currentAntecedent:{},
                temp:[],
                patients:{!! json_encode($patient) !!},
                medications:{!! json_encode($medication) !!},
                newAntecedent: {
                    patient_id: null,
                    medication_id: null,
                },


            },
            methods:{
                colapse:function(){
                    $('#demo').collapse('toggle')
                    this.bienvenue=!this.bienvenue
                    if (this.bienvenue){
                        this.message='Fermer'
                        this.isActive=false;
                    }
                    else{
                        this.message=' Nouvel Ligne Medication'
                        this.isActive=true;
                    }

                },
                getAll:function(){
                    var app=this;
                    axios.get('/ligne-medications/index').then(function (res) {
                        for (let i=0;i<res.data.length;i++){
                            app.temp.push(res.data[i]);
                        }
                    }).catch((err) => {
                        console.log(err);
                    })

                },
                getAntecedent:function (id) {
                    var app=this
                    axios.get('/ligne-medications/'+id).then(function (res) {
                        app.currentAntecedent =res.data
                        $("#editArticleModal").modal('show');
                    }).catch((err) => {
                        console.log(err);
                    })
                },

                addAntecedent: function() {
                    var app=this;
                    for (let i=0;i<app.resultats.length;i++) {
                        let formData = new FormData();
                        formData.append('patient_id', app.newAntecedent.patient_id)
                        formData.append('medication_id', app.resultats[i])

                        axios.post('/ligne-medications',formData).then((response) => {
                            $('#demo').collapse('hide')
                            this.isActive=true;
                            this.dt();
                            this.temp=[]
                            this.getAll();
                            toastr.options.progressBar = true;
                            toastr.success(' Ligne Medication Enregistré',{timeOut: 3000});


                        })
                            .catch((err) => {
                                console.log(err);
                            })

                    }

                },
                updateAntecedent: function() {
                    var app=this;
                    axios.put('/ligne-medications/'+this.currentAntecedent.id,this.currentAntecedent)
                        .then((response) => {
                            this.currentAntecedent = response.data
                            this.dt()
                            app.temp=[];
                            app.getAll();
                            app.closeModale();
                            toastr.options.progressBar = true;
                            toastr.success(' Ligne Medication Modifié',{timeOut: 3000});
                        })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                deleteAntecedent: function(id) {
                    axios.delete('/ligne-medications/'+id )
                        .then((response) => {
                            this.dt();
                            this.temp=[]
                            this.getAll();
                            toastr.options.progressBar = true;
                            toastr.success(' Ligne Medication Supprimé',{timeOut: 3000});
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
            },
            updated:function () {
                if (this.isActive){
                    this.bienvenue=false;
                    this.message='Nouvel Ligne Medication';
                }
            }
        });


    </script>
@endsection

@section('script-wizard')
    <script src="{{asset('js/paper-bootstrap-wizard.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>
@endsection
