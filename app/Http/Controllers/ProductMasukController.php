<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_Masuk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductMasukController extends Controller
{
    public $carbonObject;
  
    public function __construct(){
        $this->carbonObject         =  new Carbon();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product_Masuk::all();
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
            'supplier_id'    => 'required',
            'qty'            => 'required',
            'tanggal'        => 'required'
        ]);

        Product_Masuk::create($request->all());

        // $product = Product::findOrFail($request->product_id);
        // $product->qty += $request->qty;
        // $product->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Products In Created'
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
        $product_masuk = Product_Masuk::find($id);
        return $product_masuk;
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
            'supplier_id'    => 'required',
            'qty'            => 'required',
            'tanggal'        => 'required'
        ]);

        $pm = Product_Masuk::findOrFail($id);
        if($pm->status == 1){
            $product = Product::findOrFail($request->product_id)->first();
            $product->qty = $product->qty - $pm->qty;
            $product->save(); 
        }          
        if($pm){
            $product_masuk = Product_Masuk::findOrFail($id);
            $product_masuk->status = '0';
            $product_masuk->update($request->all());
            return response()->json([
                'success'    => true,
                'message'    => 'Product In Updated'
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
        $product_masuk = Product_Masuk::findOrFail($id);
        if($product_masuk->status == 1){
            $product = Product::findOrFail($product_masuk->product_id)->first();
            $product->qty = $product->qty - $product_masuk->qty;
            $product->save();

            if($product){
                Product_Masuk::destroy($id);

                return response()->json([
                    'success'    => true,
                    'message'    => 'Products In Deleted'
                ]);
            } 
        }else{
            Product_Masuk::destroy($id);
            return response()->json([
                'success'    => true,
                'message'    => 'Products In Deleted'
            ]);
        }
              
    }


    public function statusApprove($id)
    {
        $p = Product::findOrFail($product->product_id);
        $product = Product_Masuk::findOrFail($id);
        if($product->qty > 0){
            $product->status = '1';
            $product->save();

            if($product){
                $p->qty += $product->qty;
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

    public function get_month_start_end( $data )
      {
        $new_ary = array();
        $month_name = array(
            1 => 'January', 
            2 => 'February', 
            3 => 'March', 
            4 => 'April', 
            5 => 'May', 
            6 => 'June', 
            7 => 'July', 
            8 => 'August', 
            9 => 'September', 
            10 => 'October', 
            11 => 'November', 
            12 => 'December');

        $date_start = array(
            1 => '01-01 00:00:00', 
            2 => '02-01 00:00:00', 
            3 => '03-01 00:00:00', 
            4 => '04-01 00:00:00', 
            5 => '05-01 00:00:00', 
            6 => '06-01 00:00:00', 
            7 => '07-01 00:00:00', 
            8 => '08-01 00:00:00', 
            9 => '09-01 00:00:00', 
            10 => '10-01 00:00:00', 
            11 => '11-01 00:00:00', 
            12 => '12-01 00:00:00');
        $date_end  = array(
            1 => '01-31 23:59:00', 
            2 => '02-29 23:59:00', 
            3 => '03-31 23:59:00', 
            4 => '04-31 23:59:00', 
            5 => '05-31 23:59:00', 
            6 => '06-31 23:59:00', 
            7 => '07-31 23:59:00', 
            8 => '08-31 23:59:00', 
            9 => '09-31 23:59:00', 
            10 => '10-31 23:59:00', 
            11 => '11-31 23:59:00', 
            12 => '12-31 23:59:00');
        
        for($i = 1; $i<= $this->carbonObject->today()->month; $i ++)
        {
          $index = $this->carbonObject->today()->year.'-'.$i;
          $new_ary[$index] = array(
            'month' => $month_name[$i].', '.$this->carbonObject->today()->year,
            'date_start' => $this->carbonObject->today()->year.'-'.$date_start[$i] ,
            'date_end' => $this->carbonObject->today()->year.'-'.$date_end[$i]
            );
        }
         
        // foreach($data as $row)
        // {
        //   $index = $this->carbonObject->parse($row->tanggal)->year.'-'.$this->carbonObject->parse($row->tanggal)->month;
          
        //   if(array_key_exists($index, $new_ary))
        //   {
        //     $new_ary[$index] =  $row->qty;
        //   }
        // }

        // $arr = get_defined_vars();
        // dd($new_ary);
        return $new_ary;
    }


    public function reportProductIn(Request $req)
    {
        $input = $req->all();  

        $start_c = Carbon::parse($input['start'])->format('Y-m-d');
        $start = (isset($start_c) ? $start_c : '');

        $end_c = Carbon::parse($input['end'])->format('Y-m-d');
        $end = (isset($end_c) ? $end_c : '');

        $product = Product_Masuk::select('product_masuk.id','products.nama as product','suppliers.nama as supplier','product_masuk.qty','product_masuk.status','product_masuk.tanggal')
                    ->leftjoin('products','products.id','product_masuk.product_id')
                    ->leftjoin('suppliers','suppliers.id','product_masuk.supplier_id')
                    ->when($start, function($query, $start) {
                        return $query->where('product_masuk.tanggal', '>=', $start);
                    })
                    ->when($end, function($query, $end) {
                        return $query->where('product_masuk.tanggal', '<=', $end);
                    })
                    ->get();
        // $get = Product_Masuk::all();
        // $rt = $this->get_month_start_end($get);
        return response()->json($product);
    }

}
