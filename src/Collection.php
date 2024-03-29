<?php

namespace Collections;

use Collections\Contract\CollectionContract;

class Collection implements CollectionContract
{
    /** @var  \ArrayIterator */
    protected $content;

    public function __construct()
    {
        $this->content = new \ArrayIterator();
    }

    public function add($element, $key = null)
    {
        if ($key) {
            $this->content[$key] = $element;
            return $this;
        }
        $this->content->append($element);
        return $this;
    }

    public function count()
    {
        return $this->content->count();
    }

    public function contains($element)
    {
        foreach ($this->content as $content) {
            if ($content == $element) {
                return true;
            }
        }
        return false;
    }

    public function get($key)
    {
        return isset($this->content[$key]) ? $this->content[$key] : false;
    }

    public function all()
    {
        return $this->content;
    }

    public function remove($key)
    {
        $this->content->offsetUnset($key);
        return $this;
    }

    public function clear()
    {
        $this->content = new \ArrayIterator();
        return $this;
    }

    public function isEmpty()
    {
        return $this->count() === 0;
    }

    public function toArray()
    {
        return $this->content->getArrayCopy();
    }

    public function first()
    {
        return reset($this->content);
    }

    public function last()
    {
        return end($this->content);
    }

    public function filter(\Closure $fn){
        $filtered = array_filter($this->toArray(), $fn);
        $this->clear();
        foreach ($filtered as $key=>$item){
            $this->add($item,$key);
        }
    }

    public function sort(){
        $this->content->asort();
        return $this;
    }

}
