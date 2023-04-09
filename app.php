<?php

require_once("./drawer/mandelbrot.php");

$items = [];

$json_string = file_get_contents("./config.json");
$config = json_decode($json_string, true);

$global_config = $config["global"];
$width = (int)$global_config["width"];
$height = (int)$global_config["height"];
$output_dir = $global_config["output_dir"];

$mandelbrot_config = $config["mandelbrot"];
$mandelbrot_config["width"] = $width;
$mandelbrot_config["height"] = $height;
$mandelbrot_config["output"] = $output_dir . DIRECTORY_SEPARATOR . $mandelbrot_config["output_file"];
array_push($items, $mandelbrot_config["output_file"]);
mandelbrot_drawer($mandelbrot_config);

file_put_contents($output_dir . DIRECTORY_SEPARATOR . "items.txt", join("\n", $items));

?>
