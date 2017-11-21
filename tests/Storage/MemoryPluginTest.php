<?php
/**
 * Created by PhpStorm.
 * User: stringhamdb
 * Date: 11/15/17
 * Time: 6:54 PM
 */

namespace Tests\Storage;

use App\Storage\MemoryPlugin;
use Doctrine\Instantiator\Exception\UnexpectedValueException;

class TestClass00 {
    protected $ID;
    protected $data;

    public function __construct($ID, $data) {
        $this->ID = $ID;
        $this->data = $data;
    }

    public function GetID() {
        return $this->ID;
    }

    public function GetData() {
        return $this->data;
    }
}

class TestClass01 {
    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function GetData() {
        return $this->data;
    }
}

class MemoryPluginTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor() {
        // arrange
        $expected = MemoryPlugin::class;
        // act
        $actual = new MemoryPlugin();
        // assert
        $this->assertEquals($expected, get_class($actual));
    }

    public function testCreateNumber() {
        // arrange
        $expected = new TestClass00(1, 5);
        $harness = new MemoryPlugin();
        $harness->Create(new TestClass00(1, 5));
        // act
        $actual = $harness->Get(1);
        // assert
        $this->assertEquals($expected->GetData(), $actual->GetData());
    }

    public function testCreateStringNumber() {
        // arrange
        $expected = new TestClass00(1, [5, 'foobar']);
        $harness = new MemoryPlugin();
        $harness->Create(new TestClass00(1, [5, 'foobar']));
        // act
        $actual = $harness->Get(1);
        // assert
        $this->assertEquals($expected->GetData(), $actual->GetData());
    }

    /**
     * @expectedException UnexpectedValueException
     * @expectedExceptionMessage $item is not an object
     */
    public function testCreateNumberFailure00() {
        // arrange
        $harness = new MemoryPlugin();
        // act & assert
        $harness->Create(1);
    }

    /**
     * @expectedException UnexpectedValueException
     * @expectedExceptionMessage $item does not have a getID()
     */
    public function testCreateNumberFailure01() {
        // arrange
        $mocko = new TestClass01('');
        $harness = new MemoryPlugin();
        // act & assert
        $harness->Create($mocko);
    }
}