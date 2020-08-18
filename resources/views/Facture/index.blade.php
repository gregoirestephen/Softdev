@extends('home')

@section('css-wizard')
    <link href="{{asset('css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('css/material-bootstrap-wizard.css')}}" rel="stylesheet" />
@endsection

@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Gestion des patients
                <small>Home > <a href="https://datatables.net/" target="_blank">Factures</a></small>

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
                            Table Facture
                        </h2>
                    </div>
                    <div class="body">
                        <div class="button-demo">
                            <button type="button" class="btn bg-blue waves-effect" @click.prevent="colapse()">@{{ message }}</button>
                        </div>

                        <div id="demo" class="collapse">

                            <div class="wizard-container">

                                <div class=" card wizard-card" data-color="red" id="wizardProfile">
                                    <form @submit.prevent="addAntecedent()" class="form invoice-item-repeater" >
                                        @csrf
                                        <div class="wizard-header text-center">
                                            <h3 class="wizard-title">Formulaire Factures</h3>
                                            <p class="category">Les informations saisies sont relatif a l'etablissement d'une facture.</p>
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
                                                        Facture
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#present" data-toggle="tab">
                                                        <div class="icon-circle">
                                                            <i class="material-icons">user</i>
                                                        </div>
                                                        Verification
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane" id="about">
                                                <div class="row clearfix">
                                                    <div class="col-sm-5">
                                                        <div class="form-group ">
                                                            <label  class="col-4 control-label"> Nom Patient</label>
                                                            <div class="col-6">
                                                                <select class="form-control " v-model="newAntecedent.patient_id" id="pt" required >
                                                                    <option :value="patient.id" v-for="patient in patients" :key="patient.id">@{{patient.nom_patient}} @{{patient.prenom_patient}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix" v-for="(listing,index) in listings">
                                                    <div class="col-sm-4">
                                                        <div class="form-group ">
                                                            <label  class="col-4 control-label">Acte</label>
                                                            <div class="col-8">
                                                                <select class="form-control selectpicker" v-model="listing.value" @change="changeMe($event,index)" :id="'fact_checkbox'+index" required>
                                                                    <option :value="acte.id" v-for="acte in actes" :key="acte.id">@{{acte.lib_actes}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group ">
                                                            <label  class="col-4 control-label">Prix</label>
                                                            <div class="form-line col-8">
                                                                <input type="text"  class="form-control"  :id="'text'+index" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group ">
                                                            <label  class="col-4 control-label">Supprimer</label>
                                                            <div class=" col-8">
                                                                <span class="btn btn-danger"><i class="material-icons" @click="supp(index)">delete</i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row clearfix " style="margin: 5px 0 0 5px;">
                                                    <button class="btn btn-info col-sm-2" @click="add()" style="color: white!important;">Ajouter un acte</button>
                                                </div>

                                            </div>

                                            <div class="tab-pane" id="present">

                                                <div class="row clearfix">
                                                    <div class="col-sm-5">
                                                        <div class="form-group ">
                                                            <label  class="col-4 control-label"> Nom Patient</label>
                                                            <div class="form-line col-6">
                                                               <input class="form-control" type="text" v-model="nom" id="patient" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row clearfix" v-for="(act,index) in verifyD">

                                                        <div class="col-sm-4">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Acte</label>
                                                                <div class="col-8">
                                                                    <input type="text"  class="form-control" v-model="act.lib_actes" :id="'pv'+index" disabled>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Prix</label>
                                                                <div class="form-line col-8">
                                                                    <input type="text"  class="form-control"  v-model="act.prix_actes" :id="'textv'+index" disabled>
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>

                                                <div class="row clearfix" >
                                                    <div class="col-sm-4">
                                                        <div class="form-group ">
                                                            <label  class="col-4 control-label">REMISE</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group ">
                                                            <div class="form-line col-8">
                                                                <input  type="number" min="0" class="form-control" id="remiseM" v-model="remise" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row clearfix" >
                                                    <div class="col-sm-4">
                                                        <div class="form-group ">
                                                            <label  class="col-4 control-label">TOTAL</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group ">
                                                            <div class="form-line col-8">
                                                                <input  type="text" class="form-control" id="totalM" v-model="total" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="wizard-footer">
                                            <div class="pull-right">
                                                <input type='button' class='btn btn-next btn-fill btn-danger btn-wd' name='next' @click.prevent="verifyMe()" value='Next' />
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
                        <div id="best" class="collapse " :class="{'show':isActive}">
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
                                        <th>Consulter</th>
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
                                        <th>Consulter</th>
                                        <th>Annuler</th>
                                        <th>Supprimer</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    <tr  v-for="(p,index) in temp" :key="index" :index="index">
                                        <td>@{{ ++index }}</td>
                                        <td>FACT00@{{ p.id }}</td>
                                        <td>@{{ p.nom_patient }}</td>
                                        <td>@{{ p.prenom_patient }}</td>
                                        <td>@{{ p.montant_fact }}</td>
                                        <td >@{{ p.montant_net }}</td>
                                        <td >@{{ p.montant_rest }}</td>
                                        <td >@{{ p.remise }}</td>
                                        <td>
                                            <a type="button" class="btn btn-info btn-sm"  @click.prevent="consulter(p.id)" >
                                                <i class="material-icons">visibility</i>
                                                <span></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a type="button" class="btn btn-warning btn-sm" @click.prevent="annuler(p.id)" >
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
            data:{
                name: 'Vue Instance #1',
                currentAntecedent:{},
                verifyD:[],
                message:'Nouvel Facture',
                bienvenue:false,
                isActive:true,
                resultats:[],
                listings: [{
                    value: ""
                }],
                total:0,
                net:0,
                remise:0,
                nom:'',
                temp:[],
                patients:{!! json_encode($patient) !!},
                actes:{!! json_encode($acte) !!},
                pActes:{},
                newAntecedent: {
                    patient_id:null,
                },
            },
            methods:{
                changeMe(event,index){
                     let app=this;
                    let idA=event.currentTarget.value;
                    axios.get('/factures/acte/'+idA).then(function (res) {
                        let actos=res.data;
                        // console.log(actos);
                        document.getElementById('text'+index ).value = actos.prix_actes;

                    })
                },

                supp:function(value){
                    this.listings.splice(value,1)
                },

                add: function (event) {
                    this.listings.push({
                        value: ""
                    });
                },

                isChecked(){
                    var calc=0
                    var app=this;
                    for(let i=0;i<app.verifyD.length;i++){
                        let val=Number(document.getElementById('textv'+i).value)
                        calc=calc+val
                    }
                    app.net=calc
                    app.total=calc-app.remise
                },

                verifyMe(){
                    let pat=''
                    let app=this;
                    if (app.newAntecedent.patient_id!==null){
                        axios.get('/factures/patient/'+this.newAntecedent.patient_id).then(function (res) {
                            pat=res.data;
                            app.nom=pat.nom_patient;
                        })
                        app.verifyD=[]
                        for(let i=0; i<app.listings.length;i++){
                            axios.get('/factures/acte/'+app.listings[i].value).then(function (res) {
                                app.verifyD.push(res.data)
                            })
                        }
                    }
                    else{
                        toastr.options.progressBar = true;
                        toastr.error('Veuillez renseigner le nom du patient',{timeOut: 3000});
                    }
                },

                colapse:function(){
                    $('#demo').collapse('toggle')
                    this.bienvenue=!this.bienvenue
                    if (this.bienvenue){
                        this.resultats=[]
                        this.remise=0
                        this.message='Fermer'
                        this.isActive=false;
                    }
                    else{
                        this.message='Ligne Antecedent'
                        this.isActive=true;
                    }

                },

                getAll:function(){
                    var app=this;
                    axios.get('/factures/index').then(function (res) {
                        for (let i=0;i<res.data.length;i++){
                            app.temp.push(res.data[i]);
                        }
                    }).catch((err) => {
                        console.log(err);
                    })
                },

                addAntecedent: function() {
                    var app=this;

                    if (app.total<=0){
                        toastr.options.progressBar = true;
                        toastr.error('Information non conforme,Veuillez verifiez les données saisies  ',{timeOut: 3000});
                    }
                    else {
                        let formData = new FormData();
                        formData.append('patient_id',app.newAntecedent.patient_id)
                        formData.append('montant_fact',app.total)
                        formData.append('montant_net',app.net)
                        formData.append('montant_rest',app.total)
                        formData.append('remise',app.remise)
                        axios.post('/factures',formData).then((response) => {
                           var id=response.data
                            toastr.options.progressBar = true;
                            toastr.success('Facture Enregistré',{timeOut: 3000});
                            //boucle d'enregistrement de la ligne Actes
                            for (let i=0;i<app.verifyD.length;i++){
                                let formData = new FormData();
                                formData.append('patient_id',app.newAntecedent.patient_id)
                                formData.append('acte_id',app.verifyD[i].id)
                                axios.post('/ligne-acte',formData).then((response) => {
                                    $('#demo').collapse('hide')
                                    app.isActive=true;
                                    app.dt();
                                    app.temp=[];
                                    app.getAll();
                                    toastr.options.progressBar = true;
                                    toastr.success(' Ligne Acte Enregistré',{timeOut: 3000});
                                    app.newAntecedent.patient_id=null
                                    app.resultats=[]
                                })
                            }
                        })
                    }
                },

                consulter(id){
                    axios.get('/fact/consultation/'+id).then(function (res) {
                        console.log(res.data)
                    })
                },

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
                            this.dt();
                            this.temp=[]
                            this.getAll();

                        }

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
                                        this.temp=[]
                                        this.getAll();
                                        toastr.options.progressBar = true;
                                        toastr.success(' Facture Supprimé',{timeOut: 3000});
                                    })
                                    .catch((err) => {
                                        console.log(err);
                                    })
                            }
                        })
                },

                dt(){
                    $('#example').find('td').remove();
                }
            },

            created: function(){
                this.getAll()
            },

            updated:function () {
                this.isChecked()
                if (this.isActive){
                    this.bienvenue=false;
                    this.message='Nouvel Facture';
                }
            }
        });

    </script>
@endsection

@section('script-wizard')
    <script src="{{asset('js/paper-bootstrap-wizard.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>
@endsection
