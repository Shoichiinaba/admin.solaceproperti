<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Map_model extends Eloquent
{
    protected $table = 'data_map';
    public $timestamps = false;
}
