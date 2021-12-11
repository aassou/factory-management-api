<?php
namespace App\Manager;

interface CrudManagerInterface {

    /**
     * @param array $data
     * @param string $currentUserName
     * @return mixed
     */
    public function create(array $data, string $currentUserName): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function read(int $id): mixed;

    /**
     * @param array $data
     * @param string $currentUserName
     * @param int $id
     * @return mixed
     */
    public function update(array $data, string $currentUserName, int $id): mixed;

    /**
     * @param string $currentUserName
     * @param int $id
     * @return void
     */
    public function delete(string $currentUserName, int $id): void;

    /**
     * @return mixed
     */
    public function readAll(): mixed;
}