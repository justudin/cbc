<html>
<head>
<title>Enkripsi dan Dekripsi dengan Mode CBC</title>
</head>
<body>
<h1>Enkripsi dan Dekripsi dengan Mode CBC</h1>
<table>
<form action="" method="post">
<tr>
	<td>Masukkan Kunci</td>
	<td><input type="text" name="key" /></td>
</tr>
<tr>
	<td>Masukkan Plaintext / Ciphertext</td>
	<td><textarea name="plaintext" rows="5" cols="30"></textarea></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" name="enkripsi" value="encrypt" /><input type="submit" name="dekripsi" value="decrypt" /></td>
</tr>
<tr>
<?php
// include-kan librari untuk proses encrypt dab decrypt
include "function.php";

if ($_POST['enkripsi'] == 'encrypt'){
	if (!empty($_POST['key'])){
		if (!empty($_POST['plaintext'])){
			$secretkey = $_POST['key'];
			$fileplain = $_POST['plaintext'];
			/* Memanggil fungsi enkripsi_plain algoritma blok*/
			enkripsi_plain($secretkey,$fileplain,$cipher);
		}else{
			echo "Masukan String yang akan dienkripsi";
		}
	}	else {
		echo "Masukkan kata kunci";
	}	
} else if ($_POST['dekripsi'] == 'decrypt'){
	if (!empty($_POST['key'])){
		if (!empty($_POST['plaintext'])){
			$secretkey = $_POST['key'];
			$filecipher = $_POST['plaintext'];
			/* Ciphertext harus didecode base64 terlebih dahulu */
					$filecipher=base64_decode($filecipher);
			/* Memisahkan IV dengan Ciphertext, dimana ciphertext \
                           sebelumnya yang sudah di decode dengan base64\
                           merupakan gabungan IV dengan ciphertext (teks sandi)\
                           asli */
				list($iv,$filecipher)= split (";", $filecipher);
			dekripsi_cipher($iv,$secretkey,$fileplain,$filecipher);
				}else{
			echo "Masukan String yang akan dienkripsi";
		}
	}	else {
		echo "Masukkan kata kunci";
	}	
}
?>
</tr>
</form>
</table>
</body>
</html>
