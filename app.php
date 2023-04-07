<?php
// 100x100の空の画像を作成
$image = imagecreatetruecolor(100, 100);

// 青色を作成
$blue = imagecolorallocate($image, 0, 0, 255);

// 画像全体を青色で塗りつぶす
imagefill($image, 0, 0, $blue);

// 画像を保存する
imagepng($image, 'tmp.png');

// 画像を表示する場合は以下のようにします
// header('Content-Type: image/png');
// imagepng($image);

// 画像を破棄する
imagedestroy($image);
?>