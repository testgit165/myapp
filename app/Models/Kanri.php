<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Kanri extends Model
{
    public function user(){
        return $this->belongsTo('App\Models\User');
    }


    use Sortable;
    public $sortable = ['user_id','bikou', 'info', 'created_at', 'updated_at'];

static $infos = [
    '出席', '退勤','不在'
    ];

}