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
                        <button @click="add_data()" type="button" class="btn btn-primary">Submit</button>
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

		<div class="container">
			<div class="row">
				<div class="col-md-12">
                    <button @click="show_add()" class="btn btn-primary">Add Data</button>
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
                                <td>{{index+1}}</td>
                                <td>{{item.name}}</td>
                                <td>{{item.gender}}</td>
                                <td>{{item.phone}}</td>
                                <td>{{item.faculty}}</td>
                                <td><button @click="show_edit(item)" class="btn btn-warning">Edit</button></td>
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

                // kemaskini data
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
                    $.post('student/api_student', function(res){
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
                        name: self.name,
                        gender: self.gender,
                        phone: self.phone,
                        faculty: self.faculty,
                    }, function(res){
                        $('#addDataModal').modal('hide');
                        self.get_list();
                        self.clear_input();
                        Swal.fire('Success', 'Data added successfully', 'success');
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
			},
            mounted() {
                this.get_list();
            }
		});
	</script>
    
</body>
</html>