<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_order = Order::get_order_with_detail();
        // dd($list_order);
        return view('admin.approval.index', compact('list_order'));
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
    public function update_setuju(Request $request, $id)
    {
        try {
            $updated_by = auth()->user()->name;
            $cust = Order::where('id', $id)->first();

            // $user_id = $cust->id_user;

            $cust->update([
                'status_approval' => 2,
                'approved_by' => $updated_by,
                'updated_by' => $updated_by,
            ]);

            return redirect()->back()->with('success', 'berhasil update persetujuan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
            
        }
    }

    public function update_batal(Request $request, $id)
    {
        try {
            $updated_by = auth()->user()->name;
            $cust = Order::where('id', $id)->first();

            // $user_id = $cust->id_user;

            $cust->update([
                'status_approval' => 3,
                'approved_by' => $updated_by,
                'updated_by' => $updated_by,
            ]);

            return redirect()->back()->with('success', 'berhasil update tolak pengajuan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
            
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
        //
    }
}
