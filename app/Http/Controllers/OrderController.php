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

    // show all orders
    public function allOrders(){
        return view('orders.all', ['orders' => Order::all()]);
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

    // order marked paid
    public function orderPaid(Request $request){
        Order::where('id', $request->id)->update([
            'paid' => 1
        ]);

        return redirect('orders/all-orders')->with('message', 'Order Marked Paid');
    }

    // order marked unpaid
    public function orderUnPaid(Request $request){
        Order::where('id', $request->id)->update([
            'paid' => 0
        ]);

        return redirect('orders/all-orders')->with('message', 'Order Marked unPaid');
    }
    
    // destory order
    public function destroy(Request $request){
        $product = Ordered_product::where("order_id",$request->id)->get();

        for($i = 0; count($product); $i++){
            $customer = Customer::where('id',$product[$i]->product_id)->get();
        }
        
        $total_qty = $product->product_qty + $customer->quantity;

        Customer::where('id',$product->product_id)->update([
            'quantity' => $total_qty
        ]);

        Ordered_product::where("order_id",$request->id)->delete();
        Order::destroy($request->id);
        return redirect('orders/all-orders')->with('error', 'Order Deleted Successfully');
    }
}