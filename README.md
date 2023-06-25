# Plugin "Muestra el HEX el RGBA y el CMYK de una variable"

## Descripción

El plugin **"Muestra el HEX el RGBA y el CMYK de una variable"** proporciona una funcionalidad para mostrar la conversión de valores de color de una variable. Permite obtener el valor HEX de una variable, convertirlo a RGBA y luego a CMYK. Este plugin se integra en WordPress utilizando un shortcode.

## Instalación

1. Descarga el archivo del plugin desde [aquí](https://github.com/fxescandell/Mostrar-el-HEX-RGBA-y-CMYK-de-una-variable-root-de-un-CSS).
2. Sube el archivo del plugin a la carpeta `wp-content/plugins` de tu instalación de WordPress.
3. Activa el plugin desde el panel de administración de WordPress.

## Uso

Una vez que el plugin está activo, puedes utilizar el shortcode `[mostrar-hex-rgba-cmyk]` para mostrar el valor HEX, RGBA y CMYK de una variable en tus publicaciones o páginas de WordPress.

El shortcode acepta el siguiente parámetro:

- `nombre`: El nombre de la variable de la cual deseas obtener los valores de color. Ejemplo: `[mostrar-hex-rgba-cmyk nombre="nombre_variable"]`.

## Funciones del plugin

El plugin incluye las siguientes funciones:

### Función `mostrar_hex_rgba_cmyk($atts)`

Esta función es llamada cuando se utiliza el shortcode `[mostrar-hex-rgba-cmyk]`. Recibe los atributos pasados al shortcode y realiza lo siguiente:

1. Obtiene el nombre de la variable del atributo `nombre`.
2. Lee el contenido del archivo CSS ubicado en la URL especificada.
3. Utiliza una expresión regular para buscar el valor de la variable en el contenido del archivo CSS.
4. Convierte el valor HEX a RGBA utilizando la función `hex_to_rgba()`.
5. Convierte el valor RGBA a CMYK utilizando la función `rgba_to_cmyk()`.
6. Devuelve una cadena de texto formateada con los valores HEX, RGBA y CMYK.

### Función `hex_to_rgba($hex)`

Esta función recibe un valor HEX como entrada y realiza lo siguiente:

1. Elimina el carácter "#" del valor HEX.
2. Extrae los componentes RGB del valor HEX.
3. Si el valor HEX contiene un componente alfa, lo convierte a porcentaje.
4. Devuelve una cadena de texto con los valores RGB y, si es aplicable, el valor alfa.

### Función `rgba_to_cmyk($rgba)`

Esta función recibe un valor RGBA como entrada y realiza lo siguiente:

1. Elimina los caracteres "rgba(" y ")" del valor RGBA.
2. Divide el valor RGBA en un arreglo de componentes.
3. Calcula los valores de los componentes CMYK a partir de los valores RGB.
4. Devuelve una cadena de texto formateada con los valores CMYK.

## Créditos

Este plugin fue creado por Francesc Xavier Escandell.

## Contribuciones

Si deseas contribuir al desarrollo de este plugin, puedes hacerlo a través del repositorio [aquí](https://github.com/fxescandell/Mostrar-el-HEX-RGBA-y-CMYK-de-una-variable-root-de-un-CSS).

## Soporte

Si tienes algún problema o pregunta sobre este plugin, puedes contactar al autor [aquí](https://escandell.cat).
