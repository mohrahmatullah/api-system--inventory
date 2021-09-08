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
        //one day (today)
        // $date1 = Carbon::now()->format('Y-m-d');
        $input = $req->all();        
        $day_c = Carbon::parse($input['day'])->format('Y-m-d');
        $day = (isset($day_c) ? $day_c : '');
        $product = Product_Masuk::select('product_masuk.id','products.nama as product','suppliers.nama as supplier','product_masuk.qty','product_masuk.status','product_masuk.tanggal')
                    ->leftjoin('products','products.id','product_masuk.product_id')
                    ->leftjoin('suppliers','suppliers.id','product_masuk.supplier_id')
                    ->when($day, function($query, $day) {
                        return $query->where('product_masuk.tanggal', '=', $day);
                        })
                    ->get();
        // $get = Product_Masuk::all();
        // $rt = $this->get_month_start_end($get);
        return response()->json($product);

        // $price_min = (isset($input['price_min']) ? $input['price_min'] : '');
        // $price_max = (isset($input['price_max']) ? $input['price_max'] : '');

        // $acidity_min = (isset($input['acidity_min']) ? $input['acidity_min'] : '');
        // $acidity_max = (isset($input['acidity_max']) ? $input['acidity_max'] : '');

        // $sweetness_min = (isset($input['sweetness_min']) ? $input['sweetness_min'] : '');
        // $sweetness_max = (isset($input['sweetness_max']) ? $input['sweetness_max'] : '');

        // $body_min = (isset($input['body_min']) ? $input['body_min'] : '');
        // $body_max = (isset($input['body_max']) ? $input['body_max'] : '');

        // // $category = (isset($input['category']) ? $input['category'] : '');
        // // $sub_category = (isset($input['sub_category']) ? $input['sub_category'] : '');

        // $all = (isset($input['sort']) && $input['sort'] == 'all' && !$input);
        // $terbaru = (isset($input['sort']) && $input['sort'] == 'terbaru');
        // $termahal = (isset($input['sort']) && $input['sort'] == 'termahal');
        // $termurah = (isset($input['sort']) && $input['sort'] == 'termurah');

        // $product = Product_Masuk::where('status',1)
        //         ->when($day, function($query, $day) {
        //                 return $query->where('created_at', '=', $day);
        //                 })
        //         get();

        // $get_post_data = DB::table('products')               
        //                 ->where('products.delete_status','0')
        //                 ->where('products.status','1')                        
        //                 ->select('products.*','terms.slug as slugcategory')
        //                 ->when($price_min, function($query, $price_min) {
        //                 return $query->where('products.price', '>=', $price_min);
        //                 })
        //                 ->when($price_max, function($query, $price_max) {
        //                 return $query->where('products.price', '<=', $price_max);
        //                 })
        //                 ->when($acidity_min, function($query, $acidity_min) {
        //                 return $query->where('products.acidity', '>=', $acidity_min);
        //                 })
        //                 ->when($acidity_max, function($query, $acidity_max) {
        //                 return $query->where('products.acidity', '<=', $acidity_max);
        //                 })
        //                 ->when($sweetness_min, function($query, $sweetness_min) {
        //                 return $query->where('products.sweetness', '>=', $sweetness_min);
        //                 })
        //                 ->when($sweetness_max, function($query, $sweetness_max) {
        //                 return $query->where('products.sweetness', '<=', $sweetness_max);
        //                 })
        //                 ->when($body_min, function($query, $body_min) {
        //                 return $query->where('products.body', '>=', $body_min);
        //                 })
        //                 ->when($body_max, function($query, $body_max) {
        //                 return $query->where('products.body', '<=', $body_max);
        //                 })
        //                 ->when($all, function($query, $all) {
        //                 return $query->orderBy('products.stock_qty', 'DESC');
        //                 })
        //                 ->when($terbaru, function($query, $terbaru) {
        //                 return $query->orderBy('products.created_at', 'DESC');
        //                 })
        //                 ->when($termahal, function($query, $termahal) {
        //                 return $query->orderBy('products.price', 'DESC');
        //                 })
        //                 ->when($termurah, function($query, $termurah) {
        //                 return $query->orderBy('products.price', 'ASC');
        //                 })
        //                 ->leftjoin('object_relationships', 'object_relationships.object_id', 'products.id')
        //                 ->leftjoin('terms','terms.term_id','object_relationships.term_id')
        //                 // ->when($category, function($query, $category) {
        //                 // return $query->where(['terms.slug' => $category, 'terms.type' => 'product_cat']);
        //                 // })
        //                 ->where(function($query) use ($input) {
        //                   if(isset($input['category'])){
        //                     if(isset($input['sub_category'])) {
        //                       $query->where(['terms.term_id' => $input['sub_category'], 'terms.type' => 'product_cat']);
        //                     }else{
        //                       $query->where(['terms.slug' => $input['category'], 'terms.type' => 'product_cat']);
        //                     }
        //                   }
        //                 })
        //                 ->paginate(12);

        // return $get_post_data;
    }

}
