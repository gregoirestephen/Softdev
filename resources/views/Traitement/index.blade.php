@extends('home')

@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Gestion des patient
                <small>Home > <a href="https://datatables.net/" target="_blank">Traitements</a></small>

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
                            Table Traitement
                        </h2>
                    </div>
                    <div class="body">
                        <div class="button-demo">
                            <button type="button" class="btn bg-blue waves-effect" data-toggle="modal" data-target="#exampleModal">Nouvel Traitement</button>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nouvel Traitement</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form @submit.prevent="addAntecedent()">
                                            @csrf
                                            <div class="form-group">
                                                <label  class="col-4 control-label"> Nom Patient</label>
                                                <div class="col-6">
                                                    <select class="form-control" v-model="pat" @change="changeL($event)" required>
                                                        <option :value="patient.id" v-for="patient in patients" :key="patient.id">@{{patient.nom_patient}} @{{ patient.prenom_patient }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label  class="col-4 control-label">Acte En Cours</label>
                                                <div class="col-6">
                                                    <select class="form-control" v-model="newAntecedent.ligneacte_id" required>
                                                        <option :value="ligneacte.id" v-for="ligneacte in ligneactes" :key="ligneacte.id">@{{ligneacte.lib_actes}}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group mt-2">
                                                <label  class="col-4 control-label"> Libelle Dent</label>
                                                <div class="col-6">
                                                    <select class="form-control" v-model="newAntecedent.dent_id" required>
                                                        <option :value="dent.id" v-for="dent in dents" :key="dent.id">@{{dent.designation_dent}}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group mt-2">
                                                <label  class="col-4 control-label">Observation Traitement</label>
                                                <div class="form-line col-6">
                                                    <textarea class="form-control" v-model="newAntecedent.observation_trait" required>
                                                    </textarea>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label  class="col-4 control-label">Etat Traitement</label>
                                                <div class="col-6">
                                                    <select class="form-control" v-model="etape" required>
                                                        <option :value="1">En Cours</option>
                                                        <option :value="2">Cloturé</option>
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
                        <div class="table-responsive">

                            <div class="col-xs-8 col-sm-8 col-md-6 col-lg-3" style="margin-top: 20px;">
                                <div class="card">
                                    <div class="header">
                                        <h2>ACTE EFFECTUEE</h2>

                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table class="table table-hover dashboard-task-infos">
                                                <thead>
                                                <tr>
                                                    <th>Acte</th>
                                                    <th> </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(b,index) in actes" :key="index" :index="index">
                                                        <td>@{{b.lib_actes}}</td>
                                                        <td> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-8 col-sm-8 col-md-6 col-lg-9" style="margin-top: 20px;">
                                <div class="card">
                                    <div class="header">
                                        <h2>TRAITEMENT EFFECTUEE</h2>

                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table class="table table-hover dashboard-task-infos">
                                                <thead>
                                                <tr>
                                                    <th>Nom Patient</th>
                                                    <th>Acte</th>
                                                    <th>Observation</th>
                                                    <th>Dent</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr  v-for="(p,index) in traitements" :key="index" :index="index">
                                                        <td>@{{p.nom_patient}} @{{p.prenom_patient}}</td>
                                                        <td>@{{p.lib_actes}}</td>
                                                        <td>@{{p.observation_trait}}</td>
                                                        <td>@{{p.designation_dent}}</td>
                                                        <td>@{{p.date_trait}}</td>
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
                ligneactes:{},
                dents:{!! json_encode($dent) !!},
                patients:{!! json_encode($patient) !!},
                newAntecedent: {
                    ligneacte_id: null,
                    dent_id: null,
                    observation_trait: null,
                },
                pat:'',
                actes:{},
                traitements:{},
                etape:'',


            },
            methods:{
                changeL:function (event){
                    let app=this;
                    let idA=event.currentTarget.value;

                    axios.get('/traitement/lActe/'+idA).then(function (res){
                        app.ligneactes=res.data;
                        // console.log(res.data)
                    })
                },

                getTraitement:function(){
                    var app=this;
                    axios.get('/traitement/index/'+app.pat).then(function (res) {
                        app.traitements=res.data
                        // console.log(res.data)
                    }).catch((err) => {
                        console.log(err);
                    })
                },

                getActe:function(){
                    var app=this
                    axios.get('/traitement/actes/'+app.pat).then(function (res) {
                        app.actes=res.data
                        // console.log(res.data)
                    }).catch((err) => {
                        console.log(err);
                    })
                },

                addAntecedent: function() {
                    var app=this;
                    axios.post('/traitement',this.newAntecedent).then((response) => {
                        axios.get('/traitement/etat/'+app.newAntecedent.ligneacte_id+'/'+app.etape).then(function (res){
                            // console.log(res.data)
                        })
                        app.getActe()
                        app.getTraitement();
                        $('#exampleModal').modal('hide');
                        toastr.options.progressBar = true;
                        toastr.success(' Traitement Enregistré',{timeOut: 3000});
                        app.pat=''
                        app.newAntecedent.ligneacte_id=null
                        app.newAntecedent.reglement_id=null
                        app.newAntecedent.dent_id=null
                        app.newAntecedent.observation_trait=null
                        app.newAntecedent.date_trait=null
                    })
                        .catch((err) => {
                            console.log(err);
                        })
                },

                deleteAntecedent: function(id) {
                    axios.delete('/traitement/'+id )
                        .then((response) => {
                            this.dt();
                            this.getTraitement();
                            toastr.options.progressBar = true;
                            toastr.success(' Traitement Supprimé',{timeOut: 3000});
                        })
                        .catch((err) => {
                            console.log(err);
                        })
                },

                dt(){
                    $('#example').find('td').remove();
                },
            },

        });

    </script>
@endsection
