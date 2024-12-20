<?php

namespace App\Http\Controllers;

use App\Models\ChildMeal;
use App\Models\Order;
use App\Models\OrderMeal;
use App\Models\RequestedChildMeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestedChildMealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request,OrderMeal $orderMeal)
    {
        $child_meal_id = $request->get('child');
        $requestedChildMeal = RequestedChildMeal::where('child_meal_id',$child_meal_id)->where('order_meal_id',$orderMeal->id)->first();
        if ($requestedChildMeal){
           $result =  $requestedChildMeal->delete();
            return ['status'=>$result,'order'=>$orderMeal->order->load('mealOrders'),'show'=>false];

        }
           $childMeal = ChildMeal::find($child_meal_id);
            $data =RequestedChildMeal::create([
                'order_meal_id' => $orderMeal->id,
                 'child_meal_id' =>$childMeal->id,
                 'quantity' => $childMeal->quantity,
                 'price' => $childMeal->price,

            ]);

            return ['status'=>$data,'order'=>$orderMeal->order->load(['mealOrders','mealOrders'=>function ($q) {
                $q->with('requestedChildMeals.orderMeal');
            }]),'show'=>false];

    }
    public function storeAll(Request $request,OrderMeal $orderMeal)
    {

         foreach ($orderMeal->meal->childMeals as $childMeal){
             $data =RequestedChildMeal::create([
                 'order_meal_id' => $orderMeal->id,
                 'child_meal_id' =>$childMeal->id,
                 'quantity' => $childMeal->quantity,
                 'price' => $childMeal->price,

             ]);

         }

            return ['status'=>$data,'order'=>$orderMeal->order->load(['mealOrders','mealOrders'=>function ($q) {
                $q->with('requestedChildMeals.orderMeal');
            }]),'show'=>false];

    }

    /**
     * Display the specified resource.
     */
    public function show(RequestedChildMeal $requestedChildMeal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestedChildMeal $requestedChildMeal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestedChildMeal $requestedChildMeal)
    {
        return ['status'=>$requestedChildMeal->update($request->all()),'order'=>$requestedChildMeal->orderMeal->order->load('mealOrders.meal'),'show'=>false];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequestedChildMeal $requestedChildMeal)
    {
        //
    }
}
