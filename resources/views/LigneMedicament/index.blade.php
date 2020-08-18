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
                <small>Home > <a href="https://datatables.net/" target="_blank">Ligne Medicament</a></small>

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
                            Table Ligne Medicament
                        </h2>
                    </div>
                    <div class="body">
                        <div class="button-demo">
                            <button type="button" class="btn bg-blue waves-effect" data-toggle="modal" data-target="#exampleModal">Nouvel Ligne Medicament</button>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nouvel Ligne Medicament</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form @submit.prevent="addAntecedent()">
                                            @csrf
                                            <div class="form-group ">
                                                <label  class="col-4 control-label">Reference Ordonnance</label>
                                                <div class="col-6">
                                                    <select class="form-control" v-model="newAntecedent.ordonnance_id" required>
                                                        <option :value="ordonnance.id" v-for="ordonnance in ordonnances" :key="ordonnance.id">ORD00@{{ordonnance.id}}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label  class="col-4 control-label"> Libelle Medicament</label>
                                                <div class="col-6">
                                                    <select class="form-control" v-model="newAntecedent.medicament_id" required>
                                                        <option :value="medicament.id" v-for="medicament in medicaments" :key="medicament.id">@{{medicament.nom_m}}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label  class="col-4 control-label">Posologie</label>
                                                <div class="form-line col-6">
                                                    <textarea  class="form-control" v-model="newAntecedent.posologie" required>
                                                    </textarea>
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
                                    <th>Reference Consultation</th>
                                    <th>Reference Ordonnance</th>
                                    <th>Libelle Medicament</th>
                                    <th>Posologie</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Reference Consultation</th>
                                    <th>Reference Ordonnance</th>
                                    <th>Libelle Medicament</th>
                                    <th>Posologie</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                <tr  v-for="(p,index) in temp" :key="index" :index="index">
                                    <td>@{{ ++index }}</td>
                                    <td>CSLT00@{{ p.consultation_id}}</td>
                                    <td>ORD00@{{ p.ordonnance_id }}</td>
                                    <td>@{{ p.nom_m }}</td>
                                    <td>@{{ p.posologie }}</td>
                                    <td><a type="button" class="btn btn-warning btn-sm" data-toggle="modal"  @click.prevent="getAntecedent(p.id)" >
                                            <i class="material-icons">create</i>
                                            <span> </span>
                                        </a>

                                        <div class="modal fade" id="editArticleModal" tabindex="-1" role="dialog" aria-labelledby="editArticleModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modifier Ligne Medicament</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form @submit.prevent="updateAntecedent()">
                                                            @csrf

                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Reference Ordonnance</label>
                                                                <div class="col-6">
                                                                    <select class="form-control" v-model="currentAntecedent.ordonnance_id" required>
                                                                        <option :value="ordonnance.id" v-for="ordonnance in ordonnances" :key="ordonnance.id">ORD00@{{ordonnance.id}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label"> Libelle Medicament</label>
                                                                <div class="col-6">
                                                                    <select class="form-control" v-model="currentAntecedent.medicament_id" required>
                                                                        <option :value="medicament.id" v-for="medicament in medicaments" :key="medicament.id">@{{medicament.nom_m}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Posologie</label>
                                                                <div class="form-line col-6">
                                                                <textarea  class="form-control" v-model="currentAntecedent.posologie" required>
                                                                </textarea>
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
                medicaments:{!! json_encode($medicament) !!},
                ordonnances:{!! json_encode($ordonnance) !!},
                newAntecedent: {
                    medicament_id: null,
                    ordonnance_id: null,
                    posologie: null,
                },
            },
            methods:{
                getAll:function(){
                    var app=this;
                    axios.get('/ligne-medicament/index').then(function (res) {
                        for (let i=0;i<res.data.length;i++){
                            app.temp.push(res.data[i]);
                        }
                    }).catch((err) => {
                        console.log(err);
                    })

                },
                getAntecedent:function (id) {
                    var app=this
                    axios.get('/ligne-medicament/'+id).then(function (res) {
                        app.currentAntecedent =res.data
                        $("#editArticleModal").modal('show');
                    }).catch((err) => {
                        console.log(err);
                    })
                },

                addAntecedent: function() {
                    var app=this;
                    axios.post('/ligne-medicament',this.newAntecedent).then((response) => {
                        app.dt();
                        app.temp=[];
                        app.getAll();
                        $('#exampleModal').modal('hide');
                        toastr.options.progressBar = true;
                        toastr.success(' Ligne Medicament Enregistré',{timeOut: 3000});
                    })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                updateAntecedent: function() {
                    var app=this;
                    axios.put('/ligne-medicament/'+this.currentAntecedent.id,this.currentAntecedent)
                        .then((response) => {
                            this.currentAntecedent = response.data
                            this.dt()
                            app.temp=[];
                            app.getAll();
                            app.closeModale();
                            toastr.options.progressBar = true;
                            toastr.success(' Ligne Medicament Modifié',{timeOut: 3000});
                        })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                deleteAntecedent: function(id) {
                    axios.delete('/ligne-medicament/'+id )
                        .then((response) => {
                            this.dt();
                            this.temp=[]
                            this.getAll();
                            toastr.options.progressBar = true;
                            toastr.success(' Ligne Medicament Supprimé',{timeOut: 3000});
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
