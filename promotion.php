<?php
function createPromotion($data){
    $bigImgPath = $data['bigImgPath'];
    $qCodePath = $data['qCodePath'];
    $filename = $data['filename'];
    $left = isset($data['left'])?$data['left']:100;
    $top = isset($data['top'])?$data['top']:100;
    $bigImg = imagecreatefromstring(file_get_contents($bigImgPath));
    $qCodeImg = imagecreatefromstring(file_get_contents($qCodePath));
    list($qCodeWidth, $qCodeHight, $qCodeType) = getimagesize($qCodePath);
    if($data['percent'] > 0) {
        $qCodeWidthNew = $qCodeWidth * $data['percent'];
        $qCodeHightNew = $qCodeHight * $data['percent'];
        $qCodeImgNew = imagecreatetruecolor($qCodeWidthNew, $qCodeHightNew);  
        imagecopyresampled($qCodeImgNew, $qCodeImg, 0, 0, 0, 0, $qCodeWidthNew, $qCodeHightNew, $qCodeWidth, $qCodeHight);
        imagecopymerge($bigImg, $qCodeImgNew, $left, $top, 0, 0, $qCodeWidthNew, $qCodeHightNew, 100);
    }else{
        imagecopymerge($bigImg, $qCodeImg, $left, $top, 0, 0, $qCodeWidth, $qCodeHight, 100);
    }
    list($bigWidth, $bigHight, $bigType) = getimagesize($bigImgPath);
    switch ($bigType) {
        case 1: //gif
            header('Content-Type:image/gif');
            imagegif($bigImg,$filename);
            break;
        case 2: //jpg
            header('Content-Type:image/jpg');
            imagejpeg($bigImg,$filename);
            break;
        case 3: //jpg
            header('Content-Type:image/png');
            imagepng($bigImg,$filename);
            break;
        default:
            # code...
            break;
    }
    imagedestroy($bigImg);
    imagedestroy($qCodeImg);
    imagedestroy($qCodeImgNew);
}
?>