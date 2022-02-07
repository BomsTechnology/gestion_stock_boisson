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

    public function transaction_bilan_period(Request $request, $period)
    {
        if($period == 'Aujourd\'hui')
        {
            $date =  date("Y-m-d");
            return OutputResource::collection(Output::where('created_at', '=', $date)->get());
        }
        elseif($period == 'Cette Semaine')
        {
            $monday = strtotime('next monday -1 week');
            $monday = date('w', $monday) == date('w') ? strtotime(date('Y-m-d', $monday)."+7 days") : $monday;
            $sunday = strtotime(date('Y-m-d', $monday)." +6 days");
            $date1 = date('Y-m-d', $monday);
            $date2 = date('Y-m-d', $sunday);
            return OutputResource::collection(Output::whereBetween('created_at', [$date1, $date2])->get());
        }
        elseif($period == 'Ce mois')
        {
            $date1 = date('Y-m-d', strtotime("first day of this month"));
            $date2 = date('Y-m-d', strtotime("last day of this month"));
            return OutputResource::collection(Output::whereBetween('created_at', [$date1, $date2])->get());
        }
        else
        {
            $date =  date("Y");
            $date1 = $date."-01"."-01";
            $date2 = $date."-12"."-31";
            return OutputResource::collection(Output::whereBetween('created_at', [$date1, $date2])->get());
        }
        
    }

    public function transaction_bilan_date(Request $request, $date1, $date2)
    {
        return OutputResource::collection(Output::whereBetween('created_at', [$date1, $date2])->get());
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
