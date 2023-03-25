<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function auth(UserLoginRequest $request)
    {
        if(Auth::attempt($request->only('email', 'password')))
        {
            $request->session()->regenerate();
            return redirect()->route('user.index');
        }
        else
        {
            return redirect()->back()->with('error','Email or password invalid');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.login');
    }

    public function index(Request $request)
    {
        //$search = $request->search;
        //$users = $this->model->where('name', 'LIKE', "%{$request->search}%")->get();
        $users = $this->model->where('email', 'LIKE', "%{$request->search}%")->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    } 

    public function store(UserFormRequest $request)
    {
        $this->model->store($request->all());

        return redirect()->route('user.index');
    }

    public function edit($email)
    {
        if(!$user = $this->model->where('email', $email)->first())
        {
            return redirect()->route('user.index');
        }
        return view('user.edit', compact('user'));
    }

    public function update(UserFormRequest $request, $email)
    {
        if(!$user = $this->model->where('email', $email)->first())
        {
            return redirect()->route('user.index');
        }

        $data = $request->only('type', 'unity_code');
        if($request->password)
        {
            $data['password'] = bcrypt($request->password);
        }

        // try #as the email is a primary key, i have to do this try
        // {
            $user->update($data);
        // } catch (\Illuminate\Database\QueryException $e) 
        // {
        //     if($e->getCode() == '23000') 
        //     {
        //         return redirect()->back()->withErrors(['Error 1' => 'Email already exists in the DB'])->withInput();
        //     }
        // }
        
        return redirect()->route('user.index');
    }

    public function destroy($email)
    {
        if(!$user = $this->model->find($email))
        {
            return redirect()->route('user.index');
        }
        
        $user->delete();

        return redirect()->route('user.index');
    }
}
