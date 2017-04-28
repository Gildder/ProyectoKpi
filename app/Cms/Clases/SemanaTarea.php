<?php
namespace ProyectoKpi\Cms\Clases;
	/**
	* Clase SemanaTarea para gestionar los datos de las semana de trabajo de una tarea
	*/
	class SemanaTarea
	{
		private $anio;
		private $mes;
		private $semana;
		private $fechaInicio;
		private $fechaFin;
		
		function __construct()
		{
			
		}

		public function set($atributo, $valor)
		{
			$this->$atributo = $valor;
		}

		public function get($atributo)
		{
			return $this->$atributo;
		}
	}
 ?>