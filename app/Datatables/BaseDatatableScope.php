<?php

namespace App\Datatables;

use Yajra\Datatables\Html\Builder;

abstract class BaseDatatableScope
{
    /**
     * @var
     */
    protected $partialHtml;

    /**
     * @return mixed
     */
    abstract public function query();

    /**
     * @param null $url
     *
     * @return array
     */
    public function html($url = null)
    {
        $columns = array_merge([
            [
                'data' => 'DT_RowIndex',
                'name' => '1',
                'title' => 'Sl. No.',
            ],
        ],
        $this->partialHtml,
        [
            [
                'data' => 'actions',
                'name' => 'actions',
                'title' => 'Action',
                'searchable' => false,
                'orderable' => false,
            ],
        ]);

        /**
         * @var Builder
         */
        $builder = app('datatables.html');

        return $builder->columns($columns)->parameters([
            'order' => [
                0,
                'desc',
            ],
        ])
        ->ajax($url ?: request()->fullUrl());
    }

    /**
     * @param array $html
     *
     * @return $this
     */
    public function setHtml(array $html)
    {
        $this->partialHtml = $html;

        return $this;
    }
}
