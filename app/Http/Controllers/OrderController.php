<?php

namespace App\Http\Controllers;

use DataTables;
use App\Order;
use App\User;
use App\Piece;
use App\Client;
use App\Statu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\NotifyAdmin;
use App\Http\Requests\SaveOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        return view('admin.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $order = new Order();      
        
        $this->authorize('create', $order);
                       
        return view('admin.orders.partials.form', [
            'clients'   => Client::all(),      
            'users'     => User::NotRole(['Admin', 'Supervisor'])->get(),
            'status'    => Statu::pluck('statu', 'id'),   
            'orders'    => Order::pluck('denomination', 'id'),        
            // 'pieces'  => Order::pluck('denomination','denomination'), 
            'order'     => $order
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveOrderRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();              
               
                $this->authorize('create', new Order);             
                
                // Creamos la orden
                $order = new Order;             
                $order->date = Carbon::parse($request->get('date'));                      
                $order->order = $request->get('order');
                $order->denomination = $request->get('denomination');
                $order->code = $request->get('code');
                $order->quantity = $request->get('quantity');
                $order->user_id = $request->get('name');
                $order->client_id = $request->get('name_company');   
                $order->statu_id = $request->get('status');           
                $order->save();

             
                $fechaActual = date('Y-m-d');
                $numOrdenes = DB::table('orders')->whereDate('date', $fechaActual)->count();
               

                $arregloDatos = [
                'orders' => [
                            'numero' => $numOrdenes,
                            'msj' => 'Orden'
                        ]              
                ];

                // para notificar a los usuarios
                $allUsers = User::all();

                foreach ($allUsers as $notificar)
                {
                    User::findOrFail($notificar->id)->notify(new NotifyAdmin($arregloDatos));
                }

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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    // Order $order
    public function show(Request $request, $id)
    {
        $client = Client::with('company')->findOrFail($id);       

        if($request->ajax())
        {
            return $client->toJson();
        }  

        return response()->json(['message' => 'recibimos el request pero no es ajax']);
    }

    public function showOrder(Request $request, $id)
    {   
        $order = Piece::findOrFail($id);   
                   
        if($request->ajax())
        {
            return $order->toJson();
        }  

        return response()->json(['message' => 'recibimos el request pero no es ajax']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {   
        $order = Order::findOrFail($id);

        $this->authorize('update', $order);        
       
        // $clients = Client::with('company')->get();
        // $users = User::all();  
        
        // return view('admin.orders.partials.form', compact('order', 'users', 'clients'));        
        return view('admin.orders.partials.form', [
            'clients'   => Client::all(),         
            'users'     => User::NotRole(['Admin', 'Supervisor'])->get(),
            'status'    => Statu::pluck('statu', 'id'),            
            'products'  => Order::pluck('denomination', 'denomination'),
            'order'     => $order
        ]);        
        
    }    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                // utiliza transacciones
                DB::beginTransaction();
                 
                $order = Order::findOrFail($id); 

                $this->authorize('update', $order);

                // Actualizamos la orden              
                // $order->status = $request->get('status');
                $order->date = Carbon::parse($request->get('date'));
                $order->order = $request->get('order');
                $order->denomination = $request->get('denomination');
                $order->code = $request->get('code');
                $order->quantity = $request->get('quantity');
                $order->user_id = $request->get('name');
                $order->client_id = $request->get('name_company');
                $order->statu_id = $request->get('status');             
                $order->save();
               
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $this->authorize('delete', $order);

        $order->delete();
    }

    
    public function dataTable()
    {       
        $ordenes = Order::with(['client.company'], 'user', 'statu')    
        ->allowed()            
        ->get();
            
        return dataTables::of($ordenes)
                ->addColumn('id', function ($ordenes){

                    return $ordenes->id;
                })  
                ->addColumn('orden', function ($ordenes){

                    return '<i class="fa fa-file"></i>'.' '.$ordenes->order;
                })                
                ->addColumn('cliente', function ($ordenes){

                    return 
                    '<i class="fa fa-industry"></i>'.' '.$ordenes->client->company['name_company']."<br>".
                    '<i class="fa fa-phone"></i>'.' '.$ordenes->client->company['phone_company'];                  
                                   
                }) 
                ->addColumn('operario', function ($ordenes){
                    
                    return 
                    '<i class="fa fa-user-plus"></i>'.' '.$ordenes->user['name'];                    
                  
                })              
                ->addColumn('pieza', function ($ordenes){
                    
                    return
                    '<i class="fa fa-check-square-o"></i>'.' '.$ordenes->code."<br>".                   
                    '<i class="fa fa-wrench"></i>'.' '.$ordenes->denomination;
                               
                }) 
                ->addColumn('fecha', function ($ordenes){                 
                    
                    return   '<i class="fa fa-calendar-o"></i>'.' '.$ordenes->date->format('d-m-y');

                })            
                ->addColumn('estado', function ($ordenes){                

                    if($ordenes->statu['statu'] == 'No terminado'){    

                        return '<span class="label label-danger sm">'.$ordenes->statu['statu'].'</span>';
                    }
                    if ($ordenes->statu['statu'] == 'En proceso'){

                        return '<span class="label label-warning sm">'.$ordenes->statu['statu'].'</span>';

                    }else{

                        return '<span class="label label-success sm">'.$ordenes->statu['statu'].'</span>';
                    }
                    
                })
                ->addColumn('accion', function ($ordenes) {

                    return view('admin.orders.partials._action', [
                        'ordenes' => $ordenes,
                        // 'url_show' => route('admin.orders.show', $ordenes->id),
                        'url_edit' => route('admin.orders.edit', $ordenes->id)
                        // 'url_destroy' => route('admin.orders.destroy', $ordenes->id)
                    ]);
                })               
                ->addIndexColumn()   
                ->rawColumns(['orden', 'cliente', 'operario', 'pieza', 'fecha', 'estado', 'accion'])                
                ->make(true);         
    }   
}
