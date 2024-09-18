<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\product;
use App\Models\Sales;
use App\Models\SalesDetail;
use Illuminate\Validation\Rules\Can;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        $penjualan = Sales::max('id');

        $id_transaksi = $penjualan->id ?? "";
        $id_transaksi++;
        $kode_transaksi = "SL" . date('dmY') . sprintf("%03s", $id_transaksi);



        return view('penjualan.index', compact('categories', 'kode_transaksi'));
    }


    public function getKode() {}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dateFormat = date('Y-m-d', strtotime($request->tanggal_transaksi));
        $sales = Sales::create([
            'trans' => $request->kode_transaksi,
            'trans_date' => $dateFormat,
            'trans_total_price' => $request->total_price,
            'trans_paid' => $request->dibayar,
            'trans_change' => $request->kembalian
        ]);

        foreach ($request->product_id as $key => $product) {
            SalesDetail::create([
                'seles_id' => $sales->id,
                'product_id' => $request->product_id[$key],
                'qty' => $request->qty[$key],
                'sub_total' => $request->sub_total[$key]
            ]);
        }
        alert()->success('BERHASIL', 'Transaksi berhasil di simpan');

        return redirect()->to('print/' . $sales->id)->with('message', 'Transaksi berhasil di simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getProducts($category_id)
    {
        $product = Product::where('category_id', $category_id)->get();
        return response()->json($product);
    }

    public function getProduct($product_id)
    {
        $product = Product::findOrFail($product_id);
        return response()->json($product);
    }

    public function print($id_sales)
    {
        $sales = Sales::where('id', $id_sales)->first();
        $detail_seles = SalesDetail::with('product')->where('seles_id', $id_sales)->get();
        return view('penjualan.print', compact('sales', 'detail_seles'));
    }
}
