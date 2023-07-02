<?php

namespace App\Http\Controllers;

interface ICrudController
{
    /**
     * @param $requestData
     * @param int $id
     */
    public function beforeUpdate(&$requestData, int $id);

    /**
     * @param $requestData
     * @param int $id
     */
    public function afterUpdate(&$requestData, int $id);

    /**
     * @param $requestData
     */
    public function beforeCreate(&$requestData);

    /**
     * @param $requestData
     */
    public function afterCreate(&$requestData);

    /**
     * @param $requestData
     */
    public function updateCleanRequest(&$requestData);

    /**
     * @param $requestData
     */
    public function creteCleanRequest(&$requestData);

}
