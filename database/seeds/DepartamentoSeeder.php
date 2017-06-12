<?php
use Faker\Generator;
use ProyectoKpi\Models\Localizaciones\Departamento;
use ProyectoKpi\Models\Localizaciones\GrupoDepartamento;

/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 14/05/2017
 * Time: 10:58
 */
class DepartamentoSeeder extends BaseSeeder
{
    protected $total = 2;

    public function getModel()
    {
        return new Departamento();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
//        return [
//            'nombre' => $faker->name,
//            'grupodep_id' => $this->getRandom('GrupoDepartamento')->id
//        ];
    }
}