<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stores_Outlets;

class StoresOutletsController extends Controller
{
    /**
     * Display a listing of the resource.
     **/
    public function index(Request $request, Stores_Outlets $storesOutlets)
    {
        if(!request()->user()->can('index stores')){
            return $this->Forbidden();
        }

        $validator = validator()->make($request->all(), [
        'search' => 'nullable|string|max:255',
    ]);

    if ($validator->fails()) {
        return $this->BadRequest($validator);
    }

    $query = Stores_Outlets::query()
        ->when($request->search, function($q) use ($request) {
            $q->where('name', 'like', '%'.$request->search.'%');
        });
        $filteredStoresOutlets = $query->paginate(30);

        
        return $this->Success($filteredStoresOutlets, "Stores retrieved successfully.");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!request()->user()->can('create store')){
            return $this->Forbidden();
        }

        $validator = validator()->make($request->all(), [
            "name" => "required|string|unique:stores__outlets|min:4|max:64",
            "address" => "required|string|unique:stores__outlets|min:4|max:255",
            "contact_number" => "required|phone:PH|unique:stores__outlets",
        ]);

        if($validator->fails()){
            return $this->BadRequest($validator);
        }

        $storesOutlets = Stores_Outlets::create($request->all());
        return $this->Created($storesOutlets);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!request()->user()->can('view store')){
            return $this->Forbidden();
        }

        $storesOutlets = Stores_Outlets::find($id);
        if(empty($storesOutlets)){
            return $this->NotFound();
        }
        return $this->Success($storesOutlets);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!request()->user()->can('update store')){
            return $this->Forbidden();
        }

        $storesOutlets = Stores_Outlets::find($id);
        if(!$storesOutlets){
            return $this->NotFound();
        }

        $validator = validator()->make($request->all(), [
            "name" => "sometimes|string|unique:stores__outlets,name,$id|min:4|max:64",
            "address" => "sometimes|string|unique:stores__outlets,address,$id|min:4|max:255",
            "contact_number" => "sometimes|phone:PH|unique:stores__outlets,contact_number,$id",
        ]);

        if($validator->fails()){
            return $this->BadRequest($validator);
        }

        $storesOutlets->update($validator->validated());
        return $this->Success($storesOutlets);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!request()->user()->can('delete store')){
            return $this->Forbidden();
        }

        $storesOutlets = Stores_Outlets::find($id);
        if(!$storesOutlets){
            return $this->NotFound();
        }

        $storesOutlets->delete();
        return $this->Success($storesOutlets, "Deleted");
    }
}
