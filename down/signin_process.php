<?php


$email = $_POST["email"];
$passwort = $_POST["passwort"];


//Datenbank-Infos
$host = "localhost:3306";
$dbname = "dronestd_account";
$username1= "db_access";
$password = "aYOKWhS2lVntnAsB";

$conn = mysqli_connect($host, $username1, $password, $dbname);

if(mysqli_connect_errno())
{
    die("Verbindungsfehler: " . mysqli_connect_error() . "<br><br> Hier gehts zurück: 
    <a href='https://www.dronestd.de'>-><b>Startseite</b></a></p>");
}

//Checken nach Dopplungen

$sqlCheck = "SELECT username, email FROM user_account WHERE 
email = '$email' AND passwort = '$passwort'";
 
$result = $conn->query($sqlCheck);

if ($result->num_rows == 0){

    die("Anmeldedaten sind falsch!
    <br><br> Hier gehts zurück: 
    <a href='https://www.dronestd.de/down/sign-in.html'>-><b>Startseite</b></a></p>");

}


// Store the cipher method
$ciphering = "AES-128-CTR";
  
// Use OpenSSl Encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
  
// Non-NULL Initialization Vector for encryption
$encryption_iv = '1234567891011121';
  
// Store the encryption key
$encryption_key = "aylEwhyjpK2j21Ih1L";
  
// Use openssl_encrypt() function to encrypt the data
$encryption = openssl_encrypt($email, $ciphering, $encryption_key, $options, $encryption_iv);






echo "
<script type=\"text/javascript\">

localStorage.setItem('user','$encryption');
window.open('profile.html', '_self');

</script>
";

    