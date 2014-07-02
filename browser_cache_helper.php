// =================================================================================================
//
//	Copyright 2014 Carlos Bernal. All Rights Reserved.
//
//	This program is free software. You can redistribute and/or modify it
//	in accordance with the terms of the accompanying license agreement.
//
// =================================================================================================


<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//-------------------------------------------------------------------------------------
/**
 * CodeIgniter Browser Cache Helper
 * 
 * Helper que contiene funciones de ayuda para el control de cache de las hojas de estilo,
 * imagenes, javascripts, y cualquier cosa que pueda ser cacheada por el explorador web.
 *
 * @author Carlos Bernal <bernalcarvajal@gmail.com>
 * 
 * @link https://github.com/BernalCarlos/ci-browser-cache-helper
 */
//--------------------------------------------------------------------------------------

/**
 * Cache Base Url
 * 
 * Crea una url al recurso solicitado a partir de la URL base del sitio y agrega un
 * parametro 'version' al recurso. Esta funcion es similar en funcionamiento y cuerpo a la funcion
 * 'base_url' de CodeIgniter.
 * 
 * Esta funcion recibe como parametros el segmento o 'uri' al recurso y opcionalmente, el numero de version
 * que se desea mantener.
 * 
 * Si no se proporciona un valor para el numero de version, se intentara consultar la constante 'BROWSER_CACHE_VERSION'
 * en 'constants.php', o en las variables de configuracion del sitio ('config.php').
 * 
 * Si 'BROWSER_CACHE_VERSION' no esta definida, el valor de version será 'no'.
 * 
 * Ejemplo: cache_base_url('images/logo.png', 1) => 'http://www.site.com/images/logo.png?version=1'
 * 
 * @param string $uri segmento al recurso.
 * @param int $cacheVersion Numero de version de la cache.
 * 
 * @return string
 */
if (!function_exists('cache_base_url')) {

    function cache_base_url($uri, $cacheVersion = NULL) {
        //Determinar la url completa
        $CI = & get_instance();
        $CI->load->helper('url');
        $fullURL = base_url($uri);

        //Agregar el numero de version
        if ($cacheVersion == NULL) {
            if (defined('BROWSER_CACHE_VERSION')) {
                $fullURL = $fullURL . '?version=' . BROWSER_CACHE_VERSION;
            } else if ($CI->config->item('BROWSER_CACHE_VERSION') !== FALSE) {
                $fullURL = $fullURL . '?version=' . $CI->config->item('BROWSER_CACHE_VERSION');
            } else {
                $fullURL = $fullURL . '?version=no';
            }
        } else {
            $fullURL = $fullURL . '?version=' . $cacheVersion;
        }

        //Retornar la URL
        return $fullURL;
    }
}
