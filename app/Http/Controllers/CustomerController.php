<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function mealReservations(Request $request)
    {
       $orders = Order::has('mealOrders')->where('delivery_date','!=',null)->get();
    }
    public function info(Request $request)
    {
        $query =  Order::query();
        $month = $request->get('month');
        $from =  Carbon::now();
        $to =  Carbon::now();
        $start_of_month =  $from->setMonth($month)->startOfMonth();
        $end_of_month =  $to->setMonth($month)->endOfMonth();
//        return ['start'=>$start_of_month , 'end'=>$end_of_month];
        $query->when($request->get('month'),function ( $query) use ($start_of_month,$end_of_month){

            $query->whereRaw("Date(created_at) between ? and ?", [$start_of_month, $end_of_month]);

        });
        $customers_query = Customer::query();
        $customers_query->when($request->get('month'),function ( $query) use ($start_of_month,$end_of_month){

            $query->whereRaw("Date(created_at) between ? and ?", [$start_of_month, $end_of_month]);

        });
        $orders = $query->get();
        $customers = $customers_query->get();
        $total_revenues = 0 ;
        /** @var Order $order */
        foreach ($orders as $order){
            $total_revenues += $order->totalPrice();
        }

        return ['totalRevenue'=>$total_revenues,'activeCustomers'=>$customers->count(),'totalOrders'=>$orders->count()];
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return   Customer::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'area' => '',
            'state' => '',
            'is_store' => '',
        ]);

        $customer = Customer::create($data);
        return ['status'=>$customer,'data'=>$customer,'show'=>$customer==true];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:15',
             'area'=> 'sometimes|required|string|max:255',
             'state'=> 'sometimes|required|string|max:255',
             'is_store'=>'',
        ]);

        return ['status'=>$customer->update($data),'data'=>$customer->fresh()];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
         $status =   $customer->delete();
        return response()->json(['status'=>$status]);
    }
}
