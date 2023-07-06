<?php

spl_autoload_register(function ($className) {
	$dirs = [
		dirname(__FILE__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR,
		dirname(__FILE__) . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR,
		dirname(__FILE__) . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR
	];

	$filename_namespace = str_replace('\\', '/', $className) . '.php';

	if (file_exists($filename_namespace)) {
		require_once $filename_namespace;
	} else {
		foreach($dirs as $dir) {
			$filename = $dir . $className . '.php';

			if (file_exists($filename)) {
				require_once $filename;
			}
		}
	}
});