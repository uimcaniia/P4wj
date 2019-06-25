<?php

	class Input extends InputManager {

		// **************************************************
		// Attributs de l'objet
		// **************************************************
		
		 private $_id;
	  	 private $_class_style;
		 private $_id_style;
	  	 private $_type;
	 	 private $_name;
	 	 private $_value;
	 	 private $_placeholder;
	 	 private $_contenteditable;

		// **************************************************
		// Methode
		// **************************************************

	 	 public function getInput($aInput)
	 	 {
	 	 	$aRes = array();
	 	 	if(is_array($aInput))
	 	 	{
	 	 		foreach ($aInput as $value)
	 	 		{
			 	 	if(is_int($value))
			 	 	{
	 	 				$aData = parent::get($value);
	 				}
	 				array_push($aRes, $aData[0]);
	 			}
	 		}elseif(!is_array($aInput))
	 		{
	 			if(is_int($aInput))
	 			{
	 				$aData = parent::get($aInput);
	 				array_push($aRes, $aData[0]);
	 			}
	 		}
	 		else
	 		{
	 			throw new Exception('L\'id du champs input n\'est pas correct'); 
	 		}
	 		return $aRes;
	 	}


		// **************************************************
		// GETTERS
		// **************************************************
		
		/** Retourne l'ID' de l'item */
		public function getId()
		{
			return $this->_id;
		}
		
		/** Retourne attribut "class"  */
		public function getClass_style()
		{
			return $this->_class_style;
		}
		
		/** Retourne  	id css du champ input   */
		public function getId_stylet()
		{
			return $this->_id_style;
		}
		
		/** Retourne type du champs */
		public function getType()
		{
			return $this->_type;
		}
		
		/** Retourne attribut "name  */
		public function getName()
		{
			return $this->_name;
		}

		/** Retourne attribut "value"  */
		public function getValue()
		{
			return $this->_value;
		}
		
		/** Retourne  	attribut "placeholder  */
		public function getPlaceholder()
		{
			return $this->_placeholder;
		}
		/** Retourne attribut "contenteditable" */
		public function getContenteditable()
		{
			return $this->_contenteditable;
		}

		// **************************************************
		// SETTERS
		// **************************************************

		/** Assigne l'ID' de l'item */
		public function setId($id)
		{
			$this->_id = $id;
		}
		
		/** Assigne attribut "class"  */
		public function setClass_style($class_style)
		{
			$this->_class_style = $class_style;
		}
		
		/** Assigne id css du champ input */
		public function setId_stylet($id_style)
		{
			$this->_id_style = $id_style;		}
		
		/** Assigne type du champs */
		public function setType($type)
		{
			$this->_type = $type;
		}
		
		/** Assigne attribut "name */
		public function setName($name)
		{
			$this->_name = $name;
		}

		/** Assigne attribut "value" */
		public function setValue($value)
		{
			$this->_value = $value;
		}
		/** Assigne attribut "placeholder */
		public function setPlaceholder($placeholder)
		{
			$this->_placeholder = $placeholder;
		}
		/** Assigne attribut "contenteditable" */
		public function setContenteditable($contenteditable)
		{
			$this->_contenteditable = $contenteditable;
		}
		
	}
	
?>