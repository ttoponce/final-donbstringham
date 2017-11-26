<?php
/**
 * Created by PhpStorm.
 * User: stringhamdb
 * Date: 11/20/17
 * Time: 7:08 PM
 */

namespace App\Storage;

use Illuminate\Database\Query\Builder;

class EloquentPlugin implements AdapterInterface
{
    /** @var  $query Builder */
    protected $query;

    public function __construct(Builder $query)
    {
        if(empty($query)) {
            throw new \UnexpectedValueException('$query cannot be empty');
        }

        $this->query = $query;
    }

    public function Create($item)
    {
        if (!is_object($item)) {
            throw new \UnexpectedValueException('$item is not an object');
        }

        if(!method_exists($item, 'getID')) {
            throw new \UnexpectedValueException('$item does not have a getID() method');
        }

        return $this->query->insertGetId($item->toArray());
    }

    public function Remove($ID)
    {
        // TODO: Implement Remove() method.
    }

    public function RemoveAll()
    {
        // TODO: Implement RemoveAll() method.
    }

    public function Get($ID)
    {
        // TODO: Implement Get() method.
    }

    public function GetAll()
    {
        // TODO: Implement GetAll() method.
    }

    public function Modify($ID, $item)
    {
        // TODO: Implement Modify() method.
    }
}
