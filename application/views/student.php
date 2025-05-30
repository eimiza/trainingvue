<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.16/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
	<div id="app">

    <div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="addDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDataModalLabel">Add Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" v-model="form.name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select v-model="form.gender" id="gender" class="form-control" required>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input v-model="form.phone" type="text" id="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="faculty">Faculty</label>
                            <input v-model="form.faculty" type="text" id="faculty" class="form-control" required>
                        </div>
                        <button v-if="form.name != '' && form.gender != '' && form.phone != '' && form.faculty != ''" @click="add_data()" type="button" class="btn btn-primary">Submit</button>
                        <button v-else disabled type="button" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editDataModal" tabindex="-1" role="dialog" aria-labelledby="addDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDataModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" v-model="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select v-model="gender" id="gender" class="form-control" required>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input v-model="phone" type="text" id="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="faculty">Faculty</label>
                            <input v-model="faculty" type="text" id="faculty" class="form-control" required>
                        </div>
                        <button @click="edit_data()" type="button" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

		<div class="container"><br>
			<div class="row">
				<div class="col-md-12">
                    <button @click="show_add()" class="btn btn-primary">Add Data</button>
                    <button @click="batch_delete()" v-show="sel_id.length > 0" class="btn btn-danger">Batch Delete Data</button>
				</div>
			</div>
            <br>
            <div class="row">
                <div class="col-md-7">
                    <input type="text" class="form-control" placeholder="Search" v-model="search">
                </div>
                <div class="col-md-3">
                    <select class="form-control" v-model="sel_gender">
                        <option value="">All</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button @click="get_list()" class="btn btn-primary btn-block">Find Now</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>faculty</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in data">
                                <td>
                                    <input type="checkbox" v-model="sel_id" :value="item.id">
                                    {{index+1}}
                                </td>
                                <td>{{item.name}}</td>
                                <td>{{convert_gender(item.gender)}}</td>
                                <td>{{item.phone}}</td>
                                <td>{{item.faculty}}</td>
                                <td>
                                    <button @click="show_edit(item)" class="btn btn-warning">Edit</button>
                                    <button @click="delete_data(item.id)" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>

	</div>

	<script>
		new Vue({
			el: '#app',
			data: {
				message: 'hello world',
                data: [],
				visible: false,
                sel_id: [],
                search: '',
                sel_gender: '',

                // kemaskini data
                form: {},
                id: '',
                name: '',
                gender: '',
                phone: '',
                faculty: '',
			},
			methods: {
				showAlert(num) {
					alert(num);
					this.visible = true;
				},
                show_add(){
                    $('#addDataModal').modal('show');
                },
                show_edit(item){
                    this.id = item.id;
                    this.name = item.name;
                    this.gender = item.gender;
                    this.phone = item.phone;
                    this.faculty = item.faculty;
                    $('#editDataModal').modal('show');
                },
                get_list(){
                    var self = this;
                    $.post('student/api_student', {
                        search: self.search,
                        sel_gender: self.sel_gender,
                    }, function(res){
                        self.data = res;
                    });
                },
                clear_input(){
                    this.name = '';
                    this.gender = '';
                    this.phone = '';
                    this.faculty = '';
                },
                add_data(){
                    var self = this;
                    $.post('student/api_add', {
                        form: self.form,
                    }, function(res){
                        console.log(res);
                        if(res.status == 'error'){
                            Swal.fire('Error', res.message, 'error');
                            return;
                        }else{
                            $('#addDataModal').modal('hide');
                            self.get_list();
                            self.clear_input();
                            Swal.fire('Success', 'Data added successfully', 'success');
                        }
                        
                    });
                },
                edit_data(){
                    var self = this;
                    $.post('student/api_edit', {
                        id: self.id,
                        name: self.name,
                        gender: self.gender,
                        phone: self.phone,
                        faculty: self.faculty,
                    }, function(res){
                        $('#editDataModal').modal('hide');
                        self.get_list();
                        self.clear_input();
                        Swal.fire('Success', 'Data edit successfully', 'success');
                    });
                },
                convert_gender(code){
                    if(code == 'M'){
                        return 'Male';
                    }else{
                        return 'Female'
                    }
                },
                delete_data(id){
                    var self = this;
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post('student/api_delete', {id: id}, function(res){
                                self.get_list();
                                Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                            });
                        }
                    })
                },
                batch_delete(){
                    var self = this;
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post('student/api_delete_batch', {id: self.sel_id}, function(res){
                                self.get_list();
                                self.sel_id = [];
                                Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                            });
                        }
                    })
                }
			},
            watch: {
                sel_gender: function(){
                    this.get_list();
                },
                search: function(){
                    this.get_list();
                },
            },
            mounted() {
                this.get_list();
            }
		});
	</script>
    
</body>
</html>