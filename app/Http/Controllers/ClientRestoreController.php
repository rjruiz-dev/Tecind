<?php

namespace App\Http\Controllers;

use DataTables;
use App\Client;

use Illuminate\Http\Request;

class ClientRestoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.customers.restore');
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
        //
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

    public function restore($id)
    {
        $client = Client::withTrashed()->where('id',$id)->first();
        $client->restore();      
        
        // $this->authorize('delete', $client);         
    }    

    public function dataTable()
    {
        $clientes = Client::onlyTrashed()->get()->map(function ($client) {
            $client->deleted_client = $client->company()->withTrashed()->first();
            return $client;
        });        
               
        return dataTables::of($clientes)
                ->addColumn('id', function ($clientes){
                    return $clientes->id;
                })  
              
                ->addColumn('cliente', function ($clientes){
                    return 
                            '<i class="fa fa-industry"></i>'.' '.$clientes->deleted_client['name_company']."<br>".
                            '<i class="fa fa-phone"></i>'.' '.$clientes->deleted_client['phone_company']."<br>".
                            '<i class="fa fa-globe"></i>'.' '.$clientes->deleted_client['web'];

                })
                           
                ->addColumn('contacto', function ($clientes){
                    return
                            '<i class="fa fa-user"></i>'.' '.$clientes->name_client."<br>".
                            '<i class="fa fa-phone"></i>'.' '.$clientes->phone_client."<br>".
                            '<i class="fa fa-envelope"></i>'.' '.$clientes->email;
                })
                ->addColumn('deleted_at', function ($clientes){
                    return $clientes->deleted_at->format('d-m-y');
                })

                ->addColumn('accion', function ($clientes) {
                    return view('admin.customers.partials._action_restore', [
                        'clientes' => $clientes,
                        'url_restore' => route('admin.clients.restore', $clientes->id)
                        
                    ]);
                })                  
               
                ->addIndexColumn()   
                ->rawColumns(['cliente', 'contacto', 'deleted_at', 'accion'])                
                ->make(true);          
    }
}
