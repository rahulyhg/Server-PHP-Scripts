<?php
  header('Access-Control-Allow-Origin: http://localhost:4200');
  header('Access-Control-Allow-Credentials: true');

  require __DIR__.'/vendor/autoload.php';

  use Kreait\Firebase\Factory;
  use Kreait\Firebase\ServiceAccount;

  $serviceAccount = (new ServiceAccount)
      ->withProjectId("advanced-digital-displays")
      ->withClientId("114045346770698252717")
      ->withClientEmail("firebase-adminsdk-wlb5s@advanced-digital-displays.iam.gserviceaccount.com")
      ->withPrivateKey("-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDts1LMnvEAq3Jj\nvhDaDmeta7KCHasuLz3bUeKl334VeckIdT3qngl/EppFgze5oEvt4q4tggf8hdCw\nxgkljkXKJPqaKxzZ2DNAz+xCHZRHR5hcn+7SxAtJ/e3f9LlEKVh8ci1wsZjaSnpP\nsUX22qJDnHn1LY48HGKWgj0fDMYH3k6m8rwpcu3GKmTTe+SbCWaiUOegBv/+GNOi\nWiqyD6hHh1vaTbNtyk8DkVqTJQtSd+WNFmUdo89c+HJjN9L46Dfe5qUX6VxIf1cU\n8jpOi3/X/XYoMcVjn01eZT62xvvoBbxLqQwsac35PylDLA4+uTQSOjz4SbtN212M\n2IGv9nN1AgMBAAECggEAEL5viDNwBZyOH8GNPVcDbZ9nASxm2QeB43emsAmIv6mH\nBD4CAQtl3tooHNpr6/sDLjwoCdOdjWe9th4VGdymROGK954u15eXsKqU2Wls/wJn\nlKq9b4JYyzsEbSC3hjolXgrK8aPJASN67y8tHwDyqjGVE7TETq6vMSv2cz/6mSYo\ngfbJE0gWhxRmxR8YrdM2VcQ8Eol8//KAB92tYknkrNIeMbRMrdoOBeS4Q7dCyFwv\nPoiJBKcJ5QDdGQuzJYiwNggmD9rl+N4AdbNFe4Ag30C6P49ru/qvO5plhjgCjKaI\nwrtC/n3RL6+Em3h0EQNbVncRALDmaRlpAj9VoUy8FwKBgQD43JVXUut9zcllTqDg\ndxeRwUdaFrPZtVC3xLJAs44AIGfw0vhGPjHkWLQ3YvLGUkIX28/JCHoHIMxs0orF\no/2Fi7V6/o3mLd2jfD/+RK17f3FjYQYYfv5JXUhGAMCgXTzg1aMBxXVCFBgxqNQA\nAToLpX++owLyuOnoMVVasL0qHwKBgQD0hMhOPLFQr28eizZb2BcyvCEaCjj5O2rd\nizaNv+JlpwmDYeq9qv5f21842Kl3ZrCLIvCEAWsvyqwrKuAAwjJUIBmCKJvvcuMQ\nFNDHdfCEiF69gK4c4vEwdkBCreYm75D3HhLPYsds5YdwjA+2/IJ+TdGQV1Vq5MAZ\nWg0uq3gX6wKBgGo3m/Y9ig2T+9WljbzAl+q6F/43mmPdo6oL5hj/iig7rKF5Kkaw\n3RKdWa4aKYzEJzmPtEwVth+8vAPmiRx6Ngb97mOkqmQIR4Uzzwxzu6fuaTMFgliK\nO3aMvgBC6fSIVyePh5eF89pUQU9Qw8uMun2mEbQIV4XJruxPwiKHNPX5AoGBAMuc\nqmOj3I9wltpbWFegmKixyeqyKoE3viRfoXzmFTNKpfxWlC9+bTYLKb7fhDaeN1KV\nNKzntYblgPqtSDy5eUleNX+SK094XqXsf3IovrDOEf5BYjtBq1AMmDQuNOGlShTN\nYSJ6gdAnTeIlb4yTtmJQkLpeTw2lEGXL/AAp3uYjAoGAaFfEoehod1kg/kyW7b1a\n+S8pd3UUWLdIfpwoS5NPtKdeebqJvEyN4eOaQR1KvuZT/ne6RnMJIqYb9OqXyFt3\nGkkXZyBDIZPgsNfwaQbTCsHTWnzpt5z8pmY3+3uJ4DbPZQrbtzNUVgmleUnazhRm\ns5AL+KmQmXvPPpBr7fuyMNI=\n-----END PRIVATE KEY-----\n");

  $firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

  $database = $firebase->getDatabase();
  $reference = $database->getReference('application_data/auth/freshbooks');
  $value = $reference->getValue();
  $bearer = $value["bearer"];
  $refresh = $value["refresh"];
  $email = $_POST['email'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $business_name = $_POST['bname'];
  $p_address = $_POST['paddress'];
  $p_city = $_POST['pcity'];
  $p_code = $_POST['pcode'];
  $p_suburb = $_POST['psuburb'];
  $p_country = $_POST['pcountry'];
  $s_code = $_POST['scode'];
  $s_address = $_POST['saddress'];
  $s_suburb = $_POST['ssuburb'];
  $s_country = $_POST['scountry'];
  $s_city = $_POST['scity'];
  $mob_phone = $_POST['mphone'];
  $currency = "AUD";
  mainFunction();

  function mainFunction() {

    $data = array("client" => array("email" => $GLOBALS['email'], "fname" => $GLOBALS['fname'], "lname" => $GLOBALS['lname'], "organization" => $GLOBALS['business_name'], "currency_code" => $GLOBALS['currency'], "s_city" => $GLOBALS['s_city'], "s_street" => $GLOBALS['s_address'], "s_province" => $GLOBALS['s_suburb'], "s_code" => $GLOBALS['s_code'], "s_country" => $GLOBALS['s_country'], "p_city" => $GLOBALS['p_city'], "p_street" => $GLOBALS['p_address'], "p_province" => $GLOBALS['p_suburb'], "p_code" => $GLOBALS['p_code'], "p_country" => $GLOBALS['p_country'], "home_phone" => $GLOBALS['mob_phone']));
    $data_string = json_encode($data);

    // create curl resource
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_URL, "https://api.freshbooks.com/accounting/account/e5gw4/users/clients");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Api-Version: alpha",
      "Content-Type: application/json",
      "Authorization: Bearer " . $GLOBALS['bearer']
      ));

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);
    echo $output;

    $json = json_decode($output);

    if($json->response->errors[0]->errno == 1003) {
      refreshToken();
    };
  }

  function refreshToken() {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.freshbooks.com/auth/oauth/token",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\n    \"grant_type\": \"refresh_token\",\n    \"client_secret\": \"3aa2e1fe4b23f48831bf599a7c25d11000da64beba8022664fa03d0116eaeeb9\",\n    \"refresh_token\": \"" . $GLOBALS['refresh']. "\",\n    \"client_id\": \"d77f06721aa04bd38e7981ea042108465ed1b29bbe94c3b4463c9d46120d7e39\",\n    \"redirect_uri\": \"http://advanceddigitladisplays.com\"\n}",
      CURLOPT_HTTPHEADER => array(
        "api-version: alpha",
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: 471a0741-8466-2e3f-0006-8b9c3794ef9d"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      $json = json_decode($response);
      $bearer = $json->access_token;
      $refresh = $json->refresh_token;
      $database->getReference('application_data/auth/freshbooks/bearer')->set($bearer);
      $database->getReference('application_data/auth/freshbooks/refresh')->set($refresh);
      mainFunction();
    }
  }

?>
