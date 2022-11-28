<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use App\Models\Orders;
use App\Models\OrdersItem;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function propertiesOrder(Request $request)
    {
        if(request()->ajax())
        {
            $data = OrdersItem::select('orders_item.*', 'properties.title', 'users.name', 'users.email', 'users.mobile', 'orders.order_transaction', 'orders.date', 'orders.status as paymentstatus')
            ->leftJoin('properties', 'properties.id', '=', 'orders_item.property_id')
            ->leftJoin('orders', 'orders.id', '=', 'orders_item.order_id')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->where('orders.status', '=', 'succeeded')
            ->where('orders_item.order_type', '=', 'Property');

            return Datatables::of($data)
            ->addColumn('action', function ($data)
            {

                  $abc = '<a href="'.url('admin/update-order/property/'.$data->id).'" class="btn btn-xs blue"><i class="fa fa-pencil"></i> </a>';

                return '<div class="text-center">'.$abc.'</div>';
            })
            ->editColumn('created_at', function ($request) {
                return [
                  'display' => e($request->created_at->format('d-m-Y')),
                  'timestamp' => $request->created_at->timestamp
                ];
            })
            ->filterColumn('created_at', function ($query, $keyword) {
               $query->whereRaw("DATE_FORMAT(created_at,'%d-%m-%Y') LIKE ?", ["%$keyword%"]);
            })
            ->rawColumns(['action'])
            ->make(true);

        }
        return view('admin.orders.properties');
    }

    public function updatePropertiesOrder($id = null)
    {
        $item = OrdersItem::select('orders_item.*', 'properties.title', 'users.name', 'users.email', 'users.mobile', 'orders.order_currency')
            ->leftJoin('properties', 'properties.id', '=', 'orders_item.property_id')
            ->leftJoin('orders', 'orders.id', '=', 'orders_item.order_id')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->where('orders_item.id', '=', $id)
            ->first();

        if($item)
        {
            return view('admin.orders.update-property-order', ['item' => $item]);
        }
        else
        {
            return redirect('admin/order/properties')->with('danger', 'Something wrong, Please try again later!');
        }  

        
    }

    public function doSavePropertiesOrder(Request $request)
    {

        $post = $request->only('id', 'status', 'admin_id');

        $item = new OrdersItem;

        if($post['id'])
        {
            $id = intval($post['id']);
            $item = $item->find($id);
            if($item->status == 'Pending' || $item->status == 'Booked')
            {
                $item->status = $post['status'];
                $item->admin_id = $post['admin_id'];
                $item->save();
                return redirect('admin/order/properties')->with('success', 'Updated successfully!');
            }
            else
            {
                return redirect('admin/order/properties')->with('danger', 'You cannot change the status now!');
            }
            
        }
    }

    public function toursOrder(Request $request)
    {
        if(request()->ajax())
        {
            $data = OrdersItem::select('orders_item.*', 'properties.title', 'users.name', 'users.email', 'users.mobile', 'orders.order_transaction', 'orders.date')
            ->leftJoin('properties', 'properties.id', '=', 'orders_item.property_id')
            ->leftJoin('orders', 'orders.id', '=', 'orders_item.order_id')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->where('orders.status', '=', 'succeeded')
            ->where('orders_item.order_type', '=', 'Tour');

            return Datatables::of($data)
            ->addColumn('action', function ($data)
            {

                  $abc = '<a href="#" class="btn btn-xs red"><i class="fa fa-times"></i> </a>';

                return '<div class="text-center">'.$abc.'</div>';
            })
            ->editColumn('created_at', function ($request) {
                return [
                  'display' => e($request->created_at->format('d-m-Y')),
                  'timestamp' => $request->created_at->timestamp
                ];
            })
            ->filterColumn('created_at', function ($query, $keyword) {
               $query->whereRaw("DATE_FORMAT(created_at,'%d-%m-%Y') LIKE ?", ["%$keyword%"]);
            })
            ->rawColumns(['action'])
            ->make(true);

        }
        return view('admin.orders.tours');
    }

}
