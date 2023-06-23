<?php
/*
Plugin Name: Muestra el HEX el RGBA y el CMYK de una variable
Plugin URI: https://escandell.cat
Description: Muestra el HEX de una variable y su conversión a RGBA y CMYK mediante el siguiente shortcode [mostrar-hex-rgba-cmyk nombre="nombre_variable"].<br>
El valor de la clase la extrae del css que está ubicado en la carpeta de assets de brickforge que se usa para personalizar bricks
Version: 1.0
Author: Francesc Xavier Escandell
Author URI: https://escandell.cat
*/



function mostrar_hex_rgba_cmyk($atts) {
    // Obtener el nombre de la variable del shortcode
    $nombre_variable = $atts['nombre'];

    // Obtener el valor de la variable en el archivo CSS
    $url_css = 'https://escandell.local/wp-content/plugins/bricksforge/assets/classes/custom.css';
    $contenido_css = file_get_contents($url_css, false, stream_context_create([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
    ]));
    preg_match("/$nombre_variable: (.*?);/", $contenido_css, $matches);
    $valor_hex = isset($matches[1]) ? $matches[1] : '';

    // Convertir el valor HEX a RGBA
    $valor_rgba = hex_to_rgba($valor_hex);

    // Convertir el valor RGBA a CMYK
    $valor_cmyk = rgba_to_cmyk($valor_rgba);

    // Mostrar el valor HEX, RGBA y CMYK
    $resultado = "<strong>HEX:</strong> $valor_hex <br> <strong>RGBA:</strong> $valor_rgba <br> <strong>CMYK:</strong> $valor_cmyk";

    // Mostrar el resultado en un elemento de texto
    return "<span>$resultado</span>";
}

// Agregar el shortcode
add_shortcode('mostrar-hex-rgba-cmyk', 'mostrar_hex_rgba_cmyk');

// Función para convertir HEX a RGBA
function hex_to_rgba($hex) {
    $hex = str_replace('#', '', $hex);
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    // Obtener el componente alfa si está presente en el HEX
    $a = isset($hex[6]) ? round(hexdec(substr($hex, 6, 2)) / 255 * 100) . '%' : '100%';

    return "$r, $g, $b, $a";
}

// Función para convertir RGBA a CMYK
function rgba_to_cmyk($rgba) {
    $rgba = str_replace('rgba(', '', $rgba);
    $rgba = str_replace(')', '', $rgba);
    $rgba_array = explode(',', $rgba);

    $r = $rgba_array[0];
    $g = $rgba_array[1];
    $b = $rgba_array[2];

    $c = round((1 - ($r / 255)) * 100);
    $m = round((1 - ($g / 255)) * 100);
    $y = round((1 - ($b / 255)) * 100);
    $k = min($c, $m, $y);

    if ($k == 100) {
        $c = 0;
        $m = 0;
        $y = 0;
    } else {
        $c = round(($c - $k) / (100 - $k) * 100);
        $m = round(($m - $k) / (100 - $k) * 100);
        $y = round(($y - $k) / (100 - $k) * 100);
    }

    return "C: $c% - M: $m% - Y: $y% - K: $k%";
}
