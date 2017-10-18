<?php
/**
* Generate jpeg screenshots from PDF file 
* @param string $file_name path to PDF file
* @return array jpeg file names
*/
function pdf2jpg($file_name)
{
	$file_name = basename($file_name, '.pdf');
	$img = new \imagick($file_name . '.pdf');
	$img->setImageBackgroundColor('white');
	//$img = $img->flattenImages();
	$img->setResolution(300, 300);
	$num_pages = $img->getNumberImages();
	$img->setImageCompressionQuality(100);
	$imgs = array();
	for ($i = 0; $i < $num_pages; $i++) {
		$img->setIteratorIndex($i);
		$img->setImageFormat('jpeg');
		$img->writeImage($file_name . '-' . $i . '.jpg');
		$imgs[] = $file_name . '-' . $i . '.jpg';
	}
	$img->destroy();
	return $imgs;
}
?>