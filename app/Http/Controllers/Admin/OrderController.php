<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Gate;
use App\Validasi;
use App\Order;
use Storage;

class OrderController extends Controller
{   
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (! Gate::allows('can_admin')) {
            return abort(401);
        }

        $order = Order::where('acc_admin', 1)->where('status', '=', 'success')->get();
        return view('admin.order.index', compact('order'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPending()
    {
        if (! Gate::allows('can_admin')) {
            return abort(401);
        }

        $order = Order::where('acc_admin', 0)->where('status', '=', 'success')->get();
        return view('admin.order.pending', compact('order'));
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
        //
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
        //
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
        if (! Gate::allows('can_admin')) {
            return abort(401);
        }

        $order = Order::where('id', $id)->first();
        $order->acc_admin = $request->acc_admin;
        $order->tanggal_mulai = $request->tanggal_mulai;
        $phone = $request->phone;
        $order->save();

            if ($order->acc_admin = 1) {
                $basic  = new \Nexmo\Client\Credentials\Basic('029ddde6', '36bni7chBGJixDej');
                    $client = new \Nexmo\Client($basic);
                    $message = $client->message()->send([
                        'to' => $phone,
                        'from' => 'Teacher Finder Bot',
                        'text' => 'Halo Guru, Ada Orderan Baru nih yang Perlu Acc mu #'.$order->order_id.' Cek Yuk!
                        '
                    ]);
            }
                

        return redirect()->route('admin.order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('can_admin')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Order::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
