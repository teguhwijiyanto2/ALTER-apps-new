<?php

/*
secretKey = h04n7eoPm9gAI/xLdLRoS8I4bL5uNWbdwa5e9VFZxHo= (provided by E2Pay) ---> 3lN1j3/tpRwmgcQFoq9/pyzgP77aRY7MBFhEIfiXQZ4=
Signature = Base64(HMAC-SHA256(<secretKey>, StringToSign))
StringToSign ==>
buffer.append(methodService);//Method Service
buffer.append("\n");
buffer.append(bankId);//Bank ID ---> 00000010
buffer.append("\n");
buffer.append(bankRefNo);//Bank Refference No
buffer.append("\n");
buffer.append(bankChannel);//Bank Channel ---> 6017
buffer.append("\n");
buffer.append(custId);//Customer ID
buffer.append("\n");
buffer.append(date);//Date

StringToSign ==>
inquiry						purchase
00000005					00000010
201803070001				202311140001
6017						6017
807400010001				081234000001
2018-09-17T18:27:00+0700	2023-11-15T19:11:00+0700
*Signature= nR6u+RtpLKGuXqDt2BFG1+Px47RE+9BTXe9fQ4uGdvw=
68b252d07f4dc0a5011744e48c5e6972311ed125edc18e52f610b2ef940cbcad
68b252d07f4dc0a5011744e48c5e6972311ed125edc18e52f610b2ef940cbcad
*/

//$StringToSign = "inquiry\n00000005\n201803070001\n6017\n807400010001\n2018-09-17T18:27:00+0700";
//$StringToSign = "inquiry0000000520180307000160178074000100012018-09-17T18:27:00+0700";

// nR6u+RtpLKGuXqDt2BFG1+Px47RE+9BTXe9fQ4uGdvw=

// 4.3.1 Mobile Prepaid / eWallet / Data Plan (hal 16)

//echo hash_hmac('sha256', 'The quick brown fox jumped over the lazy dog.', 'secret');

//echo base64_encode(hash_hmac('sha256', '$StringToSign', 'h04n7eoPm9gAI/xLdLRoS8I4bL5uNWbdwa5e9VFZxHo='));




/*
{
 "bankChannel" : "6017",
 "bankId" : "00000010",
 "bankRefNo" : "202311150004",
 "custAccNo" : "1111111111",
 "custId" : "081234000001",
 "dateTrx" : "2023-11-15T11:40:00Z",
 "payeeCode" : "10002",
 "productCode" : "1006"
}
*/


$StringToSign = "purchase<br>".
"00000010<br>".
"202312290001<br>".
"6017<br>".
"081234000001<br>".
"2023-12-29T11:40:00+0700<br>";


$StringToSign = "purchase";
$StringToSign .= "purchase";
00000010
";

echo nl2br($StringToSign);

/*
echo "
<form action='".$_SERVER['PHP_SELF']."' method='POST'>
string_to_sign : <textarea name='string_to_sign'></textarea>
<br><br>
keynya : <input type='text' name='keynya' value='3lN1j3/tpRwmgcQFoq9/pyzgP77aRY7MBFhEIfiXQZ4='>
<br><br>
<input type='submit' value='Submit'>
</form>
";
*/

//echo "<br><br><br>";
// ZmFmMmY0NGYxZTgwNTZkYTQwN2ZmNWEzOGFkOWNkNzczMDA4YzIxZjdlMzA4NTM3MDMxMjdjYmIwNDg0OGEyZg==

//$StringToSign = "inquiry\n00000005\n201803070001\n6017\n807400010001\n2018-09-17T18:27:00+0700";

//echo base64_encode(hash_hmac('sha256', '$StringToSign', '3lN1j3/tpRwmgcQFoq9/pyzgP77aRY7MBFhEIfiXQZ4=', true));
//echo hash_hmac('sha256', '$StringToSign', '3lN1j3/tpRwmgcQFoq9/pyzgP77aRY7MBFhEIfiXQZ4=');

/*
if(isset($_POST['string_to_sign']) && $_POST['string_to_sign'] !== "") {
	
	echo "<br><br><br>";

    $data = nl2br($StringToSign);
    $signatureSecretKey = "3lN1j3/tpRwmgcQFoq9/pyzgP77aRY7MBFhEIfiXQZ4=";
 
    $hash = hash_hmac('sha256', nl2br($_POST['string_to_sign']), urlencode($_POST['keynya']), true );
    $signature = base64_encode($hash);
 
    echo $signature;

} // if(isset($_POST['string_to_sign']) && $_POST['string_to_sign'] !== "") {
*/

?>

<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/hmac-sha256.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/components/enc-base64-min.js"></script>
 
<script>
    var data = "
purchase
00000010
202312290001
6017
081234000001
2023-12-29T11:40:00+0700";
    var signatureSecret = "3lN1j3/tpRwmgcQFoq9/pyzgP77aRY7MBFhEIfiXQZ4=";
 
    var hash = CryptoJS.HmacSHA256(data, signatureSecret);
    var signature = CryptoJS.enc.Base64.stringify(hash);
 
    //document.write(signature);
	//alert('aaa');
</script>
-->