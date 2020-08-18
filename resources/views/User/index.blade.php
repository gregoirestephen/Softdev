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
                <small>Home > <a href="https://datatables.net/" target="_blank">Utilisateurs</a></small>

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
                            Table Utilisateur
                        </h2>
                    </div>
                    <div class="body">
                        <div class="button-demo">
                            <button type="button" class="btn bg-blue waves-effect" data-toggle="modal" data-target="#exampleModal">Nouvel Utilisateur</button>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nouvel Utilisateur</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form @submit.prevent="addAntecedent()">
                                            @csrf

                                            <div class="form-group ">
                                                <label  class="col-4 control-label">Nom Utilisateur</label>
                                                <div class="form-line col-6">
                                                    <input type="text"  class="form-control" v-model="newAntecedent.name" required>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label  class="col-4 control-label">Mot de passe Utilisateur</label>
                                                <div class="form-line col-6">
                                                    <input type="password"  class="form-control" v-model="newAntecedent.password" required>
                                                </div>
                                            </div>


                                            <div class="form-group ">
                                                <label  class="col-4 control-label">Email Utilisateur</label>
                                                <div class="form-line col-6">
                                                    <input type="email"  class="form-control" v-model="newAntecedent.email" required>
                                                </div>
                                            </div>


                                            <div class="form-group ">
                                                <label  class="col-4 control-label">Profil Utilisateur</label>
                                                <div class="col-6">
                                                    <select class="form-control" v-model="newAntecedent.profil_id" required>
                                                        <option :value="profil.id" v-for="profil in profils" :key="profil.id">@{{profil.lib_p}}</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group ">
                                                <label  class="col-4 control-label">Contact Utilisateur</label>
                                                <div class="form-line col-6">
                                                    <input type="number" minlength="8" class="form-control" v-model="newAntecedent.contact" required>
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
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reference Utilisateur</th>
                                    <th>Nom Utilisateur</th>
                                    <th>Email Utilisateur</th>
                                    <th>Profil Utilisateur</th>
                                    <th>Contact Utilisateur</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Reference Utilisateur</th>
                                    <th>Nom Utilisateur</th>
                                    <th>Email Utilisateur</th>
                                    <th>Profil Utilisateur</th>
                                    <th>Contact Utilisateur</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                <tr  v-for="(p,index) in temp" :key="index">
                                    <td>@{{ ++index }}</td>
                                    <td>USR00@{{ p.id }}</td>
                                    <td>@{{ p.name }}</td>
                                    <td>@{{p.email}}</td>
                                    <td >@{{p.lib_p}}</td>
                                    <td >@{{p.contact}}</td>
                                    <td><a type="button" class="btn btn-warning btn-sm" data-toggle="modal"  @click.prevent="getAntecedent(p.id)" >
                                            <i class="material-icons">create</i>
                                            <span> </span>
                                        </a>

                                        <div class="modal fade" id="editArticleModal" tabindex="-1" role="dialog" aria-labelledby="editArticleModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modifier Utilisateur</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form @submit.prevent="updateAntecedent()">
                                                            @csrf

                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Nom Utilisateur</label>
                                                                <div class="form-line col-6">
                                                                    <input type="text"  class="form-control" v-model="currentAntecedent.name" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Mot de passe Utilisateur</label>
                                                                <div class="form-line col-6">
                                                                    <input type="password"  class="form-control" v-model="currentAntecedent.password" required>
                                                                </div>
                                                            </div>


                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Email Utilisateur</label>
                                                                <div class="form-line col-6">
                                                                    <input type="email"  class="form-control" v-model="currentAntecedent.email" required>
                                                                </div>
                                                            </div>


                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Profil Utilisateur</label>
                                                                <div class="col-6">
                                                                    <select class="form-control" v-model="currentAntecedent.profil_id" required>
                                                                        <option :value="profil.id" v-for="profil in profils" :key="profil.id">@{{profil.lib_p}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label">Contact Utilisateur</label>
                                                                <div class="form-line col-6">
                                                                    <input type="number" minlength="8" class="form-control" v-model="currentAntecedent.contact" required>
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
            data:{
                name: 'Vue Instance #1',
                currentAntecedent:{},
                temp:[],
                profils:{!! json_encode($profil) !!},
                newAntecedent: {
                    profil_id: null,
                    name: null,
                    email: null,
                    contact: null,
                    password: null,
                },


            },
            methods:{
                getAll:function(){
                    var app=this;
                    axios.get('/users/index').then(function (res) {
                        for (let i=0;i<res.data.length;i++){
                            app.temp.push(res.data[i]);
                        }
                    }).catch((err) => {
                        console.log(err);
                    })

                },
                getAntecedent:function (id) {
                    var app=this
                    axios.get('/users/'+id).then(function (res) {
                        app.currentAntecedent =res.data
                        $("#editArticleModal").modal('show');
                    }).catch((err) => {
                        console.log(err);
                    })
                },

                addAntecedent: function() {
                    var app=this;
                    axios.post('/users',this.newAntecedent).then((response) => {
                        app.dt();
                        app.temp=[];
                        app.getAll();
                        $('#exampleModal').modal('hide');
                        toastr.options.progressBar = true;
                        toastr.success('Utilisateur Enregistré',{timeOut: 3000});
                        app.newAntecedent.profil_id=null
                        app.newAntecedent.name=null
                        app.newAntecedent.email=null
                        app.newAntecedent.contact=null
                        app.newAntecedent.password=null


                    })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                updateAntecedent: function() {
                    var app=this;
                    axios.put('/users/'+this.currentAntecedent.id,this.currentAntecedent)
                        .then((response) => {
                            this.currentAntecedent = response.data
                            this.dt()
                            app.temp=[];
                            app.getAll();
                            app.closeModale();
                            toastr.options.progressBar = true;
                            toastr.success('Utilisateur Modifié',{timeOut: 3000});
                        })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                deleteAntecedent: function(id) {
                    axios.delete('/users/'+id )
                        .then((response) => {
                            this.dt();
                            this.temp=[]
                            this.getAll();
                            toastr.options.progressBar = true;
                            toastr.success('Utilisateur Supprimé',{timeOut: 3000});
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
