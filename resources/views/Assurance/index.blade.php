@extends('home')

@section('content')


    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Gestion des patient
                <small>Home > <a href="https://datatables.net/" target="_blank">Assurances</a></small>

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
                            Table Assurance
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="button-demo">
                            <button type="button" class="btn bg-blue waves-effect" data-toggle="modal" data-target="#exampleModal">Nouvel Assurance</button>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nouvel Assurance</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form @submit.prevent="addAssurance()">
                                            @csrf
                                            <div class="form-group ">
                                                <label  class="col-4 control-label">Nom Assurance</label>
                                                <div class="form-line col-6">
                                                    <input type="text"  class="form-control  {{ $errors->has('nom_assurance') ? ' is-invalid' : '' }}" v-model="newAssurance.nom_assurance" required>

                                                </div>
                                                @if ($errors->has('nom_assurance'))
                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('nom_assurance') }}</strong>
                                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label  class="col-4 control-label">Adresse Assurance</label>
                                                <div class="form-line col-6">
                                                    <input type="text"   class="form-control  {{ $errors->has('adr_assurance') ? ' is-invalid' : '' }}" v-model="newAssurance.adr_assurance"  required>
                                                </div>
                                                @if ($errors->has('adr_assurance'))
                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('adr_assurance') }}</strong>
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
                            <table class="table display table-bordered table-striped"  id="example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                <tr  v-for="(p,index) in temp" :key="index" :index="index">
                                    <td>@{{ ++index }}</td>
                                    <td >@{{ p.nom_assurance }}</td>
                                    <td>@{{ p.adr_assurance}}</td>
                                    <td>

                                        <a type="button" class="btn btn-warning btn-sm" data-toggle="modal"  @click.prevent="getAssurance(p.id)" >
                                            <i class="material-icons">create</i>
                                            <span> </span>
                                        </a>

                                        <div class="modal fade" id="editArticleModal" tabindex="-1" role="dialog" aria-labelledby="editArticleModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modifier Assurance</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form @submit.prevent="updateAssurance()">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label  class="col-4 control-label">Nom Assurance</label>
                                                                <div class="form-line col-6">
                                                                    <input type="text" class="form-control  {{ $errors->has('nom_assurance') ? ' is-invalid' : '' }}" v-model="currentAssurance.nom_assurance" required>

                                                                </div>
                                                                @if ($errors->has('nom_assurance'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('nom_assurance') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            <div class="form-group">
                                                                <label  class="col-4 control-label">Adresse Assurance</label>
                                                                <div class="form-line col-6">
                                                                    <input type="text"  class="form-control  {{ $errors->has('adr_assurance') ? ' is-invalid' : '' }}" v-model="currentAssurance.adr_assurance"  required>
                                                                </div>
                                                                @if ($errors->has('adr_assurance'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('adr_assurance') }}</strong>
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
                                        <button type="submit" class="btn btn-danger btn-sm " @click="deleteAssurance(p.id)">
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
                currentAssurance:{},
                temp:[],
                newAssurance: { nom_assurance: null, adr_assurance: null },


            },
            methods:{
                getAll:function(){
                    var app=this;
                    axios.get('/assurances/index').then(function (res) {
                        for (let i=0;i<res.data.length;i++){
                            app.temp.push(res.data[i]);
                        }
                    }).catch((err) => {
                        console.log(err);
                    })

                },
                getAssurance:function (id) {
                    var app=this
                    axios.get('/assurances/'+id).then(function (res) {
                        app.currentAssurance =res.data
                        $("#editArticleModal").modal('show');
                    }).catch((err) => {
                        console.log(err);
                    })
                },

                addAssurance: function() {
                    var app=this;
                    axios.post('/assurances',this.newAssurance).then((response) => {
                        app.dt();
                        app.temp=[];
                        app.getAll();
                        $('#exampleModal').modal('hide');
                        toastr.options.progressBar = true;
                        toastr.success(' Assurance Enregistré',{timeOut: 3000});
                        app.newAssurance.nom_assurance=null
                        app.newAssurance.adr_assurance=null
                    })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                updateAssurance: function() {
                    var app=this;
                    axios.put('/assurances/'+this.currentAssurance.id,this.currentAssurance)
                        .then((response) => {
                            this.currentAssurance = response.data
                            $('#editArticleModal').removeClass("fade").modal('hide');
                            this.dt()
                            app.temp=[];
                            app.getAll();
                            toastr.options.progressBar = true;
                            toastr.success(' Assurance Modifié',{timeOut: 3000});
                        })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                deleteAssurance: function(id) {
                    var app=this
                    axios.get('/assurances/verification/'+id).then(function (res) {
                        var result=res.data
                        if(result>0){
                            toastr.options.progressBar = true;
                            toastr.error('Suppression impossible, Assurance en relation avec un patient',{timeOut: 3000});
                        }
                        else {
                            axios.delete('/assurances/'+id )
                                .then((response) => {
                                    $('#example').find('td').remove();
                                    app.temp=[]
                                    app.getAll();
                                    toastr.options.progressBar = true;
                                    toastr.success(' Assurance Supprimé',{timeOut: 3000});
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
                }

            },
            created: function(){
                this.getAll()
            }
        });


    </script>
@endsection
