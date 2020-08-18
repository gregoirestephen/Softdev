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
                <small>Home > <a href="https://datatables.net/" target="_blank">Professions</a></small>

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
                            Table Profession
                        </h2>
                    </div>
                    <div class="body">
                        <div class="button-demo">
                            <button type="button" class="btn bg-blue waves-effect" data-toggle="modal" data-target="#exampleModal">Nouvel Profession</button>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nouvel Profession</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form @submit.prevent="addAntecedent()">
                                            @csrf
                                            <div class="form-group ">
                                                <label  class="col-4 control-label">Libelle Profession</label>
                                                <div class="form-line col-6">
                                                    <input type="text"  class="form-control  {{ $errors->has('lib_ant') ? ' is-invalid' : '' }}" v-model="newAntecedent.libelle" required>

                                                </div>
                                                @if ($errors->has('lib_ant'))
                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('lib_ant') }}</strong>
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
                            <table class="table display table-bordered table-striped table-hover js-basic-example dataTable" id="example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Libelle</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Libelle</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                <tr  v-for="(p,index) in temp" :key="index" :index="index">
                                    <td>@{{ ++index }}</td>
                                    <td >@{{ p.libelle }}</td>
                                    <td><a type="button" class="btn btn-warning btn-sm" data-toggle="modal"  @click.prevent="getAntecedent(p.id)" >
                                            <i class="material-icons">create</i>
                                            <span> </span>
                                        </a>

                                        <div class="modal fade" id="editArticleModal" tabindex="-1" role="dialog" aria-labelledby="editArticleModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modifier Profession</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form @submit.prevent="updateAntecedent()">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label  class="col-4 control-label">Libelle Profession</label>
                                                                <div class="form-line col-6">
                                                                    <input type="text" class="form-control  {{ $errors->has('lib_ant') ? ' is-invalid' : '' }}" v-model="currentAntecedent.libelle" required>

                                                                </div>
                                                                @if ($errors->has('lib_ant'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('lib_ant') }}</strong>
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
            props:{
                index:Number,
            },
            data:{
                name: 'Vue Instance #1',
                currentAntecedent:{},
                temp:[],
                newAntecedent: { libelle: null },


            },
            methods:{
                getAll:function(){
                    var app=this;
                    axios.get('/professions/index').then(function (res) {
                        for (let i=0;i<res.data.length;i++){
                            app.temp.push(res.data[i]);
                        }
                    }).catch((err) => {
                        console.log(err);
                    })

                },
                getAntecedent:function (id) {
                    var app=this
                    axios.get('/professions/'+id).then(function (res) {
                        app.currentAntecedent =res.data
                        $("#editArticleModal").modal('show');
                    }).catch((err) => {
                        console.log(err);
                    })
                },

                addAntecedent: function() {
                    var app=this;
                    axios.post('/professions',this.newAntecedent).then((response) => {
                        app.dt();
                        app.temp=[];
                        app.getAll();
                        $('#exampleModal').modal('hide');
                        toastr.options.progressBar = true;
                        toastr.success('Profession Enregistré',{timeOut: 3000});
                        app.newAntecedent.libelle=null


                    })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                updateAntecedent: function() {
                    var app=this;
                    axios.put('/professions/'+this.currentAntecedent.id,this.currentAntecedent)
                        .then((response) => {
                            this.currentAntecedent = response.data
                            $('#editArticleModal').removeClass("fade").modal('hide');
                            this.dt()
                            app.temp=[];
                            app.getAll();
                            toastr.options.progressBar = true;
                            toastr.success('Profession Modifié',{timeOut: 3000});
                        })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                deleteAntecedent: function(id) {
                     var app=this
                    axios.get('/professions/verification/'+id).then(function (res) {
                        var result=res.data
                        if(result>0){
                            toastr.options.progressBar = true;
                            toastr.error('Suppression impossible, Profession en relation avec un patient',{timeOut: 3000});
                        }
                        else{
                            axios.delete('/professions/'+id )
                                .then((response) => {
                                    $('#example').find('td').remove();
                                    app.temp=[]
                                    app.getAll();
                                    toastr.options.progressBar = true;
                                    toastr.success('Profession Supprimé',{timeOut: 3000});
                                })
                                .catch((err) => {
                                    console.log(err);
                                })
                        }
                    }).catch((err) => {
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
