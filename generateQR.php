<?php
include('./phpqrcode/qrlib.php');
include('configQR.php');

$whitelist = array("");

foreach ($whitelist as $email) {
    if (strpos($_POST["gegevens"], $email) !== false) {
    

        $naarJson = json_encode($_POST);
        $vanJson = json_decode($naarJson, true);
        $inputString = $vanJson["gegevens"];
        
        //Hier stond een incryptor, maar die heb ik er uitgehaald voor veiligheid.
        
        $tempDir = "codes/";
        
        $codeContents = "https://wintergames.sd-lab.nl/scanQR.php?data=" . $encryption;
        
        $fileName = 'GLR_WG2021_'.md5($codeContents).'.png';
        
        $pngAbsoluteFilePath = $tempDir.$fileName;
        $urlRelativeFilePath = $tempDir.$fileName;
        
        if (!file_exists($pngAbsoluteFilePath)) {
            QRcode::png($codeContents, $pngAbsoluteFilePath);
        };

        $gegevens->code = $pngAbsoluteFilePath;

        $myJSON = json_encode($gegevens);

        echo $myJSON;

        $checkQuery = "SELECT * FROM `qrcodes` WHERE userdata = '{$encryption}'";
        
        $checkResult = mysqli_query($mysqli, $checkQuery);

        if (!mysqli_num_rows($checkResult)>0) {
            $query = "INSERT INTO `qrcodes` VALUES ('{$encryption}', 0)";
            $result = mysqli_query($mysqli, $query);
            if (!$result) {
                echo "Error";
                echo $query . "<br/>";
                echo mysqli_error($mysqli);	
            }
        }
        return true;
    }
}
echo '{"error":"not_whitelisted"}';


?>