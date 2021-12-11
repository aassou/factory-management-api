<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;

interface CrudControllerInterface {

    /**
     * @return mixed
     */
    public function index();

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function read(int $id): mixed;

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, int $id): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed;
}