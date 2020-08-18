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
                <small>Home > <a href="https://datatables.net/" target="_blank">Patients</a></small>

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
                            Table Patient
                        </h2>
                    </div>
                    <div class="body">
                        <div class="button-demo">
                            <button type="button" class="btn bg-blue waves-effect" @click.prevent="colapse()" v-show="!isModif">@{{ message }}</button>
                            <button type="button" class="btn bg-blue waves-effect" @click.prevent="modifyMe()" v-show="isModif">@{{ ferme }}</button>
                        </div>

                        <div id="updateMe" class="collapse">
                            <div class="wizard-container">

                                <div class=" card wizard-card" data-color="red" id="wizardProfile">
                                    <form @submit.prevent="updateAntecedent()">
                                        @csrf
                                        <div class="wizard-header text-center">
                                            <h3 class="wizard-title">Formulaire patient</h3>
                                            <p class="category">Les informations saisies permettront de mieux vous connaitre.</p>
                                        </div>

                                        <div class="wizard-navigation">
                                            <div class="progress-with-circle">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="#address" data-toggle="tab">
                                                        <div class="icon-circle">
                                                            <i class="material-icons">user</i>
                                                        </div>
                                                        Patient(1)
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#third" data-toggle="tab">
                                                        <div class="icon-circle">
                                                            <i class="material-icons">user</i>
                                                        </div>
                                                        Patient(2)
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane" id="address">
                                                <div class="row">
                                                    <div class="clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Nom Patient</label>
                                                                <div class="form-line col-6">
                                                                    <input type="text"  class="form-control" v-model="currentAntecedent.nom_patient" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Prenom Patient</label>
                                                                <div class="form-line col-6">
                                                                    <input type="text"  class="form-control" v-model="currentAntecedent.prenom_patient" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Date Naissance</label>
                                                                <div class="form-line col-6">
                                                                    <input type="date"  class="form-control" v-model="currentAntecedent.date_naiss" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Genre Patient</label>
                                                                <div class="col-6">
                                                                    <select class="form-control" v-model="currentAntecedent.genre" required>
                                                                        <option value="M">Masculin</option>
                                                                        <option value="F">Feminin</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="tab-pane" id="third">

                                                <div class="row">
                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Profession Patient</label>
                                                                <div class="col-6">
                                                                    <select class="form-control" v-model="currentAntecedent.profession_id" required>
                                                                        <option :value="profession.id" v-for="profession in professions" :key="profession.id">@{{profession.libelle}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Contact Patient</label>
                                                                <div class="form-line col-6">
                                                                    <input type="number"  min="0" class="form-control" v-model="currentAntecedent.contact_patient" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Adresse Patient</label>
                                                                <div class="form-line col-6">
                                                                    <input type="text"  class="form-control" v-model="currentAntecedent.adresse_patient" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Assurance Patient</label>
                                                                <div class="col-6">
                                                                    <select id="e2" class="form-control " v-model="currentAntecedent.assurance_id" required>
                                                                        <option :value="assurance.id" v-for="assurance in assurances" :key="assurance.id">@{{assurance.nom_assurance}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Email Patient</label>
                                                                <div class="form-line col-6">
                                                                    <input type="email"  class="form-control" v-model="currentAntecedent.email_patient" required>
                                                                </div>
                                                            </div>
                                                        </div>
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
                            </div>
                        </div>

                        <div id="demo" class="collapse">

                            <div class="wizard-container">

                                <div class=" card wizard-card" data-color="red" id="wizardProfile">
                                    <form @submit.prevent="addAntecedent()">
                                        @csrf
                                        <div class="wizard-header text-center">
                                            <h3 class="wizard-title">Formulaire patient</h3>
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
                                                        Patient(1)
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#account" data-toggle="tab">
                                                        <div class="icon-circle">
                                                            <i class="material-icons">user</i>
                                                        </div>
                                                        Patient(2)
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane" id="about">
                                                <div class="row">
                                                    <div class="clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Nom Patient</label>
                                                                <div class="form-line col-6">
                                                                    <input type="text"  class="form-control" v-model="newAntecedent.nom_patient" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Prenom Patient</label>
                                                                <div class="form-line col-6">
                                                                    <input type="text"  class="form-control" v-model="newAntecedent.prenom_patient" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Date Naissance</label>
                                                                <div class="form-line col-6">
                                                                    <input type="date"  class="form-control" v-model="newAntecedent.date_naiss" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Genre Patient</label>
                                                                <div class="col-6">
                                                                    <select class="form-control" v-model="newAntecedent.genre" required>
                                                                        <option value="M">Masculin</option>
                                                                        <option value="F">Feminin</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="tab-pane" id="account">

                                                <div class="row">
                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Profession Patient</label>
                                                                <div class="col-6">
                                                                    <select class="form-control" v-model="newAntecedent.profession_id" required>
                                                                        <option :value="profession.id" v-for="profession in professions" :key="profession.id">@{{profession.libelle}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Contact Patient</label>
                                                                <div class="form-line col-6">
                                                                    <input type="number"  min="0" class="form-control" v-model="newAntecedent.contact_patient" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Adresse Patient</label>
                                                                <div class="form-line col-6">
                                                                    <input type="text"  class="form-control" v-model="newAntecedent.adresse_patient" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Assurance Patient</label>
                                                                <div class="col-6">
                                                                    <select id="e1" class="form-control " v-model="newAntecedent.assurance_id" required>
                                                                        <option :value="assurance.id" v-for="assurance in assurances" :key="assurance.id">@{{assurance.nom_assurance}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Email Patient</label>
                                                                <div class="form-line col-6">
                                                                    <input type="email"  class="form-control" v-model="newAntecedent.email_patient" required>
                                                                </div>
                                                            </div>
                                                        </div>
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

                        <div  id="best" class="collapse " :class="{'show':isActive}">
                            <div class="table-responsive">
                                <table class="table display table-bordered table-striped table-hover js-basic-example dataTable" id="example">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Reference Patient</th>
                                        <th>Nom Patient</th>
                                        <th>Prenom Patient</th>
                                        <th>Adresse Patient</th>
                                        <th>Contact Patient</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Reference Patient</th>
                                        <th>Nom Patient</th>
                                        <th>Prenom Patient</th>
                                        <th>Adresse Patient</th>
                                        <th>Contact Patient</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    <tr  v-for="(p,index) in temp" :key="index">
                                        <td>@{{ ++index }}</td>
                                        <td>PT00@{{ p.id }}</td>
                                        <td>@{{ p.nom_patient }}</td>
                                        <td>@{{p.prenom_patient}}</td>
                                        <td >@{{p.adresse_patient}}</td>
                                        <td >@{{p.contact_patient}}</td>
                                        <td><a type="button" class="btn btn-warning btn-sm" data-toggle="modal"  @click.prevent="getAntecedent(p.id)" >
                                                <i class="material-icons">create</i>
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
                message:'Nouvel Patient',
                bienvenue:false,
                isActive:true,
                name: 'Vue Instance #1',
                currentAntecedent:{},
                temp:[],
                ferme:'Fermer',
                isModif:false,
                assurances:{!! json_encode($assurance) !!},
                professions:{!! json_encode($profession) !!},
                newAntecedent: {
                    assurance_id: null,
                    nom_patient: null,
                    prenom_patient: null,
                    date_naiss: null,
                    profession_id: null,
                    adresse_patient: null,
                    contact_patient: null,
                    email_patient: null,
                    genre: null,
                    num_dossier: null,
                },


            },
            methods:{
                //permet d'afficher le formulaire de modification
                modifyMe:function(){
                    $('#updateMe').collapse('toggle')
                    this.isModif=!this.isModif
                    if(this.isModif){
                        this.isActive=false
                        $('#demo').collapse('hide')
                    }
                    else{

                        this.isActive=true
                    }
                },

                //permet d'afficher le formulaire d'ajout
                colapse:function(){
                    $('#demo').collapse('toggle')
                    this.bienvenue=!this.bienvenue
                    if (this.bienvenue){
                        this.message='Fermer'
                        this.isActive=false;
                    }
                    else{
                        this.message='Nouvel Patient'
                        this.isActive=true;
                    }

                },

                getAll:function(){
                    var app=this;
                    axios.get('/patients/index').then(function (res) {
                        for (let i=0;i<res.data.length;i++){
                            app.temp.push(res.data[i]);
                        }
                    }).catch((err) => {
                        console.log(err);
                    })

                },

                getAntecedent:function (id) {
                    var app=this
                    axios.get('/patients/'+id).then(function (res) {
                        app.currentAntecedent =res.data
                        app.modifyMe()
                    }).catch((err) => {
                        console.log(err);
                    })
                },

                addAntecedent: function() {
                    var app=this;
                        axios.post('/patients',app.newAntecedent).then((response) => {
                           $('#demo').collapse('hide')
                             app.isActive=true;
                            app.dt();
                            app.temp=[];
                            app.getAll();
                            toastr.options.progressBar = true;
                            toastr.success('Patient Enregistré',{timeOut: 3000});
                            app.newAntecedent.assurance_id=null
                            app.newAntecedent.nom_patient=null
                            app.newAntecedent.prenom_patient=null
                            app.newAntecedent.date_naiss=null
                            app.newAntecedent.profession_id=null
                            app.newAntecedent.adresse_patient=null
                            app.newAntecedent.contact_patient=null
                            app.newAntecedent.email_patient=null
                            app.newAntecedent.genre=null
                            app.newAntecedent.num_dossier=null

                        })
                            .catch((err) => {
                                console.log(err);
                            })
                },

                updateAntecedent: function() {
                    var app=this;
                    // console.log(app.currentAntecedent)
                    axios.put('/patients/'+this.currentAntecedent.id,this.currentAntecedent)
                        .then((response) => {

                            $('#updateMe').collapse('hide');
                            app.isModif=false
                            app.isActive=true
                            app.currentAntecedent = response.data
                            app.dt()
                            app.temp=[];
                            app.getAll();
                            toastr.options.progressBar = true;
                            toastr.success('Patient Modifié',{timeOut: 3000});
                        })
                        .catch((err) => {
                            console.log(err);
                        })
                },

                deleteAntecedent: function(id) {
                    var app=this
                    axios.get('/patients/verification/'+id).then(function (res) {
                        var sup=res.data
                        if (sup==='Non'){
                            toastr.options.progressBar = true;
                            toastr.error("Suppression Impossible,Patient en relation avec d'autres tables",{timeOut: 3000});
                        }
                        else {
                            axios.delete('/patients/'+id )
                                .then((response) => {
                                    app.dt();
                                    app.temp=[]
                                    app.getAll();
                                    toastr.options.progressBar = true;
                                    toastr.success('Patient Supprimé',{timeOut: 3000});
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
                closeModale(){
                    $('#editArticleModal').modal('hide');
                }
            },
            created: function(){
                this.getAll()
            },
            updated:function () {
                if (this.isActive){
                    this.bienvenue=false;
                    this.message='Nouvel Patient';
                }
            }
        });


    </script>
@endsection

@section('script-wizard')
    <script src="{{asset('js/paper-bootstrap-wizard.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>
@endsection
