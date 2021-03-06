<?php
/**
 *
 * Item de Rubrique pour l'affichage du Menu utilisateur
 * niveau juste en dessous de la Rubrique
 *
 * @package customCI-by-MB&JD
 * @author  inconnu
 * @copyright  MB&JD April 2015
 * @since   Version 1.0.0
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class ItemRubrique {

	protected $name = "";
	
	protected $URL = array();
	
	protected $current = false;

	protected $sub_item = array();
	
	public function __construct($name= "",$URL = array(), $config_sub_item=array()){
	
		$this->name = $name;
		$this->URL = $URL;
		$this->current = false;

		//gestion des menus dinamique en fonction de la BDD, var cherche les infos du modèle a charger dans config/menu.php
		//si config_sub_item == config[menu ] de qqch, alors charger ce qqch dans sub_item;
		if(isset($config_sub_item["model_name"])){
			$model_name = $config_sub_item["model_name"]."Model";
			load_model($model_name,$config_sub_item["model_module"]);
			$CI = get_instance();
			$this->sub_item = $CI->$model_name->loadMenu();
			
		}
	
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getURL()
	{
		return $this->URL;
	}
	
	public function setURL($URL)
	{
		$this->URL = $URL;
	}
	
	public function setCurrent()
	{
		$this->current = true;
	}
	
	public function isCurrent()
	{
		return $this->current;
	}

	public function getSubItem()
	{
		return $this->sub_item;
	}
	
	public function setSubItem($sub_item)
	{
		$this->sub_item = $sub_item;
	}
}