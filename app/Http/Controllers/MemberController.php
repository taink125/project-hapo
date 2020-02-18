<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMemberPost;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $members = Member::search($request)
            ->searchRole($request)
            ->paginate(config('app.pagination'));
        return view('members.index', ['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberPost $request)
    {
        $data = $request->all();
        $imageName = uniqid() . '.' . request()->image->getClientOriginalExtension();
        request()->image->storeAs('public/images', $imageName);
        $imageName = 'storage/images/' . $imageName;
        $member = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone ' => $data['phone'],
            'image' => $imageName,
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
            'is_admin' => $data['is_admin']
        ];

        $member = Member::create($member);
        return redirect()->route('member.index')->with('success', __('messages.create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('members.edit')->with('members', Member::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMemberPost $request, $id)
    {
        $data = $request->all();
        $imageName = uniqid() . '.' . request()->image->getClientOriginalExtension();
        request()->image->storeAs('public/images', $imageName);
        $imageName = 'storage/images/' . $imageName;
        $member = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone ' => $data['phone'],
            'image' => $imageName,
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
            'is_admin' => $data['is_admin']
        ];
        $member = Member::findOrFail($id)->update($member);
        return redirect()->route('member.index')->with('success', __('messages.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return redirect()->route('member.index')->with('success', __('messages.destroy'));
    }
}
