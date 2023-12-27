<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable; //sorting

class Employee extends Model
{
    //use HasFactory;
    use Sortable;  //sort

    protected $fillable = ['name', 'designation', 'salary'];

    public $sortable = ['id', 'name', 'designation', 'salary']; //sort

}
