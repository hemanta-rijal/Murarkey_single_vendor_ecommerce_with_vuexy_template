<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 3/26/19
 * Time: 9:51 AM
 */

namespace App\DataTables;


use App\Models\OrderItem;
use Yajra\Datatables\Services\DataTable;
use DB;

class OrdersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     *
     */


    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'operator.partials.dt-actions')
            ->editColumn('product.image', function (OrderItem $item) {
                return sprintf('<img src="%s"  style="zoom: 0.3"/>', $item->product ? resize_image_url($item->product->images[0]->image, '200X200') : '');
            })
            ->editColumn('product.name', function (OrderItem $item) {
                return sprintf('<a href="%s">%s</a>', route('products.show', $item->product), $item->product ? $item->product->name : '');
            })
            ->editColumn('options', function (OrderItem $item) {

                $text = '';

                foreach ($item->options as $key => $value)
                    $text .= sprintf('<small><span>%s : %s</span></small><br>', $key, $value);

                return $text;
            })
            ->editColumn('product.category_id', function (OrderItem $item) {
                return implode(',', array_reverse($this->recursiveCategoryName($item->product->category)));
            })
//            ->editColumn('status', '{{ strtolower($status) }}')
            ->rawColumns(['product.image', 'product.name', 'options', 'action']);
    }


    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = OrderItem::query()->when(request('status'), function ($query) {
            return $query->where('status', request('status'));
        })->when(request('startDate'), function ($query) {
            return $query->where('created_at', '>=', request('startDate'));
        })->when(request('sStartDate'), function ($query) {
            return $query->where(DB::raw('DATE(scan_at)'), '>=', request('sStartDate'));
        })->when(request('order_type'), function ($query) {
            return $query->where(function ($q) {
                return $q->whereNull('seller_awb_no')
                    ->orWhere('seller_awb_no', '=', '')
                    ->orWhereIn('status', OrderItem::NON_RECONCILE);
            });
        })->when(request('endDate'), function ($query) {
            return $query->where('created_at', '<=', request('endDate'));
        })->when(request('sEndDate'), function ($query) {
            return $query->where(DB::raw('DATE(scan_at)'), '<=', request('sEndDate'));
        })->when(request('new_filter'), function ($query) {

            if (request('new_filter') == 'empty') {
                return $query->where(function ($q) {
                    return $q->whereNull('seller_awb_no')->orWhere('seller_awb_no', '');
                });
            } else {
                return $query->where(function ($q) {
                    return $q->whereNotNull('seller_awb_no')->orWhere('seller_awb_no', '<>', '');
                });
            }
        })->with('order', 'product.category.parent.parent', 'product.images', 'product', 'order.user');

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
            ->ajax(route('operator.order-dt.index', request()->all()))
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
            'order_id',
            'product.name',
            'product.image',
            'options',
            'seller_order_no',
            'seller_awb_no',
            'status',
            'created_at',
            'updated_at',
            'product.category_id'
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