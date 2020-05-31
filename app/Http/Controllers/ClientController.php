<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveClientRequest;
use App\Client;
use DataTables;
use App\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
        $client = new Client();   
        
        $this->authorize('create', $client);      

        $países = $client->pluck('country');       

        return view('admin.customers.partials.form', compact('client', 'países'));     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveClientRequest $request)
    {
        if ($request->ajax()){
            try {
                // utiliza transacciones
                DB::beginTransaction();

                $this->authorize('create', new Client);
                
                
                $client = Client::create($request->all());

                $company = $client->company()->create([
                    'name_company'  => $request['name_company'],
                    'cuit'          => $request['cuit'],
                    'web'           => $request['web'],
                    'phone_company' => $request['phone_company'],                   
                    'client_id'     => $client->id
               ]);

                DB::commit();

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {      
        $client = Client::with('company')->findOrFail($id);

        $this->authorize('view', $client);
        // $clientes = Client::with('company')->get();
        // dd($client);
        return view('admin.customers.show', compact('client'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {     
        $client = Client::with('company')->findOrFail($id);

        $this->authorize('update', $client);      
              
        $países = Client::pluck('country', 'country');   
       
        return view('admin.customers.partials.form', compact('client', 'países'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(SaveClientRequest $request, $id)
    {        
        if ($request->ajax()){
            try {
                // utiliza transacciones
                DB::beginTransaction();
                
                $client = Client::with('company')->findOrFail($id); 

                $this->authorize('update', $client);                
                
                $client->update($request->all()); 
                               
                $company = $client->company()->update([
                    'name_company'  => $request['name_company'],
                    'cuit'          => $request['cuit'],
                    'web'           => $request['web'],
                    'phone_company' => $request['phone_company'],                   
                    'client_id'     => $client->id
                ]);

                DB::commit();

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }              
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::with('company')->findOrFail($id);

        $this->authorize('delete', $client);      

        $client->delete();
    }    

    public function dataTable()
    {
        $clientes = Client::with('company')
        // ->allowed()
        ->get();
               
        return dataTables::of($clientes)
                ->addColumn('id', function ($clientes){
                    return $clientes->id;
                })  
                ->addColumn('cuit', function ($clientes){
                    return $clientes->company['cuit'];
                }) 
                ->addColumn('cliente', function ($clientes){
                    return 
                            '<i class="fa fa-industry"></i>'.' '.$clientes->company['name_company']."<br>".
                            '<i class="fa fa-fax"></i>'.' '.$clientes->company['phone_company']."<br>".
                            '<i class="fa fa-globe"></i>'.' '.$clientes->company['web'];

                })
                ->addColumn('direccion', function ($clientes){
                    return 
                            $clientes->address."<br>".
                            $clientes->city."<br>".
                            $clientes->country;
                })                  
                ->addColumn('contacto', function ($clientes){
                    return
                            '<i class="fa fa-user"></i>'.' '.$clientes->name_client."<br>".
                            '<i class="fa fa-phone"></i>'.' '.$clientes->phone_client."<br>".
                            '<i class="fa fa-envelope"></i>'.' '.$clientes->email;
                })
                ->addColumn('created_at', function ($clientes){
                    return $clientes->created_at->format('d-m-y');
                })                  
                ->addColumn('accion', function ($clientes) {
                    return view('admin.customers.partials._action', [
                        'clientes' => $clientes,
                        'url_show' => route('admin.customers.show', $clientes->id),
                        'url_edit' => route('admin.customers.edit', $clientes->id),
                        'url_destroy' => route('admin.customers.destroy', $clientes->id)
                    ]);
                })
               
                ->addIndexColumn()   
                ->rawColumns(['cliente', 'direccion', 'contacto', 'created_at', 'accion'])                
                ->make(true);          
    }
}
