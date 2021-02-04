<?php

namespace vendor\core;

class View {

	public $path;
	public $route;
	public $layout = DEFAULT_LAYOUT;


    public function getLayout(){
        return $this->layout;
    }

    public function setLayout($layout){
        $this->layout = $layout;
        return $this;
    }

	public function render($view, $title, $vars = []) {
		extract($vars);
        $this->path = VIEWS.implode(DIRECTORY_SEPARATOR,explode('.',$view)).".php";

		if (file_exists($this->path)) {
			ob_start();
			require $this->path;
			$content = ob_get_clean();
			require LAYOUTS.$this->layout.'.php';
		}
	}

	public function redirect($url) {
		header('location: '.$url);
		exit;
	}

	public static function errorCode($code) {
		http_response_code($code);
		$path = ERRORS.$code.'.php';
		if (file_exists($path)) {
			require $path;
		}
		exit;
	}


}	