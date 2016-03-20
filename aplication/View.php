<?php

/**
 * @access public
 * @author Edward Rodríguez
 * @category View
 * @copyright Software Libre
 * @example aplication/View.php Clase para las vistas de la aplicación
 * @global Clase vista
 * @package View
 * @since 13/10/2015
 * @version v.1.0
 */
class View
{
	/**
	 * @var private
	 */
	private $_controlador;
	private $_metodo;
	private $_layout = DEFAULT_LAYOUT;
	private $_view;
	
	/**
	 * Constructor de la clase
	 * @param Request $peticion Objeto de la clase Request
	 * @return none No devuelve nada
	 */
	public function __construct(Request $peticion)
	{
	
		$this->_controlador = $peticion->getControlador();
		
		$this->_metodo = $peticion->getMetodo();
		
		$this->_view = $this->_metodo;
	
	}
	
	/**
	 *
	 */
	public function setLayout($layout)
	{
		$this->_layout = $layout;
	}
	
	/**
	 *
	 */
	public function setView($view)
	{
		$this->_view = $view;
	}
	
	/**
	 * Dibuja el contenido del modelo
	 * @param string $vista Consigue la ruta de la vista
	 * @param boolean $item Consigue el estado del item
	 * @throws exception Vista no encontrada
	 * @return none No devuelve nada
	 */
	public function renderizar($vista, $item = false)
	{
	
		$_layoutParams = array(
		
			"ruta_css"=>APP_URL."views/layouts/".$this->_layout/*DEFAULT_LAYOUT*/."/css/",
			
			"ruta_img"=>APP_URL."views/layouts/".$this->_layout."/img/",
			
			"ruta_js"=>APP_URL."views/layouts/".$this->_layout."/js/"
		
		);
		
		$rutaVista = ROOT."views".DS.$this->_controlador.DS.$vista.".phtml";
		
		/*if($this->_metodo == 'login')
		{
			$layout = 'login';
		}
		else
		{
			$layout = DEFAULT_LAYOUT;
		}*/
		
		if (is_readable($rutaVista))
		{
		
			include_once(ROOT."views".DS."layouts".DS.$this->_layout/*$layout*/.DS."header.php");
			
			include_once($rutaVista);
			
			include_once(ROOT."views".DS."layouts".DS.$this->_layout/*DEFAULT_LAYOUT*/.DS."footer.php");
		
		}
		else
		{
		
			throw new Exception("Vista no encontrada");
		
		}
	
	}
	
	public function __destruct()
	{
		$this->renderizar($this->_view);
	}

}