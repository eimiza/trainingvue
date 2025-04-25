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
    <div class="app">
        <h1>{{count}}</h1> <br>

        <tester multiply="10" @push="updateCount"></tester>
        <tester multiply="100" @push="updateCount"></tester>
        <tester multiply="1000" @push="updateCount"></tester>
    </div>

    <script>
        Vue.component('tester', {
            props: ['multiply'],
            data() {
                return {
                    localCount: 1,
                };
            },
            methods: {
                increment() {
                    this.localCount *= this.multiply;
                    this.$emit('push', this.localCount);
                }
            },
            template: '#tester-template',
        });
    </script>

    <script type="text/x-template" id="tester-template">
        <button @click="increment" class="btn btn-primary">Test {{localCount}}</button>
    </script>

    <script>
        new Vue({
            el: '.app',
            data: {
                message: 'Hello, Vue!',
                count: 0,
            },
            methods: {
                alertnow(){
                    alert('Hello, Vue!');
                },
                updateCount(valFormComponent) {
                    this.count = valFormComponent;
                }
            }
        });
    </script>
    
</body>
</html>