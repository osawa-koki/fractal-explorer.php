<?php

require_once("./drawer/mandelbrot.php");
require_once("./drawer/julia.php");
require_once("./drawer/tricorn.php");
require_once("./drawer/burning_ship.php");

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

$julia_config = $config["julia"];
$julia_config["width"] = $width;
$julia_config["height"] = $height;
$julia_config["output"] = $output_dir . DIRECTORY_SEPARATOR . $julia_config["output_file"];
array_push($items, $julia_config["output_file"]);
julia_drawer($julia_config);

$tricorn_config = $config["tricorn"];
$tricorn_config["width"] = $width;
$tricorn_config["height"] = $height;
$tricorn_config["output"] = $output_dir . DIRECTORY_SEPARATOR . $tricorn_config["output_file"];
array_push($items, $tricorn_config["output_file"]);
tricorn_drawer($tricorn_config);

$burning_ship_config = $config["burning_ship"];
$burning_ship_config["width"] = $width;
$burning_ship_config["height"] = $height;
$burning_ship_config["output"] = $output_dir . DIRECTORY_SEPARATOR . $burning_ship_config["output_file"];
array_push($items, $burning_ship_config["output_file"]);
burning_ship_drawer($burning_ship_config);

file_put_contents($output_dir . DIRECTORY_SEPARATOR . "items.txt", join("\n", $items));

?>
