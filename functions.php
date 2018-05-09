<?php
function findAndCompare($url1, $url2) {
	$anchors1 = getAnchorsFromUrl($url1);	
	$anchors2 = getAnchorsFromUrl($url2);
	$comparisonTable = compareAnchors($anchors1, $anchors2);
	return $comparisonTable;
}

function getAnchorsFromUrl($url) {
	$page = file_get_contents($url);
	$dom = new DomDocument();
	@$dom->loadHTML($page);
	$anchors = array();
	foreach ($dom->getElementsByTagName('a') as $item) {
		   $anchors[] = $item->getAttribute('href');
    }
	sort($anchors);
	return $anchors;
}

function compareAnchors($anchors1, $anchors2) {
	$comparisonTable = [];
	foreach ( $anchors1 as $anchor1 ) {
		$tempvalue = 0;
		$templabel = 0;
		foreach ( $anchors2 as $anchor2 ) {
			similar_text($anchor1, $anchor2, $percent);
			if ($percent > $tempvalue) {
				$tempvalue = $percent;
				$templabel = $anchor2;
			}
		}
		$comparisonTable[] = [
			"anchor1" => $anchor1,
			"anchor2" => $templabel,
			"percent" => $tempvalue
		];
	}
	return $comparisonTable;
}

function downloadComparisonTable($comparisonTable) {
	// TODO
}
