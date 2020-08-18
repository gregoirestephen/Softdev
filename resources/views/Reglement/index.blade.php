@extends('home')

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Gestion des patient
                <small>Home > <a href="https://datatables.net/" target="_blank">Reglements</a></small>

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
                            Table Reglement
                        </h2>
                    </div>
                    <div class="body">
                        <div class="button-demo">
                            <button type="button" class="btn bg-blue waves-effect" data-toggle="modal" data-target="#exampleModal">Nouvel reglement</button>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nouvel Reglement</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form @submit.prevent="addAntecedent()">
                                            @csrf

                                            <div class="form-group mb-2 ">
                                                <label  class="col-4 control-label"> Nom Patient</label>
                                                <div class="col-6">
                                                    <select class="form-control" v-model="pat" @change="changeF($event)" required>
                                                        <option :value="patient.id" v-for="patient in patients" :key="patient.id">@{{patient.nom_patient}} @{{ patient.prenom_patient }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label  class="col-4 control-label"> Reference Facture</label>
                                                <div class="col-6">
                                                    <select class="form-control" v-model="newAntecedent.facture_id" @change="changeM($event)" required>
                                                        <option :value="facture.id" v-for="facture in factures" :key="facture.id">FACT00@{{facture.id}}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label  class="col-4 control-label">Montant restant</label>
                                                <div class="form-line col-6">
                                                    <input type="text"  class="form-control" min="0" v-model="reste" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label  class="col-4 control-label">Montant Reglé</label>
                                                <div class="form-line col-6">
                                                    <input type="number" min="0" class="form-control" v-model="newAntecedent.montant_regle" required>
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
                                    <th>Reference Facture</th>
                                    <th>Reference Reglement</th>
                                    <th>Nom Patient</th>
                                    <th>Montant Reglé</th>
                                    <th>Date reglement</th>
                                    <th>Voir</th>
                                    <th>Annuler</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Reference Facture</th>
                                    <th>Reference Reglement</th>
                                    <th>Nom Patient</th>
                                    <th>Montant Reglé</th>
                                    <th>Date reglement</th>
                                    <th>Voir</th>
                                    <th>Annuler</th>
                                    <th>Supprimer</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                <tr  v-for="(p,index) in temp" :key="index" :index="index">
                                    <td>@{{ ++index }}</td>
                                    <td>FACT00@{{ p.facture_id }}</td>
                                    <td>REG00@{{ p.id }}</td>
                                    <td>@{{ p.nom_patient }} @{{ p.prenom_patient }}</td>
                                    <td>@{{ p.montant_regle }}</td>
                                    <td >@{{ p.date_reg }}</td>
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
                temp:[],
                reste:0,
                factures:{},
                patients:{!! json_encode($patient) !!},
                pat:'',
                newAntecedent: {
                    facture_id:null,
                    montant_regle:null,
                },


            },
            methods:{

                changeF(event){
                    let app=this;
                    let temp=0
                    let id=event.currentTarget.value;
                    axios.get('/fact/'+id).then(function (res) {
                        app.factures=res.data

                    })
                },

                changeM(event){
                    let app=this;
                    let temp=0
                    let id=event.currentTarget.value;
                    axios.get('/reg/'+id).then(function (res) {
                        temp=res.data
                        app.reste=temp.montant_rest
                    })
                },

                getAll:function(){
                    var app=this;
                    axios.get('/reglements/index').then(function (res) {
                        for (let i=0;i<res.data.length;i++){
                            app.temp.push(res.data[i]);
                        }
                    }).catch((err) => {
                        console.log(err);
                    })
                },

                consulter:function (id){
                    axios.get('/reglement/consultation/'+id).then(function (){
                    })
                },

                addAntecedent: function() {
                    let app=this;
                    let somme=0
                    if (this.newAntecedent.montant_regle<=this.reste ){
                        axios.post('/reglements',this.newAntecedent).then((response) => {
                            somme=response.data
                            axios.get('/reglement/facture/'+app.newAntecedent.facture_id+'/'+somme).then(function (res) {
                                app.dt();
                                app.temp=[];
                                app.getAll();
                                $('#exampleModal').modal('hide');
                                toastr.options.progressBar = true;
                                toastr.success('Reglement Enregistré',{timeOut: 3000});
                                app.reste=0
                                app.newAntecedent.facture_id=null
                                app.newAntecedent.montant_regle=null
                                app.pat=''
                            })


                        })
                            .catch((err) => {
                                console.log(err);
                            })
                    }
                    else{
                        toastr.options.progressBar = true;
                        toastr.error('Veuillez renseigner un montant correcte',{timeOut: 3000});
                    }

                },

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

                deleteAntecedent: function(id) {
                    axios.delete('/reglements/'+id )
                        .then((response) => {
                            this.dt();
                            this.temp=[]
                            this.getAll();
                            toastr.options.progressBar = true;
                            toastr.success('Reglement Supprimé',{timeOut: 3000});
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
            }
        });


    </script>
@endsection
