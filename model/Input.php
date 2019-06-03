<?php

	class Input extends InputManager {



		// CONSTANTES
		const ID    = 'id';          // Nom de la colonne id de la table locale
		const CL    = 'class_style'; // attribut "class"  
		const ST    = 'id_style';     //  id css du champ input 
		const TY    = 'type';   //  type du champs 
		const NA    = 'name';   // attribut "name 
		const VA    = 'value';   // attribut "value" 
		const PL    = 'placeholder';      // attribut "placeholder 
		const CO    = 'contenteditable';   // attribut "contenteditable" 		 
		
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

	 	 public function getDataToHydrate($intComment)
	 	 {
	 	 	if(is_int($intComment))
	 	 	{
	 	 		$aData = parent::get($intComment);
	 	 		self::hydrate($aData);
	 	 	}else
	 	 	{
	 	 		echo 'les commentaire de l\'épisode '.$intComment.' n\'existe pas'; 
	 	 	}
	 	 }

	 	 public function hydrate($aData)
	 	 {
	 	 	if($aData != false)
	 	 	{
	 	 		$this->setCheckIdentite(true);
		 	 	foreach ($aData[0] as $key => $value)
		 	 	{
		 	 		 // On récupère le nom du setter correspondant à l'attribut en mettant sa première lettre en majuscule. 
		 	 		$method = 'set'.ucfirst($key);
		 	 		if(method_exists($this, $method))
		 	 		{
		 	 			$this->$method($value);
		 	 		}
		 	 	}
		 	}else
		 	{
		 	 	$this->setCheckIdentite(false);
		 	}
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