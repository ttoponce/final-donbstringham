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
    /** @var  $table Builder */
    protected $table;

    public function __construct($table)
    {
        if(empty($table)) {
            throw new \UnexpectedValueException('$table cannot be empty');
        }

        $this->table = $table;

    }

    public function Create($item)
    {
        if (!is_object($item)) {
            throw new \UnexpectedValueException('$item is not an object');
        }

        if(!method_exists($item, 'getID')) {
            throw new \UnexpectedValueException('$item does not have a getID() method');
        }

        $this->table->insert($item);
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