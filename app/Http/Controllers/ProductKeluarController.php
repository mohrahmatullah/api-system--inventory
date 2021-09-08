<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Product_Keluar;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product_Keluar::all();
        return response()->json($product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'product_id'     => 'required',
           'customer_id'    => 'required',
           'qty'            => 'required',
           'tanggal'           => 'required'
        ]);

        Product_Keluar::create($request->all());

        // $product = Product::findOrFail($request->product_id);
        // $product->qty -= $request->qty;
        // $product->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Products Out Created'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_keluar = Product_Keluar::find($id);
        return $product_keluar;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_id'     => 'required',
            'customer_id'    => 'required',
            'qty'            => 'required',
            'tanggal'           => 'required'
        ]);

        $pm = Product_Keluar::findOrFail($id); 
        if($pm->status == 1){            
            $product = Product::findOrFail($request->product_id)->first();
            $product->qty = $product->qty + $pm->qty;
            $product->save(); 
        }         
        if($pm){
            $product_keluar = Product_Keluar::findOrFail($id);
            $product_keluar->status = '0';
            $product_keluar->update($request->all());
            return response()->json([
                'success'    => true,
                'message'    => 'Product Out Updated'
            ]);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_keluar = Product_Keluar::findOrFail($id);
        if($product_keluar->status == 1){
            $product = Product::findOrFail($product_keluar->product_id)->first();
            $product->qty = $product->qty + $product_keluar->qty;
            $product->save();

            if($product){
                Product_Keluar::destroy($id);

                return response()->json([
                    'success'    => true,
                    'message'    => 'Products In Deleted'
                ]);
            } 
        }else{
            Product_Keluar::destroy($id);
            return response()->json([
                'success'    => true,
                'message'    => 'Products In Deleted'
            ]);
        }         
    }

    public function statusApprove($id)
    {        
        $product = Product_Keluar::findOrFail($id);
        $p = Product::findOrFail($product->product_id);
        if($product->qty > 0 && $product->qty <= $p->qty){
            $product->status = '1';
            $product->save();

            if($product){
                $p->qty -= $product->qty;
                $p->save();
                return response()->json([
                    'success'    => true,
                    'message'    => 'Products Sudah Di Approve'
                ]);
            } 
        }else{
            return response()->json([
                'success'    => false,
                'message'    => 'Products Qty Di periksa kembali'
            ]);
        }
              
    }

    public function reportProductOut(Request $req)
    {
        //one day (today)
        // $date1 = Carbon::now()->format('Y-m-d');
        $input = $req->all();        
        $day_c = Carbon::parse($input['day'])->format('Y-m-d');
        $day = (isset($day_c) ? $day_c : '');
        $product = Product_Keluar::select('product_keluar.id','products.nama as product','customers.nama as customers','product_keluar.qty','product_keluar.status','product_keluar.tanggal')
                    ->leftjoin('products','products.id','product_keluar.product_id')
                    ->leftjoin('customers','customers.id','product_keluar.customer_id')
                    ->when($day, function($query, $day) {
                        return $query->where('product_keluar.tanggal', '=', $day);
                        })
                    ->get();
        return response()->json($product);

    }
}
