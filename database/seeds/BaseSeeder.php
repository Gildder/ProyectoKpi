<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use \Faker\Generator;

/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 14/05/2017
 * Time: 10:23
 */
abstract class BaseSeeder extends Seeder
{
    protected $total = 50;
    protected static $pool = array();

    public function run()
    {
        $this->createMultiple($this->total);
    }


    /* Metodos Abstractos */
    abstract public function getModel();

    /**
     * @param Generator $faker
     * @param array $customValues
     * @return mixed
     */
    abstract public function getDummyData(Generator $faker, array $customValues = array());

    /* Metodos Concretos */
    protected function createMultiple($total, array $customValues = array())
    {
        for ($i = 1; $i <= $total; $i++){
            $this->create($customValues);
        }
    }

    protected function create(array $customValues = array())
    {
        $values = $this->getDummyData(Faker::create(), $customValues);
        $values = array_merge($values, $customValues);

        return $this->addToPool($this->getModel()->create($values));
    }

    protected function createFrom($seeder, array $customValues = array())
    {
        $seeder = new $seeder;

        return $seeder->create($customValues);
    }

    protected function getRandom($model)
    {
        if (! $this->collectionExist($model))
        {
            throw new Exception("The $model collection does not exist");
        }

        return static::$pool[$model]->random();
    }

    private function addToPool($entity)
    {
        $reflection = new ReflectionClass($entity);
        $class = $reflection->getShortName();

        if (! $this->collectionExist($class))
        {
            static::$pool[$class] = new  Collection();
        }

        static::$pool[$class]->add($entity);

        return $entity;
    }

    private function collectionExist($class)
    {
        return isset (static::$pool[$class]);
    }
}