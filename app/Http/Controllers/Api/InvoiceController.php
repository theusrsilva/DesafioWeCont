<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $invoices = User::find(auth('api')->user()->id)->invoices()->paginate(5);
        return response()->json($invoices);
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
            'value' => 'required|between:1,9999.99'
        ]);

        $urlCount = Invoice::all()->last()->id;
        $urlCount = $urlCount +1;

        $invoice = new Invoice();
        $invoice->value = $request->value;
        $invoice->status = 'aberta';
        $invoice->expiration = Carbon::now()->addDays(3)->format('Y-m-d H:i:s');
        $invoice->url = 'www.desafiowecont.com/fatura/'.$urlCount;
        $invoice->user_id = auth('api')->user()->id;



        if($invoice->save()){
            return response()->json([
                'success' => true,
                'invoice' => $invoice
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Desculpe, a fatura não pode ser adicionada'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = User::find(auth('api')->user()->id)->invoices()->find($id);

        if (!$invoice) {
            return response()->json([
                'success' => false,
                'message' => 'Desculpe mas você não tem permissão de ver a fatura de id: ' . $id
            ], 400);
        }else{
            return $invoice;
        }

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
            'value' => 'between:1,9999.99',
            'status' => 'in:aberta,paga,atrasada'
        ]);
        $invoice = User::find(auth('api')->user()->id)->invoices()->find($id);
        $updated = $invoice->fill($request->all())->save();
        if(!$invoice){
            return response()->json([
                'success' => false,
                'message' => 'Desculpe, você não tem permissão de atualizar o produto de id: ' . $id
            ], 400);
        }
        if($updated){
            return response()->json([
                'success' => true,
                'invoice' => $invoice
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Desculpe, o produto não ser atualizado'
            ], 500);
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

        $invoice = User::find(auth('api')->user()->id)->invoices()->find($id);

        if (!$invoice) {
            return response()->json([
                'success' => false,
                'message' => 'Desculpe, mas essa fatura não pertence à você!'
            ], 400);
        }

        if ($invoice->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'O produto foi deletado!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'O produto não pode ser deletado!'
            ], 500);
        }

    }
}
