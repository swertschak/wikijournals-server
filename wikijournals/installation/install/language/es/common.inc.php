<?php
//------------------------------------------------------------------------------ 
//*** Spanish (es)
//------------------------------------------------------------------------------ 

$arrLang = array();

$arrLang['alert_min_version_db'] = "Este programa requiere al menos la versión de _DB_VERSION_ _DB_ instalado (versión actual es _DB_CURR_VERSION_). No se puede continuar con la instalación.";
$arrLang['alert_min_version_php'] = "Este programa requiere al menos _PHP_VERSION_ versión de PHP instalada (versión actual es _PHP_CURR_VERSION_). Usted no puede continuar la instalación.";
$arrLang['alert_directory_not_writable'] = "El directorio <b>_FILE_DIRECTORY_</b> no se puede escribir! <br />Debe conceder 'escribe' permisos (0755 derechos de acceso o 777, dependiendo de la configuración del sistema) a este directorio antes de iniciar la instalación!";
$arrLang['alert_unable_to_install'] = "No se puede instalar esta aplicación, ya que una aplicación con la misma identidad ya está instalado. Sólo puede <b>Actualización</b> o <b>Desinstalar</b> que.";
$arrLang['alert_required_fields'] = "Los campos marcados con un asterisco son obligatorios";
$arrLang['alert_db_host_empty'] = "Acogida de base de datos no puede estar vacío! Por favor, vuelva a entrar.";
$arrLang['alert_db_name_empty'] = "Nombre de base de datos no puede estar vacío! Por favor, vuelva a entrar.";
$arrLang['alert_db_username_empty'] = "Nombre de usuario de base de datos no puede estar vacío! Por favor, vuelva a entrar.";
$arrLang['alert_db_password_empty'] = "Contraseña de base de datos no puede estar vacío! Por favor, vuelva a entrar.";
$arrLang['alert_admin_username_empty'] = "Nombre de usuario administrador no puede estar vacío! Por favor, vuelva a entrar.";
$arrLang['alert_admin_password_empty'] = "Contraseña de administrador no puede estar vacío! Por favor, vuelva a entrar.";
$arrLang['alert_wrong_testing_parameters'] = "Los parámetros de prueba están equivocados! Por favor, introduzca los parámetros válidos.";
$arrLang['alert_remove_files'] = "Por razones de seguridad, por favor, elimine <b>install.php</b> de archivos e <b>instalar/</b> carpeta de su servidor!";

$arrLang['error_sql_executing'] = "SQL de ejecución de error! Por favor, Activar el modo de depuración y comprobar cuidadosamente la sintaxis de su archivo de volcado de SQL.";
$arrLang['error_can_not_open_config_file'] = "Base de datos se ha creado correctamente! No se puede abrir el archivo de configuración _CONFIG_FILE_PATH_ para guardar información.";
$arrLang['error_can_not_read_file'] = "No se pudo leer _SQL_DUMP_FILE_ archivo! Por favor, compruebe si existe un archivo.";
$arrLang['error_check_db_exists'] = "Base de datos de conexión de error! Por favor, compruebe si su base de datos existe y el acceso permitido para el usuario <b>_DATABASE_USERNAME_</b>._ERROR_<br />";
$arrLang['error_check_db_connection'] = "Base de datos de conexión de error! Por favor, compruebe su conexión parameters._ERROR_<br />";

