@extends('home')

@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Gestion des patient
                <small>Home > <a href="https://datatables.net/" target="_blank">Rdv > liste</a></small>

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
                            Table Rdv
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table display table-bordered table-striped table-hover js-basic-example dataTable" id="example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Objet Rdv</th>
                                    <th>Nom Patient</th>
                                    <th>Prenom Patient</th>
                                    <th>Tache à faire</th>
                                    <th>Date Rdv</th>
                                    <th>Heure</th>
                                    <th>Modifier</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Objet Rdv</th>
                                    <th>Nom Patient</th>
                                    <th>Prenom Patient</th>
                                    <th>Tache à faire</th>
                                    <th>Date Rdv</th>
                                    <th>Heure</th>
                                    <th>Modifier</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                <tr  v-for="(p,index) in temp" :key="index" :index="index">
                                    <td>@{{ ++index }}</td>
                                    <td>@{{ p.objet_rdv }}</td>
                                    <td>@{{ p.nom_patient }}</td>
                                    <td>@{{ p.prenom_patient }}</td>
                                    <td>@{{ p.tache_rdv }}</td>
                                    <td >@{{ p.date_rdv | moment}}</td>
                                    <td >@{{ p.heure_rdv }}H</td>
                                    <td>
                                        <a type="button" class="btn btn-warning btn-sm" data-toggle="modal"  @click.prevent="getAntecedent(p.id)" >
                                            <i class="material-icons">create</i>
                                            <span> </span>
                                        </a>

                                        <div class="modal fade" id="editArticleModal" tabindex="-1" role="dialog" aria-labelledby="editArticleModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modifier Rdv</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form @submit.prevent="updateAntecedent()">
                                                            @csrf

                                                            <div class="form-group ">
                                                                <label  class="col-4 control-label"> Nom Patient</label>
                                                                <div class="col-6">
                                                                    <select class="form-control" v-model="currentAntecedent.patient_id" disabled>
                                                                        <option :value="patient.id" v-for="patient in patients" :key="patient.id">@{{patient.nom_patient}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label  class="col-4 control-label">Objet Rdv</label>
                                                                <div class="form-line col-6">
                                                                    <textarea class="form-control" v-model="currentAntecedent.objet_rdv" disabled>
                                                                    </textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label  class="col-4 control-label">Tache a Faire</label>
                                                                <div class="form-line col-6">
                                                                    <textarea class="form-control" v-model="taches" required>
                                                                    </textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label  class="col-4 control-label">Date Rdv</label>
                                                                <div class="form-line col-6">
                                                                    <input type="date" class="form-control" v-model="currentAntecedent.date_rdv" disabled>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label  class="col-4 control-label">Heure Rdv(h)</label>
                                                                <div class="form-line col-6">
                                                                    <input type="number" class="form-control" v-model="currentAntecedent.heure_rdv" disabled>
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
                moment:function (date) {
                    return moment(date).format('DD MMMM YYYY');
                }
            },
            data:{
                name: 'Vue Instance #1',
                currentAntecedent:{},
                temp:[],
                patients:{!! json_encode($patient) !!},
                newAntecedent: {
                    patient_id: null,
                    objet_rdv: null,
                    date_rdv: null,
                    heure_rdv: null
                },
                taches:'',


            },
            methods:{
                getAll:function(){
                    var app=this;
                    axios.get('/rdv/index').then(function (res) {
                        for (let i=0;i<res.data.length;i++){
                            app.temp.push(res.data[i]);
                        }
                    }).catch((err) => {
                        console.log(err);
                    })

                },
                getAntecedent:function (id) {
                    var app=this
                    axios.get('/rdv/'+id).then(function (res) {
                        app.currentAntecedent =res.data
                        $("#editArticleModal").modal('show');
                    }).catch((err) => {
                        console.log(err);
                    })
                },
                updateAntecedent: function() {
                    var app=this;
                    console.log(app.taches)
                        axios.get('/rdv/todo/'+this.currentAntecedent.id+'/'+app.taches)
                            .then((response) => {
                                $('#editArticleModal').removeClass("fade").modal('hide');
                                this.dt()
                                app.temp=[];
                                app.getAll();
                                toastr.options.progressBar = true;
                                toastr.success('Rdv Modifié',{timeOut: 3000});
                            })
                            .catch((err) => {
                                console.log(err);
                            })

                },
                deleteAntecedent: function(id) {
                    axios.delete('/rdv/'+id )
                        .then((response) => {
                            this.dt();
                            this.temp=[]
                            this.getAll();
                            toastr.options.progressBar = true;
                            toastr.success('Rdv Supprimé',{timeOut: 3000});
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
