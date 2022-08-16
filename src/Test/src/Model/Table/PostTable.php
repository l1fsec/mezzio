<?php

declare(strict_types=1);

namespace Test\Model\Table;

use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\Adapter\Adapter;


class PostTable extends AbstractTableGateway
{
    protected $table = 'users';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    public function getAll()
    {
         $sqlQuery = $this->sql->select();
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);

        return $sqlStmt->execute();
    }
 
    public function insertAccount(array $data)
    {
       // $values = [
           // 'jmeno' => ucfirst(mb_strtolower($data['jmeno'])),
            //'prijmeni' => ucfirst(mb_strtolower($data['prijmeni'])),
           
      //  ];
        // var_dump($data);
        // exit;

        $sqlQuery = $this->sql->insert()->values($data);
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);

        return $sqlStmt->execute();
    }
}