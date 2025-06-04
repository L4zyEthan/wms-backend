<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductOrder;

class ProductOrderController extends Controller
{
    public function index()
    {
        if (!request()->user()->can('index product orders')) {
            return $this->Forbidden();
        }

        $productOrders = ProductOrder::with('store', 'transactionType')->paginate(10);

        if ($productOrders->isEmpty()) {
            return $this->NotFound();
        }

        return $this->Success($productOrders);
    }

    public function store(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "store_id" => "required|exists:stores__outlets,id",
            "transaction_type_id" => "required|exists:transaction__types,id",
            "products" => "required|array",
            "products.*" => "array",
            "products.*.product_id" => "required|exists:products,id",
            "products.*.quantity" => "required|numeric|min:0.01|max:1000000",
            "total_transaction_price" => "nullable|numeric|min:0|max:1000000",
            "note" => "nullable|string|max:255",
        ]);
        
        if($validator->fails()){
            return $this->BadRequest($validator);
        }

        // Save to product_orders table
        $orderData = [
            'store_id' => $request->store_id,
            'transaction_type_id' => $request->transaction_type_id,
            'total_transaction_price' => $request->total_transaction_price ?? 0,
            'note' => $request->note,
            'user_id' => $request->user()->id,
        ];
        $productOrder = ProductOrder::create($orderData);

        // Prepare products for pivot table
        $items = [];
        foreach ($request->products as $product) {
            $items[$product['product_id']] = [
                'quantity' => $product['quantity']
            ];
        }
        // Save to product_productorders pivot table
        $productOrder->products()->sync($items);

        return $this->Created($productOrder->load('products'), 'Product order created successfully.');
    }

    public function show($id)
    {
        if (!request()->user()->can('view product order')) {
            return $this->Forbidden();
        }

        $productOrder = ProductOrder::with('store', 'transactionType', 'products')->find($id);

        if (empty($productOrder)) {
            return $this->NotFound();
        }

        return $this->Success($productOrder);
    }

}
