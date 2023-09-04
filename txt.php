<!DOCTYPE html>
<html>

<head>
	<title>Unggah Dokumen</title>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			body {
				font-family: Arial, Helvetica, sans-serif;
			}

			form {
				border: 3px solid #f1f1f1;
			}

			input[type=text],
			input[type=password] {
				width: 100%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				box-sizing: border-box;
			}

			button {
				background-color: #6c5ce7;
				color: white;
				padding: 14px 20px;
				margin: 8px 0;
				border: none;
				cursor: pointer;
				width: 100%;
			}

			button:hover {
				opacity: 0.8;
			}

			.container {
				padding: 16px;
			}

			span.psw {
				float: right;
				padding-top: 16px;
			}

			/* Change styles for span and cancel button on extra small screens */
			@media screen and (max-width: 300px) {
				span.psw {
					display: block;
					float: none;
				}

				.cancelbtn {
					width: 100%;
				}
			}

			table {
				border-collapse: collapse;
				width: 100%;
			}

			th,
			td {
				border: 1px solid #ddd;
				padding: 8px;
				text-align: left;
			}

			tr:nth-child(even) {
				background-color: #f2f2f2;
			}

			th {
				background-color: #4CAF50;
				color: white;
			}
		</style>
	</head>
</head>

<body>
	<div class="container">
		<p=align="center">
			<h2>Masukan Dokumen yang Diinginkan! </h2>
			<form id="uploadForm" method="post" enctype="multipart/form-data">
				<input type="file" name="berkas">
				<input type="submit" value="upload" name="upload">
			</form>
			<h3>Daftar File Unggahan</h3>
			<div id="file_list"></div>

			<div id="deskripsi" style="margin-top: 50px;"></div>
			<div id="tableContainer"></div>

			<a href="index.php">Logout</a>
	</div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function() {
		$("#uploadForm").on('submit', function(e) {
			e.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				type: 'POST',
				url: 'upload.php', // Ganti dengan alamat file PHP yang akan menangani unggahan
				data: formData,
				contentType: false,
				processData: false,
				success: function(response) {
					$("#response").html(response);
				}
			});
		});
	});

	$(document).ready(function() {
		$.ajax({
			url: 'list_file.php', // Ganti dengan alamat file PHP yang menghasilkan data
			method: 'GET', // Anda dapat mengganti metode sesuai kebutuhan (GET, POST, dll.)
			dataType: 'text', // Ganti dengan tipe data yang diharapkan dari respons PHP (text, json, xml, dll.)
			success: function(data) {
				// Menampilkan data dalam elemen dengan ID "dataContainer"
				$("#file_list").html(data);
			}
		});
	});
	$(document).ready(function() {
		$("#uploadForm").on('submit', function(e) {
			$(document).ready(function() {
				$.ajax({
					url: 'check_plagiarsm.php',
					method: 'GET',
					dataType: 'text',
					success: function(data) {
						console.log(data);
						var data_json = JSON.parse(data);
						console.log(data_json);
						$("#deskripsi").html(`Perbandingan di bawah ini dibuat oleh Copyscape, yang memeriksa ${data_json.querywords} kata dari teks yang ditempel.`)
						var result_datas = data_json.result
						
						$('table.myTable').remove();
						var table = $("<table>").addClass("myTable");

						// Buat baris header
						var headerRow = $("<tr>");
						headerRow.append($("<th>").text("URL"));
						headerRow.append($("<th>").text("Kata yang cocok"));
						headerRow.append($("<th>").text("Persen"));
						table.append(headerRow);

						// Buat beberapa baris data
						for (key in result_datas) {
							var dataRow = $("<tr>");
							dataRow.append($("<td>").text(result_datas[key].url));
							dataRow.append($("<td>").text(result_datas[key].minwordsmatched));
							dataRow.append($("<td>").text(Math.trunc(result_datas[key].minwordsmatched / data_json.querywords * 100) + " %"));
							table.append(dataRow);
						}

						// Tambahkan tabel ke elemen dengan ID "tableContainer"
						$("#tableContainer").append(table);
					}
				});
			});
		})
	})
</script>