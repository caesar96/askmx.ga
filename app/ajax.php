<?php
$show = true;
require("mnc.php");
if ( !empty( $_GET['ajax'] ) && !empty( $_GET['file'] ) )
{
	if ( file_exists( CONTROLLER . 'ajax_' . $_GET['file'] . '.php' ) ){
		include( CONTROLLER . 'ajax_' . $_GET['file'] . '.php' );
	} else {
		require ( HTML . '404.php' );
	}
}
?>