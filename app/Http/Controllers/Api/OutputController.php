<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OutputResource;
use App\Models\Customer;
use App\Models\Drink;
use App\Models\Output;
use Illuminate\Http\Request;

class OutputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OutputResource::collection(Output::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = uniqid();
        // $user_id = auth('api')->user()->id;
        // $user_id = Auth::guard('api')->user()->id;
        $output = new Output([
            'id' => $id,
            'amount' => $request->amount,
            // 'user_id' => ''
        ]);
        $customer = Customer::find($request->customer_id);
        $customer->outputs()->save($output);
        // $output = Output::find($id);
        // $user = User::find($user_id);        
        // $user->outputs()->save();
        foreach($request->drinks as $item){
            $drink = Drink::find($item['id']);
            $drink->outputs()->attach($id, ['quantity' => $item['quantity'], 'price' => $item['price']]);
            // $output->drinks()->attach($drink['id'], ['quantity' => $drink['quantity'], 'price' => $drink['price']]);

        }

        return new OutputResource(Output::findOrFail($output->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function show(Output $output)
    {
        //
    }


    public function details(Request $request, string $id)
    {
        $output = Output::find($id);
        $customer = Customer::find($output->customer_id);
        // dd($output->drinks->first()->pivot);
        return view('details',
            [
                'move' => $output,
                'person' => $customer,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Output $output)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function destroy(Output $output)
    {
        //
    }
}
