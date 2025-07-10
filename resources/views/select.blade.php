<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Malasngoding.com - Membuat Dropdown Search Dengan PHP</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
	<div class="container-fluid mt-3">	
		<form method="POST">
			<select id="jurusan" name="jurusan">
				<option value="Teknik Informatika">Teknik Informatika</option>
				<option value="Ilmu Komputer">Ilmu Komputer</option>
				<option value="Sistem Informasi">Sistem Informasi</option>
				<option value="Teknik Sipil">Teknik Sipil</option>
				<option value="Teknik Kimia">Teknik Kimia</option>
				<option value="Teknik Industri">Teknik Industri</option>
				<option value="Teknik Elektro">Teknik Elektro</option>
			</select>
		</form>		
	</div>
</body>
 
<script type="text/javascript">	
	$(document).ready(function() {
		$('#jurusan').select2();
	});
</script>
</html>