<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/* Models */
use File;
use App\Records;
use App\Barangay;
use App\ContactPerson;
use App\Allowances;
use App\CivilStatus;
use App\User;

/* plugin */
use Yajra\Datatables\Datatables;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Dashboard";

        return view('admin.dashboard', $data);
    }

    public function adminProfile()
    {
        $data['title'] = "Admin Profile";

        return view('admin.profile', $data);
    }

    public function getSeniorCitizenPage()
    {
        $data['title'] = "Senior Citizen Record Management";
        $data['barangays'] = Barangay::all();
        $data['civil_status'] = CivilStatus::all();

        return view('admin.senior_citizen', $data);
    }

    public function saveRecord(Request $request)
    {
        $this->validate($request, [
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $name = md5(time() . "-" . $request->file('profile_photo')->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');

            if (File::isDirectory($destinationPath)) {
                $image->move($destinationPath, $name);
            } else {
                File::makeDirectory($destinationPath);
                $image->move($destinationPath, $name);
            }
        }
        
        // $lastID = DB::getPdo()->lastInsertId() != 0 ? DB::getPdo()->lastInsertId() : 16;
        // $unique_id_num = str_pad(mt_rand(1, 99999999), 3, '0', STR_PAD_LEFT) . '-' . str_pad($lastID, 3, '0', STR_PAD_LEFT);;
        // $data = array(
        //     'fname' => strtoupper($request->fname),
        //     'lname' => strtoupper($request->lname),
        //     'mname' => strtoupper($request->mname),
        //     'gender' => $request->gender,
        //     'birthdate' => date('Y-m-d', strtotime($request->birthdate)),
        //     'civil_status' => $request->civil_status,
        //     'unique_id_num' => $unique_id_num,
        //     'address' => ucwords($request->address),
        //     'barangay' => $request->barangay,
        //     'street' => $request->street,
        //     'phone_num' => $request->phone_num,
        //     'tel_num' => $request->tel_num,
        // );

        // $record_id = Records::create($data);

        // $data_cp = array(
        //     'record_id' => $record_id,
        //     'fname' => strtoupper($request->cp_fname),
        //     'lname' => strtoupper($request->cp_lname),
        //     'mname' => strtoupper($request->cp_mname),
        //     'address' => ucwords($request->cp_address),
        //     'phone_num' => $request->cp_phone_num,
        //     'tel_num' => $request->cp_tel_num,
        // );

        // if ($data_cp) {
        //     return redirect()->back()->with('message', 'success');
        // } else {
        //     return redirect()->back()->with('message', 'error');
        // }

        // dd($request);
    }

    public function getRecordsData()
    {
        $records = DB::table('records')
            ->where('status', 1)
            ->select([
                'id',
                'fname',
                'mname',
                'lname',
                'birthdate',
                'gender'
            ]);

        return Datatables::of($records)
            ->addColumn('fullname', function ($records) {
                return $records->fname . ' ' . $records->mname . ' ' . $records->lname;
            })
            ->addColumn('action', function ($records) {
                return '<a id="btn-view" data-id="' . $records->id . '" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> </a>&nbsp;<a href="#" id="btn-del" data-id="' . $records->id . '" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </a>';
            })
            ->editColumn('birthdate', function ($records) {
                return $records->birthdate ? date_diff(date_create($records->birthdate), date_create('today'))->y : '';
            })
            ->make(true);
    }

    public function deleteRecord(Request $request)
    {
        $data = Records::where('id', $request->data)
            ->update(['status' => 0]);

        if ($data) {
            return response()->json([
                'msg'   => "Successfully Deleted!",
                'status' => 200
            ]);
        } else {
            return response()->json([
                'msg'   => "Oops! Something went wrong.",
                'status' => 500
            ]);
        }
    }
}
