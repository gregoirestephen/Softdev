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
                <small>Home > <a href="#">Fiche Patients</a></small>

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
                            Fiche Patient
                        </h2>
                    </div>

                    <div class="body">
                        @if(isset($pt))
                        <form @submit.prevent="search()">
                            @csrf
                            <div class="row clearfix mt-lg-4" style="margin: auto 27%;">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label  class="col-4 control-label">Nom Patient</label>
                                        <div class="col-6">
                                            <input type="text"  class="form-control" v-model="nom_patient" placeholder="Entrer le nom patient" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="col-6" style="margin-top: 30px;">
                                            <button type="submit" class="btn btn-primary">Rechercher</button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>
                        @endif

                        @if(isset($patient))
                            <div id="demo" class="collapse" :class="{'show':!yes}">
                            <div class="wizard-container">

                                <div class=" card wizard-card" data-color="red" id="wizardProfile">
                                    <form @submit.prevent="addAntecedent()">
                                        @csrf
                                        <div class="wizard-header text-center">
                                            <h3 class="wizard-title">Bienvenu sur la Fiche Patients</h3>
                                            <p class="category">Ces informations concernent le Patient.</p>
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
                                                        Patient
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#account" data-toggle="tab">
                                                        <div class="icon-circle">
                                                            <i class="material-icons">user</i>
                                                        </div>
                                                        Antecedent
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#address" data-toggle="tab">
                                                        <div class="icon-circle">
                                                            <i class="material-icons">user</i>
                                                        </div>
                                                        Medication
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane" id="about">
                                                <div class="clearfix">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label  class="col-4 control-label">Nom Patient</label>
                                                            <div class="form-line col-6">
                                                                <input type="text"  class="form-control" v-model="patients.nom_patient"  disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label  class="col-4 control-label">Prenom Patient</label>
                                                            <div class="form-line col-6">
                                                                <input type="text"  class="form-control" v-model="patients.prenom_patient" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="clearfix">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label  class="col-4 control-label">Date Naissance</label>
                                                            <div class="form-line col-6">
                                                                <input type="date"  class="form-control"  v-model="patients.date_naiss" disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label  class="col-4 control-label">Profession</label>
                                                            <div class="form-line col-6">
                                                                <input type="text"  class="form-control" id="profy" :value="patients.profession_id" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="clearfix">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label  class="col-4 control-label">Assurance</label>
                                                            <div class="form-line col-6">
                                                                <input type="text"  class="form-control" id="assury" v-model="patients.assurance_id" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="account">
                                                <div class="clearfix">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label  class="col-4 control-label">Nom Patient</label>
                                                            <div class="form-line col-6">
                                                                <input type="text"  class="form-control" v-model="patients.nom_patient"  disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-5">
                                                        <div class="form-group ">
                                                            <label  class="col-4 control-label">ANTECEDENTS</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row clearfix" v-for="antecedent in antecedents">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <input type="checkbox" :id="'md_checkbox'+antecedent.id" :value="antecedent.id" class="chk-col-red" v-model="resultats"/>
                                                            <label  class="col-4 control-label" :for="'md_checkbox'+antecedent.id">@{{antecedent.lib_ant}}</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <div class="form-line col-6">
                                                                <input  type="text" class="form-control" :id="'text'+antecedent.id" placeholder="Information supplementaire">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="address">
                                                <div class="clearfix">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label  class="col-4 control-label">Nom Patient</label>
                                                            <div class="form-line col-6">
                                                                <input type="text"  class="form-control" v-model="patients.nom_patient"  disabled>
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
                                                            <input type="checkbox" :id="'med_checkbox'+medication.id" :value="medication.id" class="chk-col-red" v-model="med"/>
                                                            <label  class="col-4 control-label" :for="'med_checkbox'+medication.id">@{{medication.lib_med}}</label>
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
                        </div >

                            <div class="card text-center" v-show="yes">
                                <h4 style="color: #ef0202;"> Votre modification a été pris en compte.</h4>
                                <h4 style="color: #ef0202;">Nous vous convions à effectuer de nouvelle recherche.</h4>
                            </div>
                        @endif
                        @if(isset($pt))
                            <div id="best" class="collapse show">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2 class="" style="margin: 10px 0px ;">
                                                    Table Patient
                                                </h2>
                                            </div>
                                            <div class="body">
                                                <div class="table-responsive">
                                                    <table class="table display table-bordered table-striped table-hover js-basic-example dataTable" id="example">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nom Patient</th>
                                                            <th>Prenom Patient</th>
                                                            <th>Aller vers sa fiche</th>
                                                        </tr>
                                                        </thead>
                                                        <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nom Patient</th>
                                                            <th>Prenom Patient</th>
                                                            <th> </th>
                                                        </tr>
                                                        </tfoot>
                                                        <tbody>

                                                        <tr  v-for="(p,index) in temp" :key="index" :index="index">
                                                            <td>@{{ ++index }}</td>
                                                            <td>@{{ p.nom_patient }}</td>
                                                            <td>@{{ p.prenom_patient }}</td>
                                                            <td>
                                                                <form action="{{route('patients.search')}}" method="POST">
                                                                    @csrf
                                                                    @method('GET')
                                                                    <input type="hidden"  class="form-control" name="nom_patient" :value="p.nom_patient" required>
                                                                    <input type="hidden"  class="form-control" name="prenom_patient" :value="p.prenom_patient" required>
                                                                    <button class="btn btn-success" type="submit">
                                                                        <span>
                                                                            <i class="material-icons">open_in_new</i>
                                                                        </span>
                                                                    </button>
                                                                </form>
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
{{--                            @else--}}
{{--                                <h3 class="text-center alert alert-danger">Aucune information concernant ce Patient</h3>--}}
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if(isset($patient))
@section('script-header')
    <script>
        const app = new Vue({
            el: '#app-b',
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
                patients:{!! json_encode($patient) !!},
                pAnt:{!! json_encode($pAnt) !!},
                pMed:{!! json_encode($pMed) !!},
                antecedents:{!! json_encode($antecedent) !!},
                medications:{!! json_encode($medication) !!},
                newAntecedent: {
                    patient_id: null,
                    antecedent_id: null,
                    autre_info:null,
                },
                newMedication: {
                    patient_id: null,
                    medication_id: null,
                },
            },
            methods:{
                isChecked:function(){
                    let app=this;
                    for(big in app.antecedents){
                        for(ant in app.pAnt){

                            if(app.pAnt[ant].antecedent_id === app.antecedents[big].id){
                                document.getElementById('md_checkbox'+app.pAnt[ant].antecedent_id ).checked = true;
                                document.getElementById('text'+app.pAnt[ant].antecedent_id ).value = app.pAnt[ant].autre_info;
                            }
                        }
                    }
                    for (medoc in app.medications){
                        for (m in app.pMed){
                            if(app.pMed[m].medication_id===app.medications[medoc].id){
                                document.getElementById('med_checkbox'+app.pMed[m].medication_id).checked = true;
                            }
                        }
                    }
                },

                getProfession:function (){
                    let app=this;
                    let profess={};
                    axios.get('/patients/profession/'+app.patients.profession_id).then(function (res){
                        profess=res.data
                        document.getElementById('profy').value=profess.libelle
                    })
                },

                getAssurance:function (){
                    let app=this;
                    let assur={};
                    axios.get('/patients/assurance/'+app.patients.assurance_id).then(function (res){
                        assur=res.data;
                        document.getElementById('assury').value=assur.nom_assurance
                    })


                },

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

                addAntecedent: function() {
                    var app=this;
                    if(app.resultats.length===0 && app.med.length===0){
                        for(ant in app.pAnt){
                           app.resultats.push(app.pAnt[ant].antecedent_id)
                        }

                        for (big in app.pMed){
                            app.med.push(app.pMed[big].medication_id)
                        }

                        for (let i=0;i<app.resultats.length;i++){
                            let formData = new FormData();
                            formData.append('patient_id',app.patients.id)
                            formData.append('antecedent_id',app.resultats[i])
                            formData.append('autre_info',document.getElementById('text'+app.resultats[i]).value)
                            axios.post('/ligne-antecedents',formData).then((response) => {
                                app.bienvenue=false;
                                $('#demo').collapse('hide')
                                this.isActive=true;
                                app.temp=[];
                                toastr.options.progressBar = true;
                                toastr.success(' Ligne Antecedent Enregistré',{timeOut: 3000});
                            })
                                .catch((err) => {
                                    console.log(err);
                                })
                        }

                        for (let i=0;i<app.med.length;i++) {
                            let formData = new FormData();
                            formData.append('patient_id', app.patients.id)
                            formData.append('medication_id', app.med[i])

                            axios.post('/ligne-medications',formData).then((response) => {
                                toastr.options.progressBar = true;
                                toastr.success(' Ligne Medication Enregistré',{timeOut: 3000});

                            })
                                .catch((err) => {
                                    console.log(err);
                                })
                        }
                        app.yes=true
                    }
                    else{

                            for (let i=0;i<app.resultats.length;i++){
                                let formData = new FormData();
                                formData.append('patient_id',app.patients.id)
                                formData.append('antecedent_id',app.resultats[i])
                                formData.append('autre_info',document.getElementById('text'+app.resultats[i]).value)
                                axios.post('/ligne-antecedents',formData).then((response) => {
                                    toastr.options.progressBar = true;
                                    toastr.success(' Ligne Antecedent Enregistré',{timeOut: 3000});


                                })
                                    .catch((err) => {
                                        console.log(err);
                                    })
                            }
                            for (let i=0;i<app.med.length;i++) {
                                let formData = new FormData();
                                formData.append('patient_id', app.patients.id)
                                formData.append('medication_id', app.med[i])

                                axios.post('/ligne-medications',formData).then((response) => {
                                    toastr.options.progressBar = true;
                                    toastr.success(' Ligne Medication Enregistré',{timeOut: 3000});

                                })
                                    .catch((err) => {
                                        console.log(err);
                                    })
                            }
                            app.yes=true

                    }
                },
            },

            mounted: function(){
                this.isChecked()
                this.getProfession()
                this.getAssurance()
            }
        });

    </script>
@endsection
@endif

@if(isset($pt))
@section('script-header')
    <script>
        const app = new Vue({
            el: '#app-b',
            data:{
                message:'Nouvel Patient',
                bienvenue:false,
                isActive:true,
                yes:false,
                name: 'Vue Instance #1',
                nom_patient:'',
                currentAntecedent:{},
                temp:{},
                noms:{!! json_encode($pt) !!},
                prenoms:{},


            },
            methods:{
                search:function (){

                    let app=this;
                    app.temp=[];
                    $('#example').find('td').remove();
                    axios.get('/patient/info/'+app.nom_patient).then(function (res){
                        app.temp=res.data;
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


