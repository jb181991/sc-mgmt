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
use App\Contribution;
use App\Pension;
use App\User;
use App\UserProfile;
use App;

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
        $data['base_url'] = App::make("url")->to('/');

        return view('admin.senior_citizen', $data);
    }

    public function saveRecord(Request $request)
    {
        if (empty($request->id)) {
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

            $lastID = DB::table('records')->selectRaw('max(id) as id')->first()->id != 0 ? DB::table('records')->selectRaw('max(id) as id')->first()->id : 1;
            $unique_id_num = str_pad(mt_rand(1, 99999999), 3, '0', STR_PAD_LEFT) . '-' . str_pad($lastID, 3, '0', STR_PAD_LEFT);;
            $data = array(
                'fname' => strtoupper($request->fname),
                'lname' => strtoupper($request->lname),
                'mname' => strtoupper($request->mname),
                'ename' => strtoupper($request->ename),
                'gender' => $request->gender,
                'birthdate' => date('Y-m-d', strtotime($request->birthdate)),
                'civil_status' => $request->civil_status,
                'unique_id_num' => $unique_id_num,
                'profile_pic' => 'public/images/' . $name,
                'address' => ucwords($request->address),
                'barangay' => $request->barangay,
                'street' => $request->street,
                'phone_num' => $request->phone_num,
                'tel_num' => $request->tel_num,
            );

            $record_id = Records::create($data);

            $data_cp = array(
                'record_id' => $record_id->id,
                'cp_fname' => strtoupper($request->cp_fname),
                'cp_lname' => strtoupper($request->cp_lname),
                'cp_mname' => strtoupper($request->cp_mname),
                'cp_ename' => strtoupper($request->cp_ename),
                'relationship' => ucwords($request->relationship),
                'cp_address' => ucwords($request->cp_address),
                'cp_phone_num' => $request->cp_phone_num,
                'cp_tel_num' => $request->cp_tel_num,
            );

            $resultData = ContactPerson::create($data_cp);
        } else {
            if (empty($request->pic)) {
                $this->validate($request, [
                    'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ]);

                if ($request->hasFile('profile_photo')) {
                    $image = $request->file('profile_photo');
                    $name = 'public/images/' . md5(time() . "-" . $request->file('profile_photo')->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/images');

                    if (File::isDirectory($destinationPath)) {
                        $image->move($destinationPath, $name);
                    } else {
                        File::makeDirectory($destinationPath);
                        $image->move($destinationPath, $name);
                    }
                }
            } else {
                $name = $request->pic;
            }

            $data = array(
                'fname' => strtoupper($request->fname),
                'lname' => strtoupper($request->lname),
                'mname' => strtoupper($request->mname),
                'ename' => strtoupper($request->ename),
                'gender' => $request->gender,
                'birthdate' => date('Y-m-d', strtotime($request->birthdate)),
                'civil_status' => $request->civil_status,
                'unique_id_num' => $request->unique_id_num,
                'profile_pic' => $name,
                'address' => ucwords($request->address),
                'barangay' => $request->barangay,
                'street' => $request->street,
                'phone_num' => $request->phone_num,
                'tel_num' => $request->tel_num,
            );

            $record_id = Records::where('id', '=', $request->id)->update($data);

            $data_cp = array(
                'record_id' => $request->id,
                'cp_fname' => strtoupper($request->cp_fname),
                'cp_lname' => strtoupper($request->cp_lname),
                'cp_mname' => strtoupper($request->cp_mname),
                'cp_ename' => strtoupper($request->cp_ename),
                'relationship' => ucwords($request->relationship),
                'cp_address' => ucwords($request->cp_address),
                'cp_phone_num' => $request->cp_phone_num,
                'cp_tel_num' => $request->cp_tel_num,
            );

            $resultData = ContactPerson::where('id', '=', $request->cs_id)->update($data_cp);
        }

        if ($resultData) {
            return redirect('/admin-record')->with('message', 'success');
        } else {
            return redirect('/admin-record')->with('message', 'error');
        }
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
                'ename',
                'birthdate',
                'gender',
                'unique_id_num'
            ]);

        return Datatables::of($records)
            ->addColumn('fullname', function ($records) {
                $name = isset($records->ename) ? $records->fname . ' ' . $records->mname . ' ' . $records->lname . ' ' . $records->ename : $records->fname . ' ' . $records->mname . ' ' . $records->lname;
                return $name;
            })
            ->addColumn('action', function ($records) {
                return '<a href="' . App::make("url")->to("/admin-edit-record/" . $records->id) . '" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i> </a>&nbsp;<a id="btn-view" data-id="' . $records->id . '" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> </a>&nbsp;<a href="#" id="btn-del" data-id="' . $records->id . '" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </a>';
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

    public function getSpecificRecord(Request $request)
    {
        $data = DB::table('records')
            ->join('contact_person', 'records.id', '=', 'contact_person.record_id')
            ->join('civil_status', 'records.civil_status', '=', 'civil_status.id')
            ->join('barangays', 'records.barangay', '=', 'barangays.id')
            ->where('records.id', '=', $request->data)
            ->select('records.*', 'contact_person.*', DB::raw('barangays.name as barangays'), DB::raw('civil_status.name as cs'))
            ->get();

        if ($data) {
            return response()->json([
                'user'  => $data,
                'status' => 200
            ]);
        } else {
            return response()->json([
                'status' => 500
            ]);
        }
    }

    public function editRecord($id)
    {
        $data['title'] = "Edit Record";
        $data['records'] = Records::where('id', '=', $id)->get();
        $data['contact_person'] = ContactPerson::where('record_id', '=', $id)->get();
        $data['barangays'] = Barangay::all();
        $data['civil_status'] = CivilStatus::all();
        $data['base_url'] = App::make("url")->to('/');

        return view('admin.edit_record', $data);
    }

    public function getSeniorContribution()
    {
        $data['title'] = "Senior Citizen Contribution";
        $data['data'] = DB::table('contributions')
            ->join('records', 'contributions.senior_id', '=', 'records.id')
            ->selectRaw("CONCAT(records.fname,' ',records.mname, ' ',records.lname, ' ', CASE WHEN records.ename IS NULL THEN ' ' ELSE records.ename END) as full_name,
                contributions.id,
                contributions.amount,
                contributions.created_at,
                contributions.updated_at,
                records.unique_id_num")
            ->where('contributions.status', '=', 1)
            ->get();
        $data['records'] = Records::all();
        $data['base_url'] = App::make("url")->to('/');

        return view('admin.contributions', $data);
    }

    public function getSeniorPension()
    {
        $data['title'] = "Senior Citizen Pension";
        $data['data'] = DB::table('pensions')
            ->join('records', 'pensions.senior_id', '=', 'records.id')
            ->selectRaw("CONCAT(records.fname,' ',records.mname, ' ',records.lname, ' ', CASE WHEN records.ename IS NULL THEN ' ' ELSE records.ename END) as full_name,
                pensions.id,
                pensions.pension_amount,
                pensions.created_at,
                pensions.updated_at,
                records.unique_id_num")
            ->where('pensions.status', '=', 1)
            ->get();
        $data['records'] = Records::all();
        $data['base_url'] = App::make("url")->to('/');

        return view('admin.pensions', $data);
    }

    public function getAdminUsers()
    {
        $data['title'] = "Users";
        $data['data'] = DB::table('users')
                ->join('user_profile','users.id','=','user_profile.user_id')
                ->join('barangays', 'user_profile.user_brgy', '=', 'barangays.id')
                ->where('users.status', '=', 1)
                ->selectRaw("users.id,users.name, users.email,users.created_at,users.updated_at,barangays.name as brgy")
                ->get();
        $data['base_url'] = App::make("url")->to('/');

        return view('admin.users', $data);
    }

    public function saveContribution(Request $request)
    {
        if (!isset($request->id)) {
            $data = array(
                'senior_id' => $request->senior_id,
                'amount' => $request->amount
            );

            $res = Contribution::create($data);
        } else {
            $data = array(
                'senior_id' => $request->senior_id,
                'amount' => $request->amount
            );

            $res = Contribution::where('id', '=', $request->id)->update($data);
        }

        if ($res) {
            return redirect('/admin-senior-contributions')->with('message', 'success');
        } else {
            return redirect('/admin-senior-contributions')->with('message', 'error');
        }
    }

    public function savePension(Request $request)
    {
        if (!isset($request->id)) {
            $data = array(
                'senior_id' => $request->senior_id,
                'pension_amount' => $request->amount
            );

            $res = Pension::create($data);
        } else {
            $data = array(
                'senior_id' => $request->senior_id,
                'pension_amount' => $request->amount
            );

            $res = Pension::where('id', '=', $request->id)->update($data);
        }

        if ($res) {
            return redirect('/admin-senior-pension')->with('message', 'success');
        } else {
            return redirect('/admin-senior-pension')->with('message', 'error');
        }
    }

    public function getContributionData(Request $request)
    {
        $data = Contribution::where('id', $request->c_id)->get();

        if ($data) {
            return response()->json([
                'user'  => $data,
                'status' => 200
            ]);
        } else {
            return response()->json([
                'status' => 500
            ]);
        }
    }

    public function getPensionData(Request $request)
    {
        $data = Pension::where('id', $request->c_id)->get();

        if ($data) {
            return response()->json([
                'user'  => $data,
                'status' => 200
            ]);
        } else {
            return response()->json([
                'status' => 500
            ]);
        }
    }

    public function deleteContribution(Request $request)
    {
        $data = Contribution::where('id', $request->data)->update(['status' => 0]);

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

    public function deletePension(Request $request)
    {
        $data = Pension::where('id', $request->data)->update(['status' => 0]);

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

    public function getAddUser()
    {
        $data['title'] = "Add User";
        $data['civil_status'] = CivilStatus::all();
        $data['barangays'] = Barangay::all();
        $data['base_url'] = App::make("url")->to('/');

        return view('admin.add_user', $data);
    }

    public function saveUser(Request $request)
    {
        $this->validate($request, [
            'profile_photo' => 'image|mimes:jpeg,png,jpg|max:2048',
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

        if (!isset($request->id)) {

            $data = array(
                'name' => ucwords($request->name),
                'email' => $request->email,
                'password' => Hash::make('password')
            );

            $user_id = User::create($data);

            $data_cp = array(
                'user_id' => $user_id->id,
                'user_profile_pic' => !empty($name) ? $name : '',
                'user_birthdate' => date('Y-m-d', strtotime($request->birthdate)),
                'user_civil_status' => $request->civil_status,
                'user_gender' => $request->gender,
                'user_address' => ucwords($request->address),
                'user_street' => ucwords($request->street),
                'user_brgy' => ucwords($request->brgy),
                'user_mobile_num' => $request->mobile_num,
                'user_phone_num' => $request->phone_num,
            );

            $resultData = UserProfile::create($data_cp);
        } else {
            $data = array(
                'name' => ucwords($request->name),
                'email' => $request->email
            );

            $user_id = User::where('id', '=', $request->id)->update($data);

            $data_cp = array(
                'user_id' => $user_id->id,
                'user_profile_pic' => !empty($name) ? $name : '',
                'user_birthdate' => date('Y-m-d', strtotime($request->birthdate)),
                'user_civil_status' => $request->civil_status,
                'user_gender' => $request->gender,
                'user_address' => ucwords($request->address),
                'user_street' => ucwords($request->street),
                'user_brgy' => ucwords($request->brgy),
                'user_mobile_num' => $request->mobile_num,
                'user_phone_num' => $request->phone_num,
            );

            $resultData = UserProfile::where('id', '=', $request->up_id)->update($data_cp);
        }

        if ($resultData) {
            return redirect('/admin-users')->with('message', 'success');
        } else {
            return redirect('/admin-users')->with('message', 'error');
        }
    }
}
