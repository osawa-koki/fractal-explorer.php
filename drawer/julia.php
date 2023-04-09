<?php

function julia_drawer($config) {

  // パラメータを取得
  $width = (int)$config["width"];
  $height = (int)$config["height"];
  $x_min = (float)$config["x_min"];
  $x_max = (float)$config["x_max"];
  $y_min = (float)$config["y_min"];
  $y_max = (float)$config["y_max"];
  $cx = (float)$config["cx"];
  $cy = (float)$config["cy"];
  $max_iterations = (int)$config["max_iterations"];
  $threshold = (int)$config["threshold"];

  // ジュリア集合を描写
  $canvas = imagecreatetruecolor($width, $height);

  // 色を設定
  $colors = array();

  for ($i = 0; $i < $max_iterations; $i++) {
    $colors[$i] = imagecolorallocate($canvas, $i % 256, ($i * 2) % 256, ($i * 4) % 256);
  }

  // ジュリア集合を描写
  for ($y = 0; $y < $height; $y++) {
    for ($x = 0; $x < $width; $x++) {
      $zx = $x_min + ($x_max - $x_min) * $x / $width;
      $zy = $y_min + ($y_max - $y_min) * $y / $height;
      $i = 0;

      while ($i < $max_iterations) {
        $zx2 = $zx * $zx;
        $zy2 = $zy * $zy;

        if ($zx2 + $zy2 > $threshold) {
          break;
        }

        $zy = 2 * $zx * $zy + $cy;
        $zx = $zx2 - $zy2 + $cx;
        $i++;
      }

      if ($i === $max_iterations) continue;
      imagesetpixel($canvas, $x, $y, $colors[$i]);
    }
  }

  // 画像をファイルに出力
  imagepng($canvas, $config["output"]);

  // メモリを解放
  imagedestroy($canvas);
}

?>
