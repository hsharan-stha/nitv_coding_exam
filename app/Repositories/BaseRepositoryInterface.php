<?php


namespace App\Repositories;


interface BaseRepositoryInterface
{

    /**
     * Get the query instance for the model.
     *
     * @return mixed
     */
    public function query();


    /**
     * Fetch all the records from the database.
     *
     * @param string $order
     * @param string $orderColumn
     */
    public function all(string $order = 'desc', string $orderColumn = 'id');

    /**
     * Fetch all the records from database with their related models.
     *
     * @param array $relations
     * @param string $order
     * @param string $orderColumn
     * @return mixed
     */
    public function allWithRelation(array $relations = [], string $order = 'desc', string $orderColumn = 'id');

    /**
     * Fetch all the records from database with pagination.
     *
     * @param int $pageSize
     * @param string $order
     * @param string $orderColumn
     * @return mixed
     */
    public function allWithPagination(int $pageSize = 5, string $order = 'desc', string $orderColumn = 'id');

    /**
     * Fetch all the records from database with related models and pagination.
     *
     * @param array $relations
     * @param int $pageSize
     * @param string $order
     * @param string $orderColumn
     * @return mixed
     */
    public function allWithRelationAndPagination(array $relations = [], int $pageSize = 5, string $order = 'desc', string $orderColumn = 'id');


    /**
     * Fetch all the records matching the provided condition.
     *
     * @param array $conditions
     * @param string $order
     * @param string $orderColumn
     * @return mixed
     */
    public function where(array $conditions, string $order = 'desc', string $orderColumn = 'id');

    /**
     * Fetch all the records matching the provided condition with related models.
     *
     * @param array $conditions
     * @param array $relations
     * @param string $order
     * @param string $orderColumn
     * @return mixed
     */
    public function whereWithRelation(array $conditions, array $relations = [], string $order = 'desc', string $orderColumn = 'id');

    /**
     * Fetch all the records matching the provided condition with pagination.
     *
     * @param array $conditions
     * @param bool $pagination
     * @param int $pageSize
     * @param string $order
     * @param string $orderColumn
     * @return mixed
     */
    public function whereWithPagination(array $conditions, bool $pagination = false, int $pageSize = 5, string $order = 'desc', string $orderColumn = 'id');

    /**
     * Fetch all the records matching the provided
     * @param array $conditions
     * @param array $relations
     * @param bool $pagination
     * @param int $pageSize
     * @param string $order
     * @param string $orderColumn
     * @return mixed
     */
    public function whereWithRelationAndPagination(array $conditions, array $relations = [], bool $pagination = false, int $pageSize = 5, string $order = 'desc', string $orderColumn = 'id');

    /**
     * Get the first record matching the provided condition.
     *
     * @param array $conditions
     * @param array $relations
     * @return mixed
     */
    public function first(array $conditions = [], array $relations = []);

    /**
     * Counts the number of existing records.
     *
     * @param array $conditions
     * @return mixed
     */
    public function count(array $conditions = []);


}
