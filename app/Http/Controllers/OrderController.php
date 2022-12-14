<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Ordered_product;
use Illuminate\Support\Facades\DB;
use PDO;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.new', ['products' => Product::all(), 'customers' => Customer::all()]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // show all orders
    public function allOrders(){
        return view('orders.all');
    }

    // add order fuction
    public function addOrder(){
        $data = json_decode(file_get_contents('php://input'), true);
        Order::create([
            'customer_id' => $data['customer'],
            'total_amount' => $data['total_amount'],
            'paid' => 0
        ]);

        $order_id = DB::getPdo()->lastInsertId();

        for($i = 0; $i < count($data['products']); $i++){

            $product_id = $data['products'][$i]['product_id'];
            $product_qty = $data['products'][$i]['qty'];

            $product = Product::find($product_id);
            $qty = $product['quantity'];

            $newQty = $qty - $product_qty;


            Product::where('id',$product_id)->update([
                'quantity' => $newQty
            ]);

            Ordered_product::create([
                'product_id' => $product_id,
                'product_qty' => $product_qty,
                'product_amount' => $data['products'][$i]['price'],
                'order_id' => $order_id
            ]);
        }

        return response()->json([
            'response' => 'Order Added Successfully'
        ], 200);
    }
}
