<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Authenticate;
use App\Http\Requests\InputRequest;
use App\Http\Resources\DrinkResource;
use App\Http\Resources\InputResource;
use App\Models\Drink;
use App\Models\Input;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InputController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return InputResource::collection(Input::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InputRequest $request)
    {
        $id = uniqid();
        $input = new Input([
            'id' => $id,
            'amount' => $request->amount,
            // 'user_id' => ''
        ]);
        $provider = Provider::find($request->provider_id);
        $provider->inputs()->save($input);
        foreach($request->drinks as $item){
            $drink = Drink::find($item['id']);
            $drink->inputs()->attach($id, ['quantity' => $item['quantity'], 'price' => $item['price']]);
            $drink->quantity = intval($drink->quantity) + intval($item['quantity']);
            $drink->save();
        }

        return new InputResource(Input::findOrFail($input->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Input  $input
     * @return \Illuminate\Http\Response
     */
    public function show(Input $input)
    {
        return new InputResource($input);

    }
    public function details(Request $request, string $id)
    {
        $input = Input::find($id);
        $provider = Provider::find($input->provider_id);
        // dd($input->drinks->first()->pivot);
        return view('details',
            [
                'move' => $input,
                'person' => $provider,
            ]
        );
    }

    public function getLimit()
    {
        return InputResource::collection(Input::latest()->limit(5)->get());
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Input  $input
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Input $input)
    {
        //
    }
    public function transaction_provider(Request $request, $id)
    {
        return InputResource::collection(Input::where('provider_id', '=', $id)->get());
    }

    public function transaction_drinks(Request $request, $id)
    {
        $inputs = DB::table('moves')
        ->join('inputs', 'moves.move_id', '=', 'inputs.id')
        ->join('drinks', function ($join, $id) {
            $join->on('moves.drink_id', '=', 'drinks.id')
                 ->where('drinks.id', '=', $id);
        })
        ->select('inputs.*')
        ->get();

        dd($inputs);

        // return InputResource::collection($inputs);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Input  $input
     * @return \Illuminate\Http\Response
     */
    public function destroy(Input $input)
    {
        //
    }
}
