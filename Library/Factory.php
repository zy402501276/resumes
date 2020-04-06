<?php
namespace Library;
class Factory 
{
    /**
     * 工厂设计模式简单使用
     */
    static function createDataBase()
    {
        $db = new \Library\Database\Index();
        return $db;
    }
}