<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

trait Pageable {
    protected function paginate(Query $query, int $page = 1, int $pageSize = 5){
        $offset = ($page - 1) * $pageSize;
        $query->setFirstResult($offset)->setMaxResults($pageSize);

        return new Paginator($query);
    }
}