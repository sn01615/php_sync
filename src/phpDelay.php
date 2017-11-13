<?php
namespace PhpUtils;

/**
 *
 * @author YangLong
 * Date: 2017-11-13 14:36
 */
class phpDelay
{
    
    use GetInstances;

    private $tasks = [];

    public function push(callable $closures)
    {
        $this->tasks[] = $closures;
    }

    public function __destruct()
    {
        foreach ($this->tasks as $task) {
            $task();
        }
    }
}

trait GetInstances {

    private static $instances = [];

    /**
     * @return static
     */
    final static public function getInstance()
    {
        $name = get_called_class();
        if (! isset(self::$instances[$name])) {
            self::$instances[$name] = new static();
        }
        return self::$instances[$name];
    }
}

