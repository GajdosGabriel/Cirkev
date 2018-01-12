<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 25.11.2017
 * Time: 13:42
 */

namespace App\Filters;


use Illuminate\Http\Request;

abstract class Filters
{

    protected $request, $builder;
    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        if ($this->request->has('search')) {
            $this->search($this->request->search);
        }

        if ($this->request->has('by')) {
            $this->by($this->request->by);
        }


        return $this->builder->where('group_id', '!=' , '5' );

    }
}