<?php
/**
 * @author Edward Rodríguez
 * @category Controlador
 * @copyright Software Libre
 * @example controller/usuariosController.php Controlador de usuarios
 * @global Clase controladora para la ejecución de usuarios
 * @package usuariosController
 * @subpackage AppController
 * @since 13/10/2015
 * @version v.1.0
 */
class usuariosController extends AppController
{
	private $pass;
	/**
	 * Clase constructora 
	 */
	public function __construct()
	{
		parent::__construct();
		$this->pass = new Password();
	}
	/**
	 * Método index 
	 * @return none No devuelve nada
	 */
	public function index()
	{
		$this->_view->titulo = "Usuarios";
		$this->_view->usuarios = $this->usuarios->find("usuarios", "all");
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
			$_POST['password'] = $this->pass->getPassword($_POST['password']);
			if($this->usuarios->save('usuarios', $_POST))
			{
				$this->redirect(array('controller' => 'usuarios'));
			}
			else
			{
				$this->redirect(array('controller' => 'usuarios', 'action' => 'add'));
			}
		}
		else
		{
			$this->_view->titulo = "Agregar usuarios";
			//$this->_view->renderizar('add');
		}
	}
	/**
	 * Método de edición 
	 * @return none No devuelve nada
	 */
	public function edit($id = null)
	{
		if($_POST)
		{
			if(!empty($_POST['pass']))
			{
				$_POST['password'] = $this->pass->getPassword($_POST['password']);
			}
			if($this->usuarios->update('usuarios', $_POST))
			{
				$this->redirect(array('controller' => 'usuarios', 'action' => 'index'));
			}
			else
			{
				$this->redirect(array('controller' => 'usuarios', 'action' => 'edit/'.$_POST['id']));
			}
		}
		else
		{
			$this->_view->titulo = "Editar usuarios";
			$this->_view->usuario = $this->usuarios->find('usuarios', 'first', array('conditions' => 'id='.$id));
			//$this->_view->renderizar('edit');
		}
	}
	/**
	 * Método de eliminacion
	 * @return none No devuelve nada
	 */
	public function delete($id = null)
	{
		$condition = 'id='.$id;
		if($this->usuarios->delete('usuarios', $condition))
		{
			$this->redirect(array('controller' => 'usuarios', 'action' => 'index'));
		}
	}
	/**
	 * Método para iniciar sesion 
	 * @return none No devuelve nada
	 */
	public function login()
	{
		$this->_view->setLayout("login");
		if($_POST)
		{
			$pass = new Password();
			$filter = new Validations();
			$auth = new Authorization();

			$username = $filter->sanitizeText($_POST["username"]);
			$password = $filter->sanitizeText($_POST["password"]);

			$options['conditions'] = " username = '$username'";
			$usuario = $this->usuarios->find("usuarios", "first", $options);

			if($pass->isValid($password, $usuario['password'])){
				$auth->login($usuario);
				$this->redirect(array("controller" => "tareas"));
			}else{
				echo "Usuario Invalido";
			}
		}
		//$this->_view->renderizar('login');
	}
	/**
	 * Método para cerrar sesion
	 * @return none No devuelve nada
	 */
	public function logout()
	{
		$auth = new Authorization();
		$auth->logout();
	}
}