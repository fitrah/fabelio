<?php 
/**
 * HTML Scrapper
 *
 * @author Fitrah Hidayat
 *
 * @param var $url     The url to be scrape.
 * 
 * @return array
 */
 
function fabelio($url){
	libxml_use_internal_errors(true);
	//$url = 'http://localhost/fabelio/fabelio.html';
	$data = file_get_contents($url); 
	
	$doc_detail = new DOMDocument();
	$doc_detail->loadHTML($data);
	
	foreach ($doc_detail->getElementsByTagName('span') as $span) {
		if ($span->getAttribute('data-ui-id') == "page-title-wrapper") {
			$title = $span->nodeValue;
		}
		
		if (strpos($span->getAttribute('id'),"product-price-") !== false) {
			$product_price = $span->getAttribute('data-price-amount');
		}
	}
	
	foreach ($doc_detail->getElementsByTagName('div') as $div) {
		if ($div->getAttribute('id') == "description") {
			$description = $div->nodeValue;
		}
		
		if ($div->getAttribute('id') == "additional-data") {
			$description .= $div->nodeValue;
		}
		
		if ($div->getAttribute('class') == "yotpo yotpo-main-widget") {
			$image = $div->getAttribute('data-image-url');
		}
		
	}
	
	
	$return = array('product_title'=>$title,'product_price'=>$product_price,'product_description'=>$description,'product_image'=>$image);
	return $return;
}