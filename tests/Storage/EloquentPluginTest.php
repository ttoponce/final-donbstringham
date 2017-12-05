<?php
/**
 * Created by PhpStorm.
 * User: stringhamdb
 * Date: 11/15/17
 * Time: 6:54 PM
 */

namespace Tests\Storage;

use App\Storage\EloquentPlugin;
use Illuminate\Database\Capsule\Manager;

class EloquentPluginTest extends \PHPUnit_Framework_TestCase {
    /** @var $db Manager **/
    protected $db;

    /**
     *
     */
    public function setUp() {
        $this->db = new Manager();
        $this->db->addConnection(array(
            'driver'    => 'mysql',
            'host'      => '165.227.109.168',
            'database'  => 'web4350',
            'username'  => 'appuser',
            'password'  => 'letmein',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ));
        $this->db->bootEloquent();
        $this->db->setAsGlobal();

        $this->db::statement('CREATE TABLE IF NOT EXISTS test_table(
            id INT(11) NOT NULL AUTO_INCREMENT,
            uuid VARCHAR(36),
            data VARCHAR(255),
            PRIMARY KEY (id))');
    }

    public function tearDown() {
        $this->db::statement('DROP TABLE test_table');
    }

    public function testConstructor() {
        // arrange and act
        $builder = $this->db->table('test_table');
        $harness = new EloquentPlugin($builder);
        // assert
        $this->assertEquals(EloquentPlugin::class, \get_class($harness));
    }

    public function testCreateObject00() {
        // arrange
        $expected = 1;
        $builder = $this->db->table('test_table');
        $harness = new EloquentPlugin($builder);
        // act
        $item = new TestClass00('1234abcd', 'foobar');
        $actual = $harness->Create($item);
        // assert
        $this->assertEquals($expected, $actual);
    }
}

