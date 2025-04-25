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
        <div class="container mt-5">
            <h1 class="text-center">Course Assign</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#tab1">Student</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#tab2">Course Assign</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#tab3">Tab3</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#tab4">Tab4</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" >
                                <div class="tab-pane fade show active" id="tab1">
                                        <data-list :data="student"></data-list>
                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    Course Assign content goes here
                                </div>
                                <div class="tab-pane fade" id="tab3">
                                    Tab3 content goes here
                                </div>
                                <div class="tab-pane fade" id="tab4">
                                    Tab4 content goes here
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        Vue.component('data-list', {
            props: ['data'],
            template: '#data-list',
            methods: {
                assignUser() {
                    alert('Assigning user...');
                }
            }
        });
    </script>

    <script type="text/x-template" id="data-list">
        <div>
            <h2>Student List</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Faculty</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in data" :key="index">
                        <td>{{ index+1 }}</td>
                        <td>{{item.name}}</td>
                        <td>{{item.gender}}</td>
                        <td>{{item.phone}}</td>
                        <td>{{item.faculty}}</td>
                        <td><button @click="assignUser" class="btn btn-primary">Course</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </script>

    <script>
        new Vue({
            el: '#app',
            data: {
                message: 'Hello, Vue!',
                student: [],
                course: [],
            },
            methods: {
                reverseMessage() {
                    this.message = this.message.split('').reverse().join('');
                },
                get_student(){
                    var self = this;
                    $.post('student/api_student', {
                        search: self.search,
                        sel_gender: self.sel_gender,
                    }, function(res){
                        self.student = res;
                    });
                }
            },
            mounted() {
                this.get_student();
            }
        });
    </script>
</body>
</html>