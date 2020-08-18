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
                <small>Home > <a href="https://datatables.net/" target="_blank">Ordonnance</a></small>

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
                            Table Ordonnance
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
                                            <h3 class="wizard-title">Formulaire d'Ordonnance</h3>
                                            <p class="category">Les informations saisies sont relative à l'edition d'une Ordonnance.</p>
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
                                                        Ordonnance
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="tab-content">

                                            <div class="row clearfix">
                                                <div class="col-sm-5">
                                                    <div class="form-group ">
                                                        <label  class="col-4 control-label">Reference Consultation</label>
                                                        <div class="col-6">
                                                            <select class="form-control" v-model="currentAntecedent.consultation_id" required>
                                                                <option :value="consultation.id" v-for="consultation in consultations" :key="consultation.id">CSLT00@{{consultation.id}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-5">
                                                    <div class="form-group ">
                                                        <label  class="col-4 control-label"></label>
                                                    </div>MEDICAMENT
                                                </div>
                                            </div>

                                            <div class="row clearfix" v-for="medication in medications">
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <input type="checkbox" :id="'Fmd_checkbox'+medication.id" :value="medication.id" class="chk-col-red" v-model="mod"/>
                                                        <label  class="col-4 control-label" :for="'Fmd_checkbox'+medication.id">@{{medication.nom_m}}</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <div class="form-line col-6">
                                                            <input  type="text" class="form-control" :id="'Ftext'+medication.id" placeholder="Renseigner la posologie">
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

                        <div id="demo" class="collapse">
                            <div class="wizard-container">

                                <div class=" card wizard-card" data-color="red" id="wizardProfile">
                                    <form @submit.prevent="addAntecedent()">
                                        @csrf
                                        <div class="wizard-header text-center">
                                            <h3 class="wizard-title">Formulaire d'Ordonnance</h3>
                                            <p class="category">Les informations saisies sont relative à l'edition d'une Ordonnance.</p>
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
                                                        Ordonnance
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="tab-content">

                                            <div class="row clearfix">
                                                <div class="col-sm-5">
                                                    <div class="form-group ">
                                                        <label  class="col-4 control-label">Reference Consultation</label>
                                                        <div class="col-6">
                                                            <select class="form-control" v-model="newAntecedent.consultation_id" required>
                                                                <option :value="consultation.id" v-for="consultation in consultations" :key="consultation.id">CSLT00@{{consultation.id}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-5">
                                                    <div class="form-group ">
                                                        <label  class="col-4 control-label"></label>
                                                    </div>MEDICAMENT
                                                </div>
                                            </div>

                                            <div class="row clearfix" v-for="medication in medications">
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <input type="checkbox" :id="'md_checkbox'+medication.id" :value="medication.id" class="chk-col-red" v-model="resultats"/>
                                                        <label  class="col-4 control-label" :for="'md_checkbox'+medication.id">@{{medication.nom_m}}</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <div class="form-line col-6">
                                                            <input  type="text" class="form-control" :id="'text'+medication.id" placeholder="Renseigner la posologie">
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
                                    <th>Reference Ordonnance</th>
                                    <th>Reference Consultation</th>
                                    <th>Etat Ordonnance</th>
                                    <th>Voir</th>
                                    <th>Annuler</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Reference Ordonnance</th>
                                    <th>Reference Consultation</th>
                                    <th>Etat Ordonnance</th>
                                    <th>Voir</th>
                                    <th>Annuler</th>
                                    <th>Supprimer</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                <tr  v-for="(p,index) in temp" :key="index" :index="index">
                                    <td>@{{ ++index }}</td>
                                    <td>ORD00@{{ p.id }}</td>
                                    <td>CSLT00@{{ p.consultation_id }}</td>
                                    <td>@{{ p.etat | etape }}</td>
                                    <td>
                                        <a type="button" class="btn btn-info btn-sm" data-toggle="modal"  @click.prevent="getAntecedent(p.id)" >
                                            <i class="material-icons">visibility</i>
                                            <span></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-warning btn-sm" data-toggle="modal"  @click.prevent="annuler(p.id)" >
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
                message:'Nouvel Ordonnance',
                bienvenue:false,
                mod:[],
                isActive:true,
                resultats:[],
                ferme:'Fermer',
                isModif:false,
                consultations:{!! json_encode($consultation) !!},
                medications:{!! json_encode($medicament) !!},
                oMed:{},
                newAntecedent: {
                    consultation_id: null,
                },


            },
            methods:{
                modifChecked(){
                    let app=this;
                    for (l in app.medications){
                        document.getElementById('Fmd_checkbox'+app.medications[l].id ).checked = false;
                        document.getElementById('Ftext'+app.medications[l].id ).value = '';
                    }

                    for(big in app.medications){
                        for(ant in app.oMed){
                            if(app.oMed[ant].medicament_id === app.medications[big].id){
                                document.getElementById('Fmd_checkbox'+app.oMed[ant].medicament_id ).checked = true;
                                document.getElementById('Ftext'+app.oMed[ant].medicament_id ).value = app.oMed[ant].posologie;
                            }
                        }
                    }

                    for(ant in app.oMed){
                        app.resultats.push(app.oMed[ant].medicament_id)
                    }
                },

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


                colapse:function(){
                    $('#demo').collapse('toggle')
                    this.bienvenue=!this.bienvenue
                    if (this.bienvenue){
                        this.message='Fermer'
                        this.isActive=false;
                    }
                    else{
                        this.message='Nouvel Ordonnance'
                        this.isActive=true;
                    }

                },
                getAll:function(){
                    var app=this;
                    axios.get('/ordonnances/index').then(function (res) {
                        for (let i=0;i<res.data.length;i++){
                            app.temp.push(res.data[i]);
                        }
                    }).catch((err) => {
                        console.log(err);
                    })

                },
                getAntecedent:function (id) {

                    var app=this
                    app.mod=[]
                    app.oMed={}
                    axios.get('/ordonnances/'+id).then(function (res) {
                        app.currentAntecedent =res.data
                            axios.get('/ordonnances/ligne-medicaments/'+app.currentAntecedent.id).then(function (res) {
                                app.oMed=res.data
                                app.modifyMe()
                                app.modifChecked()
                            })

                            }).catch((err) => {
                        console.log(err);
                    })
                },

                updateAntecedent(){

                },

                annuler: function (id) {
                    axios.get('/ordonnances/annuler/' + id).then(function (res) {
                        toastr.options.progressBar = true;
                        toastr.success('Ordonnance Annulé', {timeOut: 3000});
                        this.dt();
                        this.temp = []
                        this.getAll();
                    })
                },

                addAntecedent: function() {
                    var app=this;
                    let ordonnance=0;
                    if (app.resultats.length===0 || app.newAntecedent.consultation_id===null){
                        toastr.options.progressBar = true;
                        toastr.error('Veuillez selectionner un medicament',{timeOut: 3000});
                    }
                    else{
                        axios.post('/ordonnances',this.newAntecedent).then((response) => {
                            ordonnance=response.data;
                            toastr.options.progressBar = true;
                            toastr.success('Ordonnance Enregistré',{timeOut: 3000});

                            for (let i=0;i<app.resultats.length;i++){
                                let formData=new FormData();
                                formData.append('medicament_id',app.resultats[i])
                                formData.append('ordonnance_id',ordonnance)
                                formData.append('posologie',document.getElementById('text'+app.resultats[i]).value)
                                axios.post('/ligne-medicament',formData).then((response) => {
                                    $('#demo').collapse('hide')
                                    app.isActive=true;
                                    app.dt();
                                    app.temp=[];
                                    app.getAll();
                                    toastr.options.progressBar = true;
                                    toastr.success('Ligne Medicament Enregistré',{timeOut: 3000});
                                })
                            }
                            app.resultats=[];
                            app.newAntecedent.consultation_id=null
                        })
                            .catch((err) => {
                                console.log(err);
                            })
                    }

                },

                deleteAntecedent: function(id) {
                    axios.delete('/ordonnances/'+id )
                        .then((response) => {
                            this.dt();
                            this.temp=[]
                            this.getAll();

                            toastr.options.progressBar = true;
                            toastr.success('Ordonnance Supprimé',{timeOut: 3000});
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
                }

            },
            created: function(){
                this.getAll()
            },
            updated:function () {
                if (this.isActive){
                    this.bienvenue=false;
                    this.message='Nouvel Ordonnance';
                }
            }
        });


    </script>
@endsection

@section('script-wizard')
    <script src="{{asset('js/paper-bootstrap-wizard.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>
@endsection
