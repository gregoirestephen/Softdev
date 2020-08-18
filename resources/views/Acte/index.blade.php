@extends('home')

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Gestion des patient
                <small>Home > <a href="https://datatables.net/" target="_blank">Actes</a></small>

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
                            Table Acte
                        </h2>
                    </div>
                    <div class="body">
                        <div class="button-demo">
                            <button type="button" class="btn bg-blue waves-effect" data-toggle="modal" data-target="#exampleModal">Nouvel Acte</button>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nouvel Acte</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form @submit.prevent="addAntecedent()">
                                            @csrf
                                            <div class="form-group">
                                                <label  class="col-4 control-label">Libelle Acte</label>
                                                <div class="form-line col-6">
                                                    <input type="text" class="form-control  {{ $errors->has('lib_actes') ? ' is-invalid' : '' }}" v-model="newActe.lib_actes" required>

                                                </div>
                                                @if ($errors->has('lib_actes'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('lib_actes') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-4 control-label">Coefficient Acte</label>
                                                <div class="form-line col-6">
                                                    <input type="number" min="0" class="form-control  {{ $errors->has('coef_actes') ? ' is-invalid' : '' }}" v-model="newActe.coef_actes" required>

                                                </div>
                                                @if ($errors->has('coef_actes'))
                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('lib_ant') }}</strong>
                                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-4 control-label">Prix Acte</label>
                                                <div class="form-line col-6">
                                                    <input type="number" min="0" class="form-control  {{ $errors->has('prix_actes') ? ' is-invalid' : '' }}" v-model="newActe.prix_actes" required>

                                                </div>
                                                @if ($errors->has('prix_actes'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('prix_actes') }}</strong>
                                                    </span>
                                                @endif
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
                            <table class="table  display table-bordered table-striped table-hover js-basic-example dataTable" id="example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Libelle</th>
                                    <th>Coefficient</th>
                                    <th>Prix</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Libelle</th>
                                    <th>Coefficient</th>
                                    <th>Prix</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                <tr  v-for="(p,index) in temp" :key="index" >
                                    <td>@{{ ++index }}</td>
                                    <td >@{{ p.lib_actes }}</td>
                                    <td >@{{ p.coef_actes }}</td>
                                    <td >@{{ p.prix_actes }}</td>
                                    <td><a type="button" class="btn btn-warning btn-sm" data-toggle="modal"  @click.prevent="getAntecedent(p.id)" >
                                            <i class="material-icons">create</i>
                                            <span> </span>
                                        </a>

                                        <div class="modal fade" id="editArticleModal" tabindex="-1" role="dialog" aria-labelledby="editArticleModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modifier Acte</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form @submit.prevent="updateAntecedent()">
                                                            @csrf

                                                            <div class="form-group">
                                                                <label  class="col-4 control-label">Libelle Acte</label>
                                                                <div class="form-line col-6">
                                                                    <input type="text" class="form-control  {{ $errors->has('lib_actes') ? ' is-invalid' : '' }}" v-model="currentActe.lib_actes" required>

                                                                </div>
                                                                @if ($errors->has('lib_actes'))
                                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('lib_actes') }}</strong>
                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label  class="col-4 control-label">Coefficient Acte</label>
                                                                <div class="form-line col-6">
                                                                    <input type="number" min="0" class="form-control  {{ $errors->has('coef_actes') ? ' is-invalid' : '' }}" v-model="currentActe.coef_actes" required>

                                                                </div>
                                                                @if ($errors->has('coef_actes'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('lib_ant') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label  class="col-4 control-label">Prix Acte</label>
                                                                <div class="form-line col-6">
                                                                    <input type="number" min="0" class="form-control  {{ $errors->has('prix_actes') ? ' is-invalid' : '' }}" v-model="currentActe.prix_actes" required>

                                                                </div>
                                                                @if ($errors->has('prix_actes'))
                                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('prix_actes') }}</strong>
                                                    </span>
                                                                @endif
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
                currentActe:{},
                temp:[],
                newActe: {
                    lib_actes: null,
                    coef_actes:null,
                    prix_actes:null,
                },


            },
            methods:{
                getAll:function(){
                    var app=this;
                    axios.get('/actes/index').then(function (res) {
                        for (let i=0;i<res.data.length;i++){
                            app.temp.push(res.data[i]);
                        }
                    }).catch((err) => {
                        console.log(err);
                    })

                },
                getAntecedent:function (id) {
                    var app=this
                    axios.get('/actes/'+id).then(function (res) {
                        app.currentActe =res.data
                        $("#editArticleModal").modal('show');
                    }).catch((err) => {
                        console.log(err);
                    })
                },

                addAntecedent: function() {
                    var app=this;
                    axios.post('/actes',this.newActe).then((response) => {
                        app.dt();
                        app.temp=[];
                        app.getAll();
                        $('#exampleModal').modal('hide');
                        toastr.options.progressBar = true;
                        toastr.success(' Acte Enregistré',{timeOut: 3000});
                        app.newActe.lib_actes=null
                        app.newActe.coef_actes=null
                        app.newActe.prix_actes=null

                    })
                        .catch((err) => {
                            console.log(err);
                        })
                },

                updateAntecedent: function() {
                    var app=this;
                    axios.put('/actes/'+this.currentActe.id,this.currentActe)
                        .then((response) => {
                            this.currentActe = response.data
                            $('#editArticleModal').removeClass("fade").modal('hide');
                            this.dt()
                            app.temp=[];
                            app.getAll();
                            toastr.options.progressBar = true;
                            toastr.success(' Acte Modifié',{timeOut: 3000});
                        })
                        .catch((err) => {
                            console.log(err);
                        })
                },

                deleteAntecedent: function(id) {
                    axios.delete('/actes/'+id )
                        .then((response) => {
                            this.dt();
                            this.temp=[]
                            this.getAll();
                            toastr.options.progressBar = true;
                            toastr.success(' Acte Supprimé',{timeOut: 3000});
                        })
                        .catch((err) => {
                            console.log(err);
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
