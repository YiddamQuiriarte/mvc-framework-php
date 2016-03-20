<?php
/**
 * @author Edward Rodríguez
 * @category Controlador
 * @copyright Software Libre
 * @example controller/categoriasController.php Controlador de categorias
 * @global Clase controladora para la ejecución de categorias
 * @package categoriasController
 * @subpackage AppController
 * @since 13/10/2015
 * @version v.1.0
 */
class categoriasController extends AppController
{
	/**
	 * Método constructor
	 * @return none No devuelve nada
	 */
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * Método index
	 * @return none No devuelve nada
	 */
	public function index()
	{
		$this->_view->titulo = "Categorias";
		$this->_view->categorias = $this->categorias->find("categorias", "all");
		//$this->_view->renderizar('index');
	}
	/**
	 * Método para agregar
	 * @return none No devuelve nada
	 */
	public function add()
	{
		if($_POST)
		{
			if($this->categorias->save('categorias', $_POST))
			{
				$this->redirect(array('controller' => 'categorias'));
			}
			else
			{
				$this->redirect(array('controller' => 'categorias', 'action' => 'add'));
			}
		}
		else
		{
			$this->_view->titulo = "Agregar categorias";
			//$this->_view->renderizar('add');
		}
	}
	/**
	 * Método para edicion
	 * @return none No devuelve nada
	 */
	public function edit($id = null)
	{
		if($_POST)
		{
			if($this->categorias->update('categorias', $_POST))
			{
				$this->redirect(array('controller' => 'categorias', 'action' => 'index'));
			}
			else
			{
				$this->redirect(array('controller' => 'categorias', 'action' => 'edit/'.$_POST['id']));
			}
		}
		else
		{
			$this->_view->titulo = "Editar categoria";
			$this->_view->categoria = $this->categorias->find('categorias', 'first', array('conditions' => 'id='.$id));
			//$this->_view->renderizar('edit');
		}
	}
	/**
	 * Método para eliminar
	 * @return none No devuelve nada
	 */
	public function delete($id = null)
	{
		$condition = 'id='.$id;
		if($this->categorias->delete('categorias', $condition))
		{
			$this->redirect(array('controller' => 'categorias', 'action' => 'index'));
		}
	}
}