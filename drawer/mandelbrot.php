<?php

function mandelbrot_drawer($config) {

  // パラメータを取得
  $width = (int)$config["width"];
  $height = (int)$config["height"];
  $x_min = (float)$config["x_min"];
  $x_max = (float)$config["x_max"];
  $y_min = (float)$config["y_min"];
  $y_max = (float)$config["y_max"];
  $max_iterations = (int)$config["max_iterations"];
  $threshold = (int)$config["threshold"];

  // マンデルブロ集合を描写
  $canvas = imagecreatetruecolor($width, $height);

  // 色を設定
  $colors = array();

  for ($i = 0; $i < $max_iterations; $i++) {
    $colors[$i] = imagecolorallocate($canvas, $i % 256, ($i * 2) % 256, ($i * 4) % 256);
  }

  // マンデルブロ集合を描写
  for ($y = 0; $y < $height; $y++) {
    for ($x = 0; $x < $width; $x++) {
      $c_re = $x_min + ($x_max - $x_min) * $x / $width;
      $c_im = $y_min + ($y_max - $y_min) * $y / $height;
      $z_re = 0;
      $z_im = 0;
      $i = 0;

      while ($i < $max_iterations && $z_re * $z_re + $z_im * $z_im < $threshold) {
        $tmp = $z_re * $z_re - $z_im * $z_im + $c_re;
        $z_im = 2 * $z_re * $z_im + $c_im;
        $z_re = $tmp;
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
