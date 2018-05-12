<?php

namespace Kami\IcoBench;


use Kami\IcoBench\Exception\IcoBenchException;

interface ClientInterface
{
    const API_URL = 'https://icobench.com/api/v1/';

    /**
     * Retrieve all ICOs
     *
     * @param string $type
     * @param array $data
     *
     * @throws IcoBenchException
     *
     * @return array
     */
    public function getIcos($type = 'all', $data = []);

    /**
     * Get ICO by id
     *
     * @param int $id
     * @param array $data
     *
     * @throws IcoBenchException
     *
     * @return array
     */
    public function getIco($id, $data = []);

    /**
     * Get other
     *
     * @param $type
     *
     * @throws IcoBenchException
     *
     * @return array
     */
    public function getOther($type);

    /**
     * Get users
     *
     * @param string $type
     * @param array $data
     *
     * @throws IcoBenchException
     *
     * @return array
     */
    public function getPeople($type = 'registered', $data = []);
}