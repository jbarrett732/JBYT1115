<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class TableModel extends Model
{
    protected $table = 'domains';

    function cleanTable() {
        DB::table('domains')->truncate();
    }

    function dumpTable() {
        return DB::table('domains')->get();
    }
}
