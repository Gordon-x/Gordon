<?php

/**
 * Class Db
 */
class Db
{
    /**
     * @var Db
     */
    private static $conn;

    private $db;

    private static $config = [
        'host' => 'localhost',
        'user' => 'root',
        'passwd' => 'root',
        'dbname' => 'local_test',
    ];

    private function __construct()
    {
        $this->db = mysqli_connect(self::$config['host'], self::$config['user'], self::$config['passwd'],
            self::$config['dbname']);
    }

    /**
     * @return Db
     */
    public static function getInstance()
    {
        if (self::$conn) {
            return self::$conn;
        } else {
            return self::$conn = new self();
        }
    }

    public static function setConf($config)
    {
        self::$config = $config;
    }

    public function query($sql)
    {
        return mysqli_query($this->db, $sql);
    }

    public function fetchOne($sql)
    {
        $result = $this->query($sql);
        return $data = mysqli_fetch_assoc($result);
    }

    public function fetchAll($sql)
    {
        $result = $this->query($sql);
        $data = [];
        while ($tmp = mysqli_fetch_assoc($result)) {
            $data[] = $tmp;
        }
        return $data;
    }

    public function insert($sql)
    {
        if ($this->query($sql)) {
            return mysqli_insert_id($this->db);
        }
        return false;
    }

    public function update($sql)
    {
        if ($this->query($sql)) {
            return mysqli_affected_rows($this->db) && true;
        }
        return false;
    }
}

class test
{
    /**
     * @var Db
     */
    private $_conn;

    public function __construct()
    {
        $this->_conn = Db::getInstance();
    }

    public function getAllCategory()
    {
        $data = $this->_conn->fetchAll('SELECT `id`, `name`,`level` FROM category WHERE level > 0 order by lft');
        echo json_encode($data);
        exit;
    }

    public function addChild($parent, $name)
    {
        $p = $this->_conn->fetchOne('SELECT lft, rgt, level FROM category WHERE id=' . $parent);
        $lft = $p['rgt'];
        $rgt = $lft + 1;
        $lv = $p['level'] + 1;
        $this->_conn->query('begin');
        try {
            $this->_conn->update("update category set rgt=rgt+2 where rgt >= {$p['rgt']} and lft <= {$p['lft']}");
            $this->_conn->update("update category set rgt=rgt+2, lft=lft+2 where rgt >= {$p['rgt']} and lft > {$p['lft']}");
            $this->_conn->insert("INSERT INTO category (name, lft, rgt, level) VALUE ('{$name}',{$lft},{$rgt},{$lv})");
            $this->_conn->query('commit');
        } catch (Exception $err){
            $this->_conn->query('rollback');
            echo $err->getMessage();
        }
        echo 'ok'.PHP_EOL;
    }

    public function del($id){
        $node = $this->_conn->fetchOne('select lft, rgt, level from category where id='.$id);
        $decrease = $node['rgt'] - $node['lft'] + 1;
        $this->_conn->query('begin');
        try {
            $this->_conn->query('DELETE FROM category WHERE id=' . $id . ' LIMIT 1');
            $this->_conn->query('DELETE FROM category WHERE lft > ' . $node['lft'] . ' AND rgt < ' . $node['rgt']);

            $this->_conn->update('UPDATE category SET rgt=rgt-' . $decrease . ' WHERE rgt>=' . $node['rgt'] . ' AND lft<=' . $node['lft']);
            $this->_conn->update('UPDATE category SET lft=lft-' . $decrease . ',rgt=rgt-' . $decrease . ' WHERE rgt>' . $node['rgt'] . ' AND lft>' . $node['lft']);
            $this->_conn->query('commit');
        } catch (Exception $err){
            $this->_conn->query('rollback');
            echo $err->getMessage();
        }

        echo 'ok'.PHP_EOL;
    }
}

if (@$_GET['category']) {
    (new test())->getAllCategory();
}

if (@$_GET['save']) {
    (new test())->addChild($_POST['pid'], $_POST['name']);
}

if (@$_GET['del']) {
    (new test())->del($_POST['id']);
}

if ($argv[1] == 1) {

    $a = new test();
    for($i = 1000; $i > 0; $i--) {
        echo $i.PHP_EOL;
        $a->addChild($i, '测试数据a-'.$i);
    }
}
