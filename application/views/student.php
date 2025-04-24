<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
	<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16/dist/vue.js"></script>
</head>
<body>
	<div id="app">

		<div class="container">
			<div class="row">
				<div class="col-md-12">

					{{message}}
				
				</div>
			</div>
		</div>

	</div>

	<script>
		new Vue({
			el: '#app',
			data: {
				message: 'hello world',
				visible: false,
			},
			methods: {
				showAlert(num) {
					alert(num);
					this.visible = true;
				}
			}
		});
	</script>
</body>
</html>