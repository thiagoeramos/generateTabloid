<?php

$width = 1000;
$height = 600;

$img = imagecreatetruecolor($width, $height);
$white = imagecolorallocate($img, 255, 255, 255);
imagefilledrectangle($img, 0, 0, $width, $height, $white);

$font=getcwd().'/Frutiger_57_Condensed.ttf';

$htitleFont = imagefontheight(50)+25;

imagettftext ( $img , 44, 0, $_POST['position_left']['corporate_text'],($_POST['position_top']['corporate_text']+$htitleFont), imagecolorallocate($img, 0, 0, 0),$font,$_POST['corporate_text']);

$htitleFont = imagefontheight(28)+25;
imagettftext ( $img , 24, 0, $_POST['position_left']['role'],($_POST['position_top']['role']+$htitleFont), imagecolorallocate($img, 0, 0, 0),$font,$_POST['role']);
imagettftext ( $img , 24, 0, $_POST['position_left']['tel'],($_POST['position_top']['tel']+$htitleFont), imagecolorallocate($img, 0, 0, 0),$font,$_POST['tel']); 
imagettftext ( $img , 24, 0, $_POST['position_left']['address'],($_POST['position_top']['address']+$htitleFont), imagecolorallocate($img, 0, 0, 0),$font,$_POST['address']);
imagettftext ( $img , 24, 0, $_POST['position_left']['website'],($_POST['position_top']['website']+$htitleFont), imagecolorallocate($img, 0, 0, 0),$font,$_POST['website']);



$filename = pathinfo($_POST['logo'], PATHINFO_BASENAME);
$logo = imagecreatefromstring(file_get_contents(getcwd().'/'.$filename));

list($imgwidth, $imgheight) = getimagesize($filename);

//imagecopy($img, $logo, $_POST['position_left']['logo'],  $_POST['position_top']['logo'], 0, 0, $_POST['position_width']['logo'], $_POST['position_height']['logo']);
imagecopyresized($img, $logo, $_POST['position_left']['logo'],  $_POST['position_top']['logo'], 0, 0, $_POST['position_width']['logo'], $_POST['position_height']['logo'], $imgwidth, $imgheight);


// //PARA varias IMAGENS
//if(!empty($_POST['images'])){
//	// para cada imagem enviada
//	foreach($_POST['images'] as $item){
//		// se tem o elemento "src"
//		if(!empty($item['src'])){
//			// pegamos somente o nome do arquivo e ignoramos o restante
//			// vamos procurar por ela dentro da pasta "imagens"
//			$filename = 'imagens/' . pathinfo($item['src'], PATHINFO_BASENAME);
//			//se existir
//			if(file_exists($filename)){
//				// pegamos o restante das informacoes enviadas
//				// via post para esta imagem
//				$w = sprintf('%d', $item['width']);
//				$h = sprintf('%d', $item['height']);
//				$x = sprintf('%d', $item['x']);
//				$y = sprintf('%d', $item['y']);
//
//				// criamos o elemento de imagem no PHP a partir do conteudo do arquivo
//				$item = imagecreatefromstring(file_get_contents(getcwd().'/'.$filename));
//			
//				// copiamos a imagem informada na imagem final,
//				// com as medidas e posições informadas
//				imagecopy($img, $item, $x, $y, 0, 0, $w, $h);
//				
//				imagestring($img,2,$x, ($y+$h), "Sabor e Preco", imagecolorallocate($img, 0, 0, 255));
//				
//			}
//		}
//	}
//}
//echo "<pre>"; print_r($_POST);
//die();
// geramos o arquivo final

$imageFileName = 'tabloid/'.date('dmY.His').'.jpg';

 header('Content-Type: image/jpeg');
imagejpeg($img, $imageFileName, 90);

echo $imageFileName;
