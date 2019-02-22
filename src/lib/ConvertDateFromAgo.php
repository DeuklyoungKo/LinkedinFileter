<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019-02-22
 * Time: 오전 7:51
 */

namespace App\lib;


class ConvertDateFromAgo
{

    /**
     * @param string $dateAgo
     * @return false|\DateTime
     * @throws \Exception
     */
    public function convertDate(string $dateAgo)
    {

        $Number = filter_var($dateAgo,FILTER_SANITIZE_NUMBER_INT);

        $dateNumber = '';

        if (strpos($dateAgo,'minutes') || strpos($dateAgo,'minute')) {
            $dateNumber = strtotime('-'.$Number.' minute');
        }

        if (strpos($dateAgo,'hours') || strpos($dateAgo,'hour')) {
            $dateNumber = strtotime('-'.$Number.' hour');
        }

        if (strpos($dateAgo,'days') || strpos($dateAgo,'day')) {
            $dateNumber = strtotime('-'.$Number.' day');
        }

        if (strpos($dateAgo,'weeks') || strpos($dateAgo,'week')) {
            $dateNumber = strtotime('-'.$Number.' week');
        }

        if (strpos($dateAgo,'months') || strpos($dateAgo,'month')) {
            $dateNumber = strtotime('-'.$Number.' month');
        }

        if ($dateNumber) {
            return new \DateTime(date('Y-m-d H:i:s',$dateNumber));
        }else{
            throw new \Exception("check the data string time : ".$dateAgo);
        }

    }
}