<?php

namespace App\Http\Controllers;
use DataTables;
use App\Gag;
use App\Machine;
use App\User;
use App\Tool;
use App\Piece;
use App\Program;
use App\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SavePieceRequest;

class PieceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pieces.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $piece = new Piece(); 
        
        $this->authorize('create', $piece);
                           
        return view('admin.pieces.partials.form', [        
       
            'part_piece'    => Piece::pluck('part_piece', 'part_piece'), 
            // 'denomination'  => Piece::pluck('denomination', 'denomination'),

            // 'users'         => User::NotRole(['Admin', 'Supervisor'])->get(),               
           
            'tools'         => Tool::all(), 

            'machine'       => Machine::pluck('machine', 'id'),
            'order'         => Order::pluck('denomination', 'id'),             
            
            'number_gag'    => Gag::pluck('number_gag', 'id'),           
                     
            'part_program'  => Program::pluck('part_program', 'part_program'),                      
            'piece'         => $piece
        ]);       
    }    
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePieceRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();              
               
                $this->authorize('create', new Piece);

                $program = Program::create($request->all());
            
                $piece = $program->piece()->create([
                    
                    'code'         => $request['code'],
                    'time'         => $request['time'],
                    'part_piece'   => $request['part_piece'],         
                    'gag_id'       => $request['number_gag'],
                    'machine_id'   => $request['machine_id'],                       
                    'order_id'     => $request['order_id'],  
                    'user'         => $request['user'], 
                    'program_id'   => $program->id                     
                ]);
                // dd($piece);                           
             
                $piece->syncTools($request->get('tools'));
                           
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
     * @param  \App\Piece  $Piece
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $pieces = Piece::with('gag', 'machine', 'tools', 'program')->findOrFail($id); 

        $this->authorize('view', $pieces);
  
        return view('admin.pieces.show', compact('pieces'));

      
   
   
    }

    public function showGag(Request $request, $id)
    {   
        $gags = Gag::findOrFail($id);       
             
        if($request->ajax())
        {
            return $gags->toJson();
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

    public function showOrder(Request $request, $id)
    {   
        $order = Order::with('user')->findOrFail($id);   
                   
        if($request->ajax())
        {
            return $order->toJson();
        }  

        return response()->json(['message' => 'recibimos el request pero no es ajax']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Piece  $Piece
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $piece = Piece::with('gag')->findOrFail($id); 
         
        $this->authorize('update', $piece); 

        return view('admin.pieces.partials.form', [         
        
            'part_piece'    => Piece::pluck('part_piece', 'part_piece'), 
            // 'denomination'  => Piece::pluck('denomination', 'denomination'), 

            // 'users'         => User::NotRole(['Admin', 'Supervisor'])->get(),               
     
            'tools'         => Tool::all(),

            'machine'       => Machine::pluck('machine', 'id'),     
            'order'         => Order::pluck('denomination', 'id'),                   
          
            'number_gag'    => Gag::pluck('number_gag', 'id'),            
           
            'part_program'  => Program::pluck('part_program', 'part_program'),                      
            'piece'         => $piece
        ]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Piece  $Piece
     * @return \Illuminate\Http\Response
     */
    public function update(SavePieceRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();  
                
                $piece = Piece::with('program')->findOrFail($id); 

                $this->authorize('update', $piece);
                
                $piece->update([
                    'user'         => $request['user'],
                    'code'         => $request['code'],
                    'time'         => $request['time'],
                    'part_piece'   => $request['part_piece'],         
                    'gag_id'       => $request['number_gag'], 
                    'machine_id'   => $request['machine_id'],                     
                    'order_id'     => $request['order_id'],    
                    'program_id'   => $piece->program->id                     
                ]);
              
                $piece->program->update($request->all());
                
                $piece->syncTools($request->get('tools'));
                
                
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
     * @param  \App\Piece  $Piece
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $piece = Piece::findOrFail($id);

        // // $this->authorize('delete', $piece);

        // $piece->delete();
    }

    public function exportPdf()
    {
        $pieces = Piece::with('gag', 'machine', 'tools', 'program')->get(); 
        
        $pdf = PDF::loadView('admin.pieces.show', compact('pieces'));  
       
        return $pdf->download('exportpdf.pdf');
   
    	// $users = User::get();
    	// $pdf   = PDF::loadView('pdf.users', compact('users'));

    	// return $pdf->download('user-list.pdf');
    }


    public function dataTable()
    {    
        // $pieces = Piece::query()        
        $pieces = Piece::with('machine')    
        // ->allowed()
        ->get();   
                     
        return dataTables::of($pieces)
                ->addColumn('id', function ($pieces){
                    return $pieces->id;
                })  
                ->addColumn('pieza', function ($pieces){
                    return
                    '<i class="fa fa-check-square-o"></i>'.' '.$pieces->order['code']."<br>".                   
                    '<i class="fa fa-wrench"></i>'.' '.$pieces->order['denomination'];
                })                 
                ->addColumn('maq_op', function ($pieces){                    
                    return 
                    '<i class="fa fa-cogs"></i>'.' '.$pieces->machine['machine']."<br>".
                    '<i class="fa fa-user-plus"></i>'.' '.$pieces->user;  
                      
                })                 
                ->addColumn('parte', function ($pieces){                    
                    return $pieces->part_piece;
                })                  
                ->addColumn('fecha', function ($pieces){                
                    return   '<i class="fa fa-calendar-alt"></i>'.' '.$pieces->created_at->format('d-m-y');
                })               
                ->addColumn('accion', function ($pieces) {
                    return view('admin.pieces.partials._action', [
                        'pieces'   => $pieces,
                        'url_show' => route('admin.pieces.show', $pieces->id),
                        'url_edit' => route('admin.pieces.edit', $pieces->id)                      
                       
                    ]);
                })
               
                ->addIndexColumn()   
                ->rawColumns(['pieza', 'maq_op',  'parte', 'fecha', 'accion'])                
                ->make(true);          
    }
    
}
 // 'url_show'  => route('admin.pieces.show', $pieces->id),