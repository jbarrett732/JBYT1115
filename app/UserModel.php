<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'userdomains';

    function cleanTable() {
        DB::table('userdomains')->truncate();
    }

    function dumpTable() {
        return DB::table('userdomains')->get();
    }
}
