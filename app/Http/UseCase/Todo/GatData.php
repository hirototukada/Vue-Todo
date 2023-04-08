<?php

namespace App\Http\UseCase\Todo;

use App\Models\Todo;

class getData
{
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * ページ数取得用
     *
     * @param [type] $page
     * @return array
     */
    public function countReplacement($page)
    {
        $pages = [];
        if ($page == 1) {
            $pages['start'] = $page - 1;
            $pages['next']  = $page * 10;
        } else {
            $page['start'] = ($page - 1) * 10;
            $pages['next'] = $page * 10;
        }

        return $pages;
    }
}
