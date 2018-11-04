<?php

/**
 * Carpeta de las Vistas
 */
define("VIEWS_FOLDER", APP_PATH."Views".DS );

/**
 * Nombre de la carpeta de Aplicación
 */
define("APP_FOLDER", "money-tracking");

/**
 * Controlador por default
 */
define("DEFAULT_CONTROLLER", "transactions");

/**
 * Layout Por default
 */
define("DEFAULT_LAYOUT", "default");

/**
 * Server Name -- Cambielo si está en la raíz o si hay anidación
 */
define("APP_URL", "http://".$_SERVER['SERVER_NAME']."/".APP_FOLDER."/");

/**
 * Nombre de la aplicación
 */
define("APP_NAME", "Arquitectura MVC");
/**
 * Assets CSS de la aplicación --> Example: SCSS builds or Webpack Builds
 */
define("APP_URL_CSS", APP_URL."public/css/");

/**
 * Assets IMG de la aplicación --> Example: Images
 */
define("APP_URL_IMG", APP_URL."public/img/");

/**
 * Assets JS de la aplicación --> Example: React Builds or Webpack Builds
 */
define("APP_URL_JS", APP_URL."public/js/");