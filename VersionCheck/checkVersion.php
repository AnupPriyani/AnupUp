<?php
// check for required fields user_contact_no

// array for JSON response
$response = array();

if (isset($_GET['storeUrl']))  
{
    $storeUrl = $_GET['storeUrl'];
	$dom = new DOMDocument();
    $dom->loadHTML(file_get_contents($storeUrl));
    libxml_use_internal_errors(false);
    $elements = $dom->getElementsByTagName('span');

    $depth = 0;
    foreach ($elements as $element) {
        foreach ($element->attributes as $attr) {
            if ($attr->nodeName === 'class' && $attr->nodeValue === 'htlgb') {
                $depth++;
                if ($depth === 7) {
					$app_version = preg_replace('/[^0-9.]/', '', $element->nodeValue)
                    return $app_version;
                    break 2;
                }
            }
        }
    }
	$response["message"] = $app_version;
	 // echoing JSON response
    echo json_encode($response);
}

/*Write the scripts to extract the latitude and longitude from your URL*/
?>