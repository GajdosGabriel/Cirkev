<?php

namespace App\Filters;

use Illuminate\Http\Request;


class PostFilters extends Filters {

    protected $filters = ['search'];

    /**
     * @param $searchWord
     * @return mixed
     */
    protected function search($searchWord)
    {
        return $this->builder->where('title', 'LIKE', '%' . $searchWord . '%');
    }

    protected function by($userName)
    {
       return $this->builder->whereUserId($userName);

    }


}