$arrLang['admin_access_data'] = "Los datos de acceso de administrador";
$arrLang['admin_access_data_descr'] = "(que lo necesitan para entrar en el área de administración protegida)";
$arrLang['admin_login'] = "Entrada Admin";
$arrLang['admin_login_info'] = "Su nombre de usuario debe tener al menos 6 caracteres de longitud y entre mayúsculas y minúsculas. Por favor, no introduzca caracteres acentuados.";
$arrLang['admin_password'] = "Contraseña de administrador";
$arrLang['admin_password_info'] = "Le recomendamos que su contraseña no es una palabra que puede encontrar en el diccionario, incluye capital y minúsculas, y contiene por lo menos un carácter especial (1-9,!, *, _, Etc).";
$arrLang['asp_tags'] = "Asp Etiquetas";
$arrLang['build_date'] = "Fecha de compilación";
$arrLang['cancel_installation'] = "Cancelar la instalación";
$arrLang['click_start_button'] = "Haga clic en el botón Start para continuar";
$arrLang['click_to_start_installation'] = "Haga clic para iniciar la instalación";
$arrLang['checked'] = "Comprobar";
$arrLang['continue_installation'] = "Continuar instalación";
$arrLang['database_host'] = "Base de datos de host";
$arrLang['database_host_info'] = "Nombre de host o dirección IP del servidor de base de datos. El servidor de base de datos puede ser en forma de un nombre de host (y / o dirección de puerto), como db1.myserver.com, o localhost:5432, o como una dirección IP, como 192.168.0.1";
$arrLang['database_name'] = "Nombre de base de datos";
$arrLang['database_name_info'] = "Nombre de base de datos. La base de datos utilizada para almacenar los datos. Un ejemplo de nombre de la base es 'testdb'.";
$arrLang['database_username'] = "Base de datos de usuario";
$arrLang['database_username_info'] = "Nombre de usuario de base de datos. El nombre de usuario utilizado para conectarse al servidor de base de datos. Un ejemplo de nombre de usuario es 'test_123'.";
$arrLang['database_password'] = "Base de datos Contraseña";
$arrLang['database_password_info'] = "Contraseña de base de datos. La contraseña se utiliza junto con el nombre de usuario, que forma la cuenta de usuario de base de datos.";
$arrLang['database_prefix'] = "Base de datos de prefijo (opcional)";
$arrLang['database_prefix_info'] = "Prefijo de la base de datos. Se utiliza para definir el prefijo único para las tablas de base de datos y prevenir un tipo de datos de interferir con el otro. Un ejemplo de prefijo de la base de datos es 'abc_'.";
$arrLang['disabled'] = "con discapacidad";
$arrLang['error'] = "Error";
$arrLang['getting_system_info'] = "Obtener información del sistema";
$arrLang['file_successfully_rewritten'] = "El archivo _CONFIG_FILE_ éxito fue re-escrito y base de datos actualizada.";
$arrLang['file_successfully_deleted'] = "El archivo _CONFIG_FILE_ se ha eliminado correctamente y eliminar la base de datos.";
$arrLang['file_successfully_created'] = "El archivo _CONFIG_FILE_ se ha creado correctamente.";
$arrLang['follow_the_wizard'] = "Siga el <b>Asistente</b> para configurar la base de datos";
$arrLang['installation_guide'] = "Guía de instalación";
$arrLang['installation_type'] = "Tipo de instalación";
$arrLang['language'] = "Lengua";
$arrLang['license'] = "Licencia";
$arrLang['loading'] = "de carga";
$arrLang['magic_quotes_gpc'] = "Comillas Mágicas de (Get/Post/Cookie)";
$arrLang['magic_quotes_runtime'] = "Cotizaciones en tiempo de ejecución Magic";
$arrLang['magic_quotes_sybase'] = "Comillas Mágicas Sybase están en estilo";
$arrLang['new_installation_of'] = "Nueva instalación de";
$arrLang['new'] = "Nuevo";
$arrLang['password_encryption'] = "Contraseña de cifrado";
$arrLang['perform_manual_installation'] = "Realizar un <b>manual</b> de Instalación";
$arrLang['php_version'] = "PHP Versión";
$arrLang['proceed_to_login_page'] = "Proceda a la página de acceso"; 
$arrLang['safe_mode'] = "Modo seguro";
$arrLang['sendmail_from'] = "De Sendmail";
$arrLang['sendmail_path'] = "Sendmail Camino";
$arrLang['server_api'] = "Servidor de la API";
$arrLang['session_support'] = "Sesión de Soporte";
$arrLang['short_open_tag'] = "Etiqueta abierta a corto";
$arrLang['smtp'] = "SMTP";
$arrLang['smtp_port'] = "Puerto SMTP";
$arrLang['step_1_database_import'] = "Paso 1. Base de datos de importación";
$arrLang['step_1_database_import_error'] = "Paso 1. Base de datos de importación (de error)";
$arrLang['step_2_installation_completed'] = "Paso 2. La instalación ha finalizado!";
$arrLang['step_2_updating_completed'] = "Paso 2. Actualización completada!";
$arrLang['step_2_uninstallation_completed'] = "Paso 2. Desinstalación completada!";
$arrLang['system'] = "Sistema de";
$arrLang['system_architecture'] = "Arquitectura del sistema";
$arrLang['test_database_connection'] = "Prueba de conexión de base de datos";
$arrLang['unknown'] = "Desconocida";
$arrLang['uninstall'] = "Desinstalar";
$arrLang['update'] = "Actualizar";
$arrLang['virtual_directory_support'] = "Directorio Virtual de Apoyo";
    
?>