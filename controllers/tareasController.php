<?php

/**
 * @author Edward Rodríguez
 * @category Controlador
 * @copyright Software Libre
 * @example controller/tareasController.php Controlador de tareas
 * @global Clase controladora para la ejecución de tareas
 * @package tareasController
 * @subpackage AppController
 * @since 13/10/2015
 * @version v.1.0
 */
class tareasController extends AppController 
{

	/**
	 * Constructor de la clase tareasController
	 * @return none No devuelve nada
	 */
	public function __construct()
	{
	
		parent::__construct();
	
	}
	
	/**
	 * Método inicial de la clase tareasController
	 * @return none No devuelve nada
	 */
	public function index()
	{

		//echo "Hola desde el otro lado del mundo";

/*		$tareas = $this->loadModel("tareas");
		
		$this->_view->tareas = $tareas->getTareas();
		
		$this->_view->titulo = "Página principal";
		
		$this->_view->renderizar("index");*/
		
		$this->_view->titulo = "Página principal";
		
		$options = array(
		
			'fields' => 'tareas.id, tareas.nombre, categorias.nombre AS categoria, fecha, prioridad, status',
			
			'join' => 'categorias',
			
			'on' => 'categorias.id = categoria_id'
		
		);
		
		$this->_view->tareas = $this->tareas->find('tareas', 'join', $options);
		
		//$this->_view->renderizar("index"); // Ya no se utiliza porque toma el nombre de la capa respectiva
		
		//$this->_view->setView("test"); // Pone el nombre de la vista
		
		//$this->_view->setLayout("website"); // Pone el nombre de la capa
	
	}
	/**
	 * Método inicial de la clase tareasController
	 * @return none No devuelve nada
	 */
	public function add()
	{
		$options = array( 'order' => 'categorias.nombre asc');
		$this->_view->categorias = $this->tareas->find('categorias', 'all', $options);
		if($_POST)
		{
			if($this->tareas->save('tareas', $_POST))
			{
				$this->redirect(array('controller' => 'tareas'));
			}
			else
			{
				$this->redirect(array('controller' => 'tareas', 'action' => 'add'));
			}
		}
		else
		{
			$this->_view->titulo = "Agregar tarea";
			//$this->_view->renderizar('add');
		}
	}
	/**
	 * Método inicial de la clase tareasController
	 * @return none No devuelve nada
	 */
	public function edit($id = null)
	{
		$this->_view->categorias = $this->tareas->find('categorias', 'all', null);
		if($_POST)
		{
			if($this->tareas->update('tareas', $_POST))
			{
				$this->redirect(array('controller' => 'tareas', 'action' => 'index'));
			}
			else
			{
				$this->redirect(array('controller' => 'tareas', 'action' => 'edit/'.$_POST['id']));
			}
		}
		else
		{
			$this->_view->titulo = "Editar tarea";
			$this->_view->tarea = $this->tareas->find('tareas', 'first', array('conditions' => 'id='.$id));
			//$this->_view->renderizar('edit');
		}
	}
	/**
	 * Método inicial de la clase tareasController
	 * @return none No devuelve nada
	 */
	public function delete($id = null)
	{
		$condition = 'id='.$id;
		if($this->tareas->delete('tareas', $condition))
		{
			$this->redirect(array('controller' => 'tareas', 'action' => 'index'));
		}
	}

}