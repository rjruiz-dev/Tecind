<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Client;
use App\Statu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $anio = [date('Y')];
        $data = [
                'ordenes' => Order::selectRaw('year(date) year')
                    ->selectRaw('count(*) orders')
                    ->groupBy('year')
                    ->whereYear('date',$anio)
                    ->get(),

                'clientes' => Client::selectRaw('year(created_at) year')
                    ->selectRaw('count(*) clients')  
                    ->groupBy('year')    
                    ->whereYear('created_at',$anio)              
                    ->get(),

                'usuarios' => User::selectRaw('year(created_at) year')
                ->selectRaw('count(*) users')  
                ->groupBy('year')    
                ->whereYear('created_at',$anio)              
                ->get()
        ];

        return  view('layouts.dashboard', $data, $anio);
    }   

    public function getChartBar(Request $request)
    {            
        $anio = date('Y');
        $ordenes = DB::table('orders as o')
        
        ->select(DB::raw('MONTHNAME(o.date) as mes'),
                DB::raw('YEAR(o.date) as anio'),            
                DB::raw('COUNT(*) as total'))        
        ->whereYear('o.date',$anio)
        ->groupBy(DB::raw('MONTHNAME(o.date)'),DB::raw('YEAR(o.date)'))
        ->get();     

        return ['ordenes' => $ordenes, 'anio' => $anio];              
    }
    
    public function getChartDoughnut(Request $request)
    {   
        $anio = date('Y');
        $month = date('m');
        $estados = DB::table('orders as o')
        ->join('status','o.statu_id','=','status.id')

        ->select(DB::raw('MONTHNAME(o.date) as mes'),
                DB::raw('YEAR(o.date) as anio'),
                DB::raw('o.statu_id'),
                DB::raw('status.id'),    
                DB::raw('status.statu'),    
                // DB::raw('(o.status) as estado'),             
                DB::raw('COUNT(*) as total'))     
       
        ->whereYear('o.date', $anio)
        ->whereMonth('o.date', $month)
       
        ->groupBy(DB::raw('MONTHNAME(o.date)'),  DB::raw('(o.statu_id)') ,DB::raw('(status.id)'), DB::raw('(status.statu)'),DB::raw('YEAR(o.date)'))
        ->get();    

        return ['estados' => $estados, 'anio' => $anio];             
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

    public function selectPieces()
    {       
        $pieces = Order::select('denomination')
                ->distinct('denomination')
                ->get();
      
        $data = [];
        $data[0] = [
                'id'   => 'Seleccione',
                'text' => 'Seleccione',
            ];
            foreach ($pieces as $key => $value) {
            $data[$key+1] =[
                    'id'   => $value->denomination,
                    'text' => $value->denomination,
                ];
            
            }
        return ['pieces' =>$data];

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

    public function getChartPiece($name)
    {        
        if($name == 'Seleccione'){
            // dd($pieces);
            $piece = DB::table('users')
            ->join('orders','orders.user_id','=','users.id')
            ->join('pieces','pieces.order_id','=','orders.id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id') 
            ->select('users.id','users.name', 'pieces.time', 'orders.denomination',  'orders.quantity', 'model_has_roles.role_id as rol')    
            ->where('model_has_roles.role_id', '2'); 

            $piece->groupBy('orders.user_id', 'orders.denomination', 'users.id', 'users.name', 'pieces.time',  'orders.quantity', 'model_has_roles.role_id');   
            $pieces = $piece->get();

            return ['pieces' => $pieces];
        
        }else{  
            $piece = DB::table('users')
            ->join('orders','orders.user_id','=','users.id')
            ->join('pieces','pieces.order_id','=','orders.id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id') 
            ->select('users.id','users.name', 'pieces.time', 'orders.denomination', 'orders.quantity', 'model_has_roles.role_id as rol')    
            ->where('model_has_roles.role_id', '2')
            ->where('orders.denomination', $name); 

            $piece->groupBy('orders.user_id', 'orders.denomination', 'users.id', 'users.name', 'pieces.time', 'orders.quantity', 'model_has_roles.role_id');   
            $pieces = $piece->get();

            return ['pieces' => $pieces];
        }
    }

    public function getOrders($user=null, $status=null, $month=null)
    {
        // $sql = "SELECT us.name, us.id, COUNT(o.id) AS c_orders 
        //         FROM users us, model_has_roles mhr, orders o
        //         WHERE us.id = mhr.model_id and mhr.role_id=2
        //         AND o.user_id = us.id 
        //         -- $filter
        //         GROUP BY o.user_id";

        $_orders = DB::table('users')
                        ->join('orders','orders.user_id','=','users.id')
                        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')                        
                        ->select('users.id','users.name', DB::raw('COUNT(orders.id) as orders_by_user'), 'model_has_roles.role_id as rol')                                   
                        ->where('model_has_roles.role_id', '2');
        if($status!=0){
            $_orders->where('orders.status', $status);
        }
        if($user!=0){ // suponiendo que viene id de usuario
            $_orders->where('users.id', $user);
        }

        if($month!=0){ // suponiendo que viene id de usuario
            // $query->where('title', "LIKE", "%$title%");
            $_orders->where('orders.date', 'LIKE', "%-{$month}-%");
        }

        $_orders->groupBy('orders.user_id', 'users.id',  'users.name',  'model_has_roles.role_id');
        $orders=$_orders->get();
    
        return ['orders' => $orders, 'users'=> User::NotRole(['Admin', 'Supervisor'])->get()];     

       



        //         $orders->andwhere('orders.status', 'TERMINADO')                       
        //                 ->groupBy('orders.user_id') //DB::raw('orders.id as orders_by_user'), 
        //                 ->get();
        // dd(User::NotRole(['Admin', 'Supervisor'])->get());
        
        
       

       

       
        // $filter = '';
        // if($status!=null){
        //     $filter = "AND orders.status = '$status' ";
        // }

        // $sql = "SELECT users.name, users.id, COUNT(orders.id) AS c_orders 
        //         FROM users, model_has_roles, orders
        //         WHERE users.id = model_has_roles.model_id and model_has_roles.role_id=2
        //         AND orders.user_id = users.id 
        //         $filter
        //         GROUP BY orders.user_id";

        // return ['ordenes' => $sql];


        // if($status!=null){
        //     $filter = "AND o.status = '$status' ";
        // } 

        
     
            
        // $sql = "SELECT us.name, us.id, COUNT(o.id) AS c_orders 
        //         FROM users us, model_has_roles mhr, orders o
        //         WHERE us.id = mhr.model_id and mhr.role_id=2
        //         AND o.user_id = us.id 
        //         -- $filter
        //         GROUP BY o.user_id";

        // return ['ordenes' => $sql];

        // $users_list = DB::select($sql);
        // dd($users_list);                 

    }

    public function getChartPiecees($user)
    {
        
        if($user == 0){
            // dd($pieces);
            $piece = DB::table('users')
            ->join('orders','orders.user_id','=','users.id')
            ->join('pieces','pieces.order_id','=','orders.id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id') 
            ->select('users.id','users.name', 'pieces.time', 'orders.denomination', 'model_has_roles.role_id as rol')    
            ->where('model_has_roles.role_id', '2'); 

            $piece->groupBy('orders.user_id', 'orders.denomination', 'users.id', 'users.name', 'pieces.time', 'model_has_roles.role_id');   
            $pieces = $piece->get();

            return ['pieces' => $pieces];
        
        }else{  
            $piece = DB::table('users')
            ->join('orders','orders.user_id','=','users.id')
            ->join('pieces','pieces.order_id','=','orders.id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id') 
            ->select('users.id','users.name', 'pieces.time', 'orders.denomination', 'model_has_roles.role_id as rol')    
            ->where('model_has_roles.role_id', '2')
            ->where('users.id', $user); 

            $piece->groupBy('orders.user_id', 'orders.denomination', 'users.id', 'users.name', 'pieces.time', 'model_has_roles.role_id');   
            $pieces = $piece->get();

            return ['pieces' => $pieces];
        }
    }

}
