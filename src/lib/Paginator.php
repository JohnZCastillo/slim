<?php

namespace App\lib;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as OrmPaginator;

class Paginator {

    /**
     * @var integer
     */
    private $total;

    /**
     * @var integer
     */
    private $lastPage;

    private $items;

    /**
     * @param QueryBuilder|Query $query
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function paginate($query, int $page = 1, int $limit = 10): Paginator
    {
        $paginator = new OrmPaginator($query);

        $paginator
            ->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        $this->total = $paginator->count();
        $this->lastPage = (int)ceil($paginator->count() / $paginator->getQuery()->getMaxResults());
        $this->items = $paginator;

        return $this;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getLastPage(): int
    {
        return $this->lastPage;
    }

    public function getItems()
    {
        return $this->items;
    }
}
