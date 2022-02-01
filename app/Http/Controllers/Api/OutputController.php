<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OutputRequest;
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
    public function store(OutputRequest $request)
    {
        $id = uniqid();
        $output = new Output([
            'id' => $id,
            'amount' => $request->amount,
            // 'user_id' => ''
        ]);
        $customer = Customer::find($request->customer_id);
        $customer->outputs()->save($output);

        foreach($request->drinks as $item){
            $drink = Drink::find($item['id']);
            $drink->outputs()->attach($id, ['quantity' => $item['buyQte'], 'price' => $item['price']]);
            $drink->quantity = intval($drink->quantity) - intval($item['buyQte']);
            $drink->save();
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

    public function getLimit()
    {
        return OutputResource::collection(Output::latest()->limit(5)->get());
    }
    public function details(Request $request, string $id)
    {
        $output = Output::find($id);
        $customer = Customer::find($output->customer_id);
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
    public function transaction_customer(Request $request, $id)
    {
        return OutputResource::collection(Output::where('customer_id', '=', $id)->get());
    }
    public function update(Request $request, Output $input)
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
