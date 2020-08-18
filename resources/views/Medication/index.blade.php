@extends('home')

@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Gestion des patient
                <small>Home > <a href="https://datatables.net/" target="_blank">Medication</a></small>

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
                            Table Medication
                        </h2>

                    </div>
                    <div class="body">
                        <div class="button-demo">
                            <button type="button" class="btn bg-blue waves-effect" data-toggle="modal" data-target="#exampleModal">Nouvel Medication</button>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nouvel Medication</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form @submit.prevent="addMedication()">
                                            @csrf
                                            <div class="form-group">
                                                <label  class="col-4 control-label">Libelle Medication</label>
                                                <div class="form-line col-6">
                                                    <input type="text" class="form-control  {{ $errors->has('lib_med') ? ' is-invalid' : '' }}" v-model="newMedication.lib_med" required>

                                                </div>
                                                @if ($errors->has('lib_ant'))
                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('lib_med') }}</strong>
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
                                    <td >@{{ p.lib_med }}</td>
                                    <td><a type="button" class="btn btn-warning btn-sm" data-toggle="modal"  @click.prevent="getMedication(p.id)" >
                                            <i class="material-icons">create</i>
                                            <span> </span>
                                        </a>

                                        <div class="modal fade" id="editArticleModal" tabindex="-1" role="dialog" aria-labelledby="editArticleModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modifier Medication</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form @submit.prevent="updateMedication()">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label  class="col-4 control-label">Libelle Medication</label>
                                                                <div class="form-line col-6">
                                                                    <input type="text" class="form-control  {{ $errors->has('lib_med') ? ' is-invalid' : '' }}" v-model="currentMedication.lib_med" required>

                                                                </div>
                                                                @if ($errors->has('lib_ant'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('lib_med') }}</strong>
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
                                        <button type="submit" class="btn btn-danger btn-sm " @click="deleteMedication(p.id)">
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
                currentMedication:{},
                temp:[],
                newMedication: { lib_med: null },


            },
            methods:{
                getAll:function(){
                    var app=this;
                    axios.get('/medications/index').then(function (res) {
                        for (let i=0;i<res.data.length;i++){
                            app.temp.push(res.data[i]);
                        }
                    }).catch((err) => {
                        console.log(err);
                    })

                },
                getMedication:function (id) {
                    var app=this
                    axios.get('/medications/'+id).then(function (res) {
                        app.currentMedication =res.data
                        $("#editArticleModal").modal('show');
                    }).catch((err) => {
                        console.log(err);
                    })
                },

                addMedication: function() {
                    var app=this;
                    axios.post('/medications',this.newMedication).then((response) => {
                        app.dt();
                        app.temp=[];
                        app.getAll();
                        $('#exampleModal').modal('hide');
                        toastr.options.progressBar = true;
                        toastr.success(' Medication Enregistré',{timeOut: 3000});
                        app.newMedication.lib_med=null
                    })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                updateMedication: function() {
                    var app=this;
                    axios.put('/medications/'+this.currentMedication.id,this.currentMedication)
                        .then((response) => {
                            this.currentMedication = response.data
                            $('#editArticleModal').removeClass("fade").modal('hide');
                            this.dt()
                            app.temp=[];
                            app.getAll();
                            toastr.options.progressBar = true;
                            toastr.success(' Medication Modifié',{timeOut: 3000});
                        })
                        .catch((err) => {
                            console.log(err);
                        })
                },
                deleteMedication: function(id) {
                    axios.delete('/medications/'+id )
                        .then((response) => {
                            this.dt();
                            this.temp=[]
                            this.getAll();
                            toastr.options.progressBar = true;
                            toastr.success(' Medication Supprimé',{timeOut: 3000});
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
