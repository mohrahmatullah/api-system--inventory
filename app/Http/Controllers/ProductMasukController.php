<?php

namespace App\Http\Controllers;


// use App\Exports\ExportProdukMasuk;
use App\Models\Product;
use App\Models\Product_Masuk;
use App\Models\Supplier;
// use PDF;
use Illuminate\Http\Request;
// use Yajra\DataTables\DataTables;
// use Auth;


class ProductMasukController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role:admin,staff');
    // }
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

    public function reportProduct($input = null)
    {
        

        $price_min = (isset($input['price_min']) ? $input['price_min'] : '');
        $price_max = (isset($input['price_max']) ? $input['price_max'] : '');

        $acidity_min = (isset($input['acidity_min']) ? $input['acidity_min'] : '');
        $acidity_max = (isset($input['acidity_max']) ? $input['acidity_max'] : '');

        $sweetness_min = (isset($input['sweetness_min']) ? $input['sweetness_min'] : '');
        $sweetness_max = (isset($input['sweetness_max']) ? $input['sweetness_max'] : '');

        $body_min = (isset($input['body_min']) ? $input['body_min'] : '');
        $body_max = (isset($input['body_max']) ? $input['body_max'] : '');

        // $category = (isset($input['category']) ? $input['category'] : '');
        // $sub_category = (isset($input['sub_category']) ? $input['sub_category'] : '');

        $all = (isset($input['sort']) && $input['sort'] == 'all' && !$input);
        $terbaru = (isset($input['sort']) && $input['sort'] == 'terbaru');
        $termahal = (isset($input['sort']) && $input['sort'] == 'termahal');
        $termurah = (isset($input['sort']) && $input['sort'] == 'termurah');

        $product = Product_Masuk::where('status',1)
                ->when($day, function($query, $day) {
                        return $query->where('created_at', '=', $day);
                        })
                get();

        $get_post_data = DB::table('products')               
                        ->where('products.delete_status','0')
                        ->where('products.status','1')                        
                        ->select('products.*','terms.slug as slugcategory')
                        ->when($price_min, function($query, $price_min) {
                        return $query->where('products.price', '>=', $price_min);
                        })
                        ->when($price_max, function($query, $price_max) {
                        return $query->where('products.price', '<=', $price_max);
                        })
                        ->when($acidity_min, function($query, $acidity_min) {
                        return $query->where('products.acidity', '>=', $acidity_min);
                        })
                        ->when($acidity_max, function($query, $acidity_max) {
                        return $query->where('products.acidity', '<=', $acidity_max);
                        })
                        ->when($sweetness_min, function($query, $sweetness_min) {
                        return $query->where('products.sweetness', '>=', $sweetness_min);
                        })
                        ->when($sweetness_max, function($query, $sweetness_max) {
                        return $query->where('products.sweetness', '<=', $sweetness_max);
                        })
                        ->when($body_min, function($query, $body_min) {
                        return $query->where('products.body', '>=', $body_min);
                        })
                        ->when($body_max, function($query, $body_max) {
                        return $query->where('products.body', '<=', $body_max);
                        })
                        ->when($all, function($query, $all) {
                        return $query->orderBy('products.stock_qty', 'DESC');
                        })
                        ->when($terbaru, function($query, $terbaru) {
                        return $query->orderBy('products.created_at', 'DESC');
                        })
                        ->when($termahal, function($query, $termahal) {
                        return $query->orderBy('products.price', 'DESC');
                        })
                        ->when($termurah, function($query, $termurah) {
                        return $query->orderBy('products.price', 'ASC');
                        })
                        ->leftjoin('object_relationships', 'object_relationships.object_id', 'products.id')
                        ->leftjoin('terms','terms.term_id','object_relationships.term_id')
                        // ->when($category, function($query, $category) {
                        // return $query->where(['terms.slug' => $category, 'terms.type' => 'product_cat']);
                        // })
                        ->where(function($query) use ($input) {
                          if(isset($input['category'])){
                            if(isset($input['sub_category'])) {
                              $query->where(['terms.term_id' => $input['sub_category'], 'terms.type' => 'product_cat']);
                            }else{
                              $query->where(['terms.slug' => $input['category'], 'terms.type' => 'product_cat']);
                            }
                          }
                        })
                        ->paginate(12);

        return $get_post_data;
    }

}
