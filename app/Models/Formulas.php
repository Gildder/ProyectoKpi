<?php

namespace ProyectoKpi\Models;



use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Models\Empleado;
use Yajra\Datatables\Facades\Datatables;

class Formulas extends Model
{
    

    public function obtenerFormula($nro)
    {
    	switch ($nro) {
    		case '1':
    			# code...
    			break;

			case '2':
				# code...
				break;
		
			case '3':
				# code...
				break;
		
			case '4':
				# code...
				break;
		
			case '5':
				# code...
				break;
    		
    		default:
    			# code...
    			break;
    	}

        return $this->hasMany('ProyectoKpi\Models\IndicadorPrimer');
    }

}
