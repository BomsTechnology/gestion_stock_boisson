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
        // $user_id = auth('api')->user()->id;
        // $user_id = Auth::guard('api')->user()->id;
        $input = new Input([
            'id' => $id,
            'amount' => $request->amount,
            // 'user_id' => ''
        ]);
        $provider = Provider::find($request->provider_id);
        $provider->inputs()->save($input);
        // $input = Input::find($id);
        // $user = User::find($user_id);        
        // $user->inputs()->save();
        foreach($request->drinks as $item){
            $drink = Drink::find($item['id']);
            $drink->inputs()->attach($id, ['quantity' => $item['quantity'], 'price' => $item['price']]);
            // $input->drinks()->attach($drink['id'], ['quantity' => $drink['quantity'], 'price' => $drink['price']]);

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
        // return view('details',
        //     [
        //         'input' => '',
        //         'drinks' => 'customers',
        //     ]
        // );
        // $inputR = new InputResource($input);

        // $input = Input::find('61e42f7f453a7');

        // $drinks = collect([]);
        // $drinks = [];

        // foreach($input->drinks as $drink){
        //         // $drinks->push($drink);
        //         array_push($drinks, $drink);
        // }


        // return $input;

        // return new DrinkResource::collection($drinks);

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
