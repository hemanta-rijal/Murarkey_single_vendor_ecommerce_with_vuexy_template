<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Orders\Contracts\OrderService;

class ReportsController extends Controller
{

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());

        $orders = $this->orderService->getDataForReportGeneration($request);

//        dd($orders);

        return Excel::create('reports', function ($excel) use ($orders) {

            $excel->sheet('orders', function ($sheet) use ($orders) {
                $sheet->appendRow(['OrderId', 'Product Url', 'Product Link', 'Seller Order Id', 'Seller AWB', 'Item Qty', 'Item Price', 'Item Remarks', 'Item Sub Total', 'Status', 'Order Date', 'Total', 'Payment', 'Shipment Name', 'Shipment Mobile Number', 'Shipment Address', 'Shipment City', 'User Id', 'User Phone Number', 'User email']);

                $rowCounter = 2;
                $currentOrderRow = 2;
                $mergingColumns = [
                    'A',
                    'K',
                    'L',
                    'M',
                    'N',
                    'O',
                    'P',
                    'Q',
                    'R',
                    'S',
                    'T'
                ];

                $mergingRows = [];

                foreach ($orders as $order) {
                    foreach ($order->items as $item) {
                        if ($order->items->first() == $item) {
                            $sheet->appendRow([
                                $order->id,
                                '',
                                '',
                                $item->seller_order_no . ' ',
                                $item->seller_awb_no . ' ',
                                $item->qty,
                                $item->price,
                                $item->remarks,
                                $item->total,
                                $item->status,
                                $order->created_at->toDateTimeString(),
                                $order->total,
                                $order->payment_method,
                                $order->shipment_details['name'],
                                $order->shipment_details['phone_number'],
                                $order->shipment_details['address'],
                                $order->shipment_details['city'],
                                $order->user_id,
                                $order->user ? $order->user->phone_number : 'DELETED ACCOUNT',
                                $order->user ? $order->user->email : 'DELETED ACCOUNT'
                            ]);
                            $currentOrderRow = $rowCounter;
                        } else {

                            $sheet->appendRow(
                                [
                                    '',
                                    '',
                                    $item->product_link,
                                    $item->seller_order_no . ' ',
                                    $item->seller_awb_no . ' ',
                                    $item->qty,
                                    $item->price,
                                    $item->remarks,
                                    $item->total,
                                    $item->status
                                ]
                            );

                        }

                        $sheet->cell('B' . $rowCounter, function ($cell) use ($item) {
                            $cell->setValue('=Hyperlink("' . route('products.show', $item->product->slug) . '","' . $item->product->id . '")');
                        });

                        $sheet->cell('C' . $rowCounter, function ($cell) use ($item) {
                            if ($item->product_link)
                                $cell->setValue('=Hyperlink("' . $item->product_link . '")');
                        });
                        $rowCounter++;
                    }

                    if ($order->items->count() > 1) {


                        $mergingRows[] = [$currentOrderRow, $currentOrderRow + $order->items->count() - 1];
                    }
                }


//                dd($mergingRows);

                $sheet->setColumnFormat(
                    [
                        'A2:T' . $rowCounter => '@'
                    ]
                );

                $sheet->setMergeColumn(array(
                    'columns' => $mergingColumns,
                    'rows' => $mergingRows
                ));

                $sheet->setAutoSize(true);

            });

        })->export('xls');
#


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
