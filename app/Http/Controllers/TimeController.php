<?php

namespace App\Http\Controllers;

use App\Time;
use App\Order;
use App\Piece;
use App\Machine;
use App\User;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveTimeRequest;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.times.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $time = new Time(); 
        
        $this->authorize('create', $time);
                           
        return view('admin.times.partials.form', [        
       
            'order'     => Order::pluck('order', 'id'),  
            // 'users'     => User::NotRole(['Admin', 'Supervisor'])->get(), 
            'machine'   => Machine::pluck('machine', 'id'),                     
            'time'      => $time

        ]);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveTimeRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();              
               
                $this->authorize('create', new Time);

               $time                    = new Time;
               $time->denomination      = $request->get('denomination');
               $time->code              = $request->get('code');              
               $time->date              = Carbon::parse($request->get('date'));
               $time->quantity          = $request->get('quantity');
               $time->preparation_time  = $request->get('preparation_time');
               $time->machining_time    = $request->get('machining_time');
               $time->observation       = $request->get('observation');
               $time->order_id          = $request->get('order_id'); 
               $time->user              = $request->get('user');            
               $time->machine_id        = $request->get('machine_id');            
               $time->save();

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
     * @param  \App\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {     
        $order = Order::with('user')->findOrFail($id);   
        //   $order = Piece::with('user','order')->findOrFail($id);   

        if($request->ajax())
        {
            return $order->toJson();
        }  

        return response()->json(['message' => 'recibimos el request pero no es ajax']);
    }

    public function showMachine(Request $request, $id)
    {   
        $machines = Machine::findOrFail($id);       
             
        if($request->ajax())
        {
            return $machines->toJson();
        }  

        return response()->json(['message' => 'recibimos el request pero no es ajax']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $time = Time::findOrFail($id); 
         
        $this->authorize('update', $time); 

        return view('admin.times.partials.form', [   

            'order'     => Order::pluck('order', 'id'),
            // 'users'     => User::NotRole(['Admin', 'Supervisor'])->get(),  
            'machine'   => Machine::pluck('machine', 'id'),                                             
            'time'      => $time

        ]);  
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function update(SaveTimeRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                $time = Time::findOrFail($id); 

                $this->authorize('update', $time);

                // Actualizamos el timepo             
                $time->denomination         = $request->get('denomination');
                $time->code                 = $request->get('code');       
                $time->date                 = Carbon::parse($request->get('date'));
                $time->quantity             = $request->get('quantity');
                $time->preparation_time     = $request->get('preparation_time');
                $time->machining_time       = $request->get('machining_time');
                $time->observation          = $request->get('observation');
                $time->order_id             = $request->get('order_id');     
                $time->user                 = $request->get('user');   
                $time->machine_id           = $request->get('machine_id');           
                $time->save();
                                             
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
     * @param  \App\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function destroy(Time $time)
    {
        //
    }

    public function dataTable()
    {          
        $times = Time::with('machine', 'user', 'order')    
        // ->allowed()            
        ->get();   
                     
        return dataTables::of($times)
                ->addColumn('id', function ($times){
                    return $times->id;
                })   
                ->addColumn('orden', function ($times){
                    return 
                    '<i class="fa fa-file"></i>'.' '.$times->order['order'];
                })  
                ->addColumn('pieza', function ($times){
                    return
                    '<i class="fa fa-check-square-o"></i>'.' '.$times->code."<br>".                   
                    '<i class="fa fa-wrench"></i>'.' '.$times->denomination;
                })                
                ->addColumn('prep', function ($times){
                    return 
                    '<i class="fa fa-clock-o"></i>'.' '.$times->preparation_time;
                })    
                ->addColumn('mec', function ($times){
                    return 
                    '<i class="fa fa-clock-o"></i>'.' '.$times->machining_time;
                })                             
                ->addColumn('maq_op', function ($times){                    
                    return 
                    '<i class="fa fa-cogs"></i>'.' '.$times->machine['machine']."<br>".
                    '<i class="fa fa-user-plus"></i>'.' '.$times->user;  
                      
                })            
                ->addColumn('fecha', function ($times){                    
                    return   '<i class="fa fa-calendar-o"></i>'.' '.$times->created_at->format('d-m-y');
                })
                
                ->addColumn('accion', function ($times) {
                    return view('admin.times.partials._action', [
                        'times'   => $times,
                     
                        'url_edit'  => route('admin.times.edit', $times->id)                      
                  
                    ]);
                })
               
                ->addIndexColumn()   
                ->rawColumns(['orden', 'pieza', 'prep', 'mec', 'maq_op', 'fecha', 'accion'])                
                ->make(true);          
    }
    
}
