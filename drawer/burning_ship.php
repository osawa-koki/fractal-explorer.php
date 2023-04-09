<?php

function burning_ship_drawer($config) {

  // パラメータを取得
  $width = (int)$config["width"];
  $height = (int)$config["height"];
  $x_min = (float)$config["x_min"];
  $x_max = (float)$config["x_max"];
  $y_min = (float)$config["y_min"];
  $y_max = (float)$config["y_max"];
  $max_iterations = (int)$config["max_iterations"];
  $threshold = (int)$config["threshold"];
  $red_strength = (int)$config["red_strength"];

  // バーニングシップ集合を描写
  $canvas = imagecreatetruecolor($width, $height);

  // 色を設定
  $colors = array();

  for ($i = 0; $i < $max_iterations; $i++) {
    $colors[$i] = imagecolorallocate($canvas, ($i * $red_strength) % 256, $i % 256, $i % 256);
  }

  $black = imagecolorallocate($canvas, 0, 0, 0);
  imagefill($canvas, 0, 0, $black);

  // バーニングシップ集合を描写
  $xRange = $x_max - $x_min;
  $yRange = $y_max - $y_min;
  $xStep = $xRange / $width;
  $yStep = $yRange / $height;

  for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {
      $x0 = $x_min + $x * $xStep;
      $y0 = $y_min + $y * $yStep;
      $x1 = 0;
      $y1 = 0;
      $i = 0;
      while ($x1 * $x1 + $y1 * $y1 < $threshold && $i < $max_iterations) {
        $x2 = abs($x1 * $x1 - $y1 * $y1 + $x0);
        $y2 = abs(2 * $x1 * $y1 + $y0);
        $x1 = $x2;
        $y1 = $y2;
        $i++;
      }
      if ($i === $max_iterations) {
        imagesetpixel($canvas, $x, $y, $black);
      } else {
        imagesetpixel($canvas, $x, $y, $colors[$i]);
      }
    }
  }

  // 画像をファイルに出力
  imagepng($canvas, $config["output"]);

  // メモリを解放
  imagedestroy($canvas);
}

?>
