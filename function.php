<?php
/*
*
* @author 			: Muhammad Syafrudin
*	@contact			: udinjust4u@yahoo.com
*	@description	: function.php is function for ecryption and decryption with libmcrypt
*
*	2012 @ Hak Cipta Milik Alloh Subhanahu wata'ala
*
*/
			
function enkripsi_plain($secretkey,$fileplain,$filecipher){
	
	/*Pemilihan Algoritma dan Mode Operasi*/
	$algoritma= MCRYPT_3DES;
	$mode= MCRYPT_MODE_CBC;
	
	/* Membuka Modul untuk memilih Algoritma & Mode Operasi */
	$td = mcrypt_module_open($algoritma, '', $mode, '');
	
	/* Inisialisasi IV dan Menentukan panjang kunci yang digunakan*/
	$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	$ks = mcrypt_enc_get_key_size($td);
					
	/* Menghasilkan Kunci */
	$key = $secretkey;
	
	/* Inisialisasi */
	mcrypt_generic_init($td, $key, $iv);

	/* Enkripsi Data, dimana hasil enkripsi harus di encode dengan base64.\ 
         Hal ini dikarenakan web browser tidak dapat membaca karakter-karakter\
         ASCII dalam bentuk simbol-simbol */
				 
	$buffer = $fileplain;
	$encrypted = mcrypt_generic($td, $buffer);		
	$encrypted1= base64_encode($iv).";".base64_encode($encrypted);
	$encrypted2= base64_encode($encrypted1);
	$filecipher= $encrypted2;
		
	/* Menghentikan proses enkripsi dan menutup modul */
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);
	
	/* Menampilkan Hasil enkripsi */
	
  echo "<td>Hasil Enkripsi </td><td>".$filecipher. "</td><br>";

}


/*  Fungsi dekripsi_cipher digunakan untuk dekripsi chipertext */

function dekripsi_cipher($iv,$secretkey,$fileplain,$filecipher){
	
	/*Pemilihan Algoritma dan Mode Operasi*/
	$algoritma= MCRYPT_3DES;
	$mode= MCRYPT_MODE_CBC;
	
	/* Membuka Modul untuk memilih Algoritma dan Mode Operasi */
	$td = mcrypt_module_open($algoritma, '', $mode, '');
	
	/* Inisialisasi IV dan Menentukan panjang kunci yang digunakan*/
	$iv = base64_decode($iv);
	$ks = mcrypt_enc_get_key_size($td);

	/* Menghasilkan Kunci */
	$key = $secretkey;

	/* Inisialisasi */
	mcrypt_generic_init($td, $key, $iv);
	
	/* Dekripsi Data */	
	$buffer = $filecipher;
	$buffer = base64_decode($buffer);
	$fileplain = mdecrypt_generic($td, $buffer);

	/* Menghentikan proses dekripsi dan menutup modul */
	mcrypt_generic_deinit($td);
  mcrypt_module_close($td);
    
  /* Menampilkan Hasil dekripsi */
	
  echo "<td>Hasil Dekripsi </td><td>".$fileplain."</td><br>";
    
}
?>