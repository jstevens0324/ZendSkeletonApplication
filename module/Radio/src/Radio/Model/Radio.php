<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 10/26/12
 * Time: 10:59 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Radio\Model;

class Radio
{
    public $id;
    public $radio;
    public $link;

    public function exchangeArray($data)
    {
        $this->id       = (isset($data['id'])) ? $data['id'] : null ;
        $this->radio    = (isset($data['radio'])) ? $data['radio'] : null ;
        $this->link       = (isset($data['link'])) ? $data['link'] : null ;
    }
}