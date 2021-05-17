<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 3/26/19
 * Time: 9:51 AM
 */

namespace App\DataTables;


use App\Models\NotFoundAwb;
use App\Models\OrderItem;
use Yajra\Datatables\Services\DataTable;
use DB;

class NotFoundAWBDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     *
     */


    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query());
    }


    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = NotFoundAwb::query()->when(request('startDate'), function ($query) {
            return $query->where('created_at', '>=', request('startDate'));
        })->when(request('endDate'), function ($query) {
            return $query->where('created_at', '<=', request('endDate'));
        });

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->ajax(route('operator.not-found-awb.index', request()->all()))
            ->addAction(['width' => '80px'])
            ->parameters([
                'order' => [[0, 'desc']],
//                'dom'          => 'Bfrtip',
                'buttons' => [
//                    'create',
                    'export',
                    'print',
                    'reset',
                    'reload',
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'awb',
            'created_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'orders_' . time();
    }

    protected function recursiveCategoryName($cat, $values = []) {
        $values[] = $cat->name;
        if ($cat->parent_id) return $this->recursiveCategoryName($cat->parent, $values);

        return $values;
    }
}