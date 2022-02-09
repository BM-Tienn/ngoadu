<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Libraries\Ultilities;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getListUser($request)
    {
        $role = $request->role;
        $text = $request->filter_search;

        $data = $this->query();
        if ($role != ALL) {
            $data->where('role', $role);
        }
        if (!empty($text)) {
            $data->where(function ($q) use ($text) {
                $q->Where('name', 'like', '%' . $text . '%')
                ->orWhere('email', 'like', '%' . $text . '%');
            });
        }
        return $data->orderBy('id', 'desc')->get();
    }

    public function showInformation($id)
    {
        return $this->find($id);
    }

    public function changePassword($params, $id)
    {
        return $this->find($id)->update(['password' => $params['new_password']]);
    }

    public function storeData($request)
    {

        $params['role'] = $request->role;
        $password = Str::random(6);
        $params['name'] = Ultilities::clearXSS($request->name);
        $params['email'] = Ultilities::clearXSS($request->email);
        $params['password'] = Hash::make($password);
        $check = $this->where('email', $params['email'])->count();
        if ($check == 0) {
            Mail::send('auth.passwords.sendPasswordRandom', ['name'=> $request->name, 'email'=> $request->email, 'password' => $password], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });
            $this->create($params);
            return SUCCESS;
        } else {
            return FAILURE;
        }
    }

    public function updateData($request, $id)
    {
        $params['role'] = $request->role;
        $params['name'] = Ultilities::clearXSS($request->name);
        if ($params['role'] == 0 && Auth::user()->id == $id) {
            return FAILURE;
        } else {
            $this->find($id)->update(['name' => $params['name'], 'role' => $params['role']]);
            return SUCCESS;
        }
    }

    public function ruleChange($id)
    {
        return [
            'password' => ['required', 'string', 'min:6', 'max:32'],
            'new_password' => ['required', 'string', 'min:6', 'max:32'],
            'confirm_password' => ['required', 'string', 'min:6', 'max:32', 'same:new_password'],
        ];
    }

    public function deleteUser($id)
    {
        $user_id = Auth::user()->id;
        if ($user_id == $id) {
            return FAILURE;
        }
        $this->find($id)->delete();
        return SUCCESS;
    }

    public function changePasswordUser($request, $id)
    {
        $params = $request->only(['password', 'new_password']);
        $params['email'] = Auth::user()->email;
       
        if (Auth::attempt($params)) {
            $params['new_password'] = Hash::make($params['new_password']);
            $this->changePassword($params, $id);
            return redirect(url('logout'))->with(['alert-type' => 'success', 'message' => 'Update data successfull' ]);
        } else {
            return redirect()->back()->with(['alert-type' => 'error', 'message' => 'Change password fail' ]);
        }
    }

    public function getListUserByAjax($request)
    {
        $data = $this->getListUser($request);
        return DataTables::of($data)
        ->addIndexcolumn()
        ->editColumn('role', function ($data) {
            if ($data->role != MANAGE) {
                return 'Employee';
            } else {
                return 'Manage';
            }
        })
        ->addColumn('action', function ($data) {
            return '<a href="javascript:void(0);" data-href="'. route('user.edit', $data->id) .'" class="btn btn-sm btn-primary btn-user-update align-middle btn-edit"><i class="fas fa-edit"></i></a> <a data-id="' . $data->id . '" class="btn-danger align-middle btn btn-sm btn-delete"><i class=" fas fa-trash-alt" style="color:white"> </i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
