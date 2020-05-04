<?php

namespace App\Http\Controllers;

use App\Report;
use App\User;
use App\Statu;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.index');
    }

    public function selectOperator()
    {
        $operator = User::NotRole(['Admin', 'Supervisor'])->get();
      
        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' =>'Seleccione',
        ];

        foreach ($operator as $key => $value) {
            $data[$key+1] =[
                'id'   => $value->id,
                'text' => $value->name,
            ];           
        }
        return ['operators' => $data];        
    } 
    
    public function selectStatus()
    {   
        
        $status = Statu::all();
      
        $data = [];
        $data[0] = [
                'id'   => 0,
                'text' =>'Seleccione',
            ];
            foreach ($status as $key => $value) {
            $data[$key+1] =[
                    'id'   => $value->id,
                    'text' => $value->statu,
                ];
            
            }
        return ['status' =>$data];

    } 
    
    public function getChart($status)
    {
        if($status == 0){
            $order = DB::table('users')
        ->join('orders','orders.user_id','=','users.id')
        ->join('status','orders.statu_id','=','status.id')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id') 
        ->select('users.id','users.name', DB::raw('COUNT(orders.id) as orders_by_user'), 'model_has_roles.role_id as rol', 'color')//color    
        ->where('model_has_roles.role_id', '2'); 
      
        $order->groupBy('orders.user_id', 'users.id',  'users.name',  'model_has_roles.role_id', 'color');//color
                
     
        $orders = $order->get();

        return ['orders' => $orders];  
          
        }else{
            $order = DB::table('users')
            ->join('orders','orders.user_id','=','users.id')
            ->join('status','orders.statu_id','=','status.id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id') 
                                       
            ->select('users.id','users.name', 'status.id', 'status.statu', DB::raw('COUNT(orders.id) as orders_by_user'), 'model_has_roles.role_id as rol', 'color')      
            ->where('model_has_roles.role_id', '2');
               
         
            $order->where('orders.statu_id', $status);
            
           
            $order->groupBy('users.id','users.name', 'orders.statu_id', 'status.id',  'status.statu',  'model_has_roles.role_id', 'color');
         
            $orders = $order->get();
    
            return ['orders' => $orders]; 

        }
                 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // $users = $order->pluck('name');
        // $orders = $order->pluck('orders_by_user');

        // return compact('users', 'orders');
       

        // $users = collect();
        // $orders = collect();

        // $records = Order::with(['user' => function($query){
        //     return $query->withCount('orders');
        // }])        
        // ->get();

        // $records->each(function($record) use($users, $orders) {
        //     $users->push($record->user->name);
        //     $orders->push($record->user->orders_count);
        // });

        // return compact('users', 'orders');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = DB::table('users')
        ->join('orders','orders.user_id','=','users.id')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')                                    
        // ->select('users.id','users.name', DB::raw('COUNT(orders.id) as orders_by_user'), 'model_has_roles.role_id as rol')      
        ->select('users.id','users.name', 'status.id', 'status.statu', DB::raw('COUNT(orders.id) as orders_by_user'), 'model_has_roles.role_id as rol')      
        ->select('users.id','users.name', DB::raw('COUNT(orders.id) as orders_by_user'), 'orders.status', DB::raw('(orders.status) as status'), 'model_has_roles.role_id as rol')  
        ->where('model_has_roles.role_id', '2');
           
        if($status!=0){
            $order->where('orders.status', $status);
        } 
    
        // $order->groupBy('orders.user_id', 'users.id',  'users.name',  'model_has_roles.role_id');
        $order->groupBy('orders.user_id', 'users.id',  'users.name',  'model_has_roles.role_id', 'orders.status');
        $order->groupBy('orders.user_id', 'users.id',  'users.name', 'orders.statu_id', 'status.id',  'status.statu',  'model_has_roles.role_id');
        $orders = $order->get();

        return ['orders' => $orders];
       // return ['orders' => $orders, 'users'=> User::NotRole(['Admin', 'Supervisor'])->get()];
      
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //$status = "Terminado";
        dd($status);
        if($status == "Seleccionado"){
        $order = DB::table('users')
        ->join('orders','orders.user_id','=','users.id')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')                                    
        // ->select('users.id','users.name', DB::raw('COUNT(orders.id) as orders_by_user'), 'model_has_roles.role_id as rol')      
        ->select('users.id','users.name', DB::raw('COUNT(orders.id) as orders_by_user'), 'orders.status', DB::raw('(orders.status) as status'), 'model_has_roles.role_id as rol')  
        ->where('model_has_roles.role_id', '2');
           
        }else{
            $order = DB::table('users')
        ->join('orders','orders.user_id','=','users.id')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')                                    
        // ->select('users.id','users.name', DB::raw('COUNT(orders.id) as orders_by_user'), 'model_has_roles.role_id as rol')      
        ->select('users.id','users.name', DB::raw('COUNT(orders.id) as orders_by_user'), 'orders.status', DB::raw('(orders.status) as status'), 'model_has_roles.role_id as rol')  
        ->where('model_has_roles.role_id', '2')
        ->where('orders.status', $status);
        } 
    
        // $order->groupBy('orders.user_id', 'users.id',  'users.name',  'model_has_roles.role_id');
        $order->groupBy('orders.user_id', 'users.id',  'users.name',  'model_has_roles.role_id', 'orders.status');
        $orders = $order->get();

        return ['orders' => $orders]; 
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    // public function edit($status=null)
    // { //anda
    //     $order = DB::table('users')
    //     ->join('orders','orders.user_id','=','users.id')
    //     ->join('status','orders.statu_id','=','status.id')
    //     ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id') 
                                   
    //     ->select('users.id','users.name', 'status.id', 'status.statu', DB::raw('COUNT(orders.id) as orders_by_user'), 'model_has_roles.role_id as rol')      
    //     ->where('model_has_roles.role_id', '2');
           
    //     if($status!=0){
    //         $order->where('orders.statu_id', $status);
    //     } 
    
    //     // $order->groupBy('orders.user_id', 'users.id',  'users.name',  'model_has_roles.role_id');
    //     $order->groupBy('users.id','users.name', 'orders.statu_id', 'status.id',  'status.statu',  'model_has_roles.role_id');
     
    //     $orders = $order->get();

    //     return ['orders' => $orders];
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }  

  
}
