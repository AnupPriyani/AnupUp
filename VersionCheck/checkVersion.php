<?php
// check for required fields user_contact_no

// array for JSON response
$response = array();
$storelink = "https://play.google.com/store/apps/details?id=";

if (isset($_GET['storeUrl']))  
{
    $storeUrl = $_GET['storeUrl'];
	$version = getAndroidVersion($storeUrl);
	$response["message"] = $version;
	$response["success"] = $version;
	 // echoing JSON response
    echo json_encode($response);
}
else 
{
    // required field is missing
    $response["success"] = $version;
    $response["message"] = $version;
	

    // echoing JSON response
    echo json_encode($response);
}

public function getAndroidVersion(string $storeUrl): string
{
    $dom = new DOMDocument();
    $dom->loadHTML(file_get_contents("https://play.google.com/store/apps/details?id=com.king.wifimeter.signalstrength.dp&hl=en"));
    libxml_use_internal_errors(false);
    $elements = $dom->getElementsByTagName('span');

    $depth = 0;
    foreach ($elements as $element) {
        foreach ($element->attributes as $attr) {
            if ($attr->nodeName === 'class' && $attr->nodeValue === 'htlgb') {
                $depth++;
                if ($depth === 7) {
                    return preg_replace('/[^0-9.]/', '', $element->nodeValue);
                    break 2;
                }
            }
        }
    }
}

/*Write the scripts to extract the latitude and longitude from your URL*/
?>