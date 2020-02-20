<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMemberPost;
<<<<<<< HEAD

class MemberController extends Controller
{
=======
use App\Http\Requests\UpdateMember;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

>>>>>>> feature/login
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function index()
    {
        $members = Member::all();
        return view('members.index')->with('members', $members);
=======
    public function index(Request $request)
    {
        $members = Member::search($request)
            ->searchRole($request)
            ->paginate(config('app.pagination'));
        return view('members.index', ['members' => $members]);
>>>>>>> feature/login
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
<<<<<<< HEAD
        $member = new Member();
        $member = Member::create($request->all());

        return redirect()->route('member.index');
=======
        $data = $request->all();
        $imageName = uniqid() . '.' . request()->image->getClientOriginalExtension();
        request()->image->storeAs('public/images', $imageName);
        $data['image'] = $imageName;
        $data['password'] = Hash::make($data['password']);

        Member::create($data);
        return redirect()->route('member.index')->with('success', __('messages.create'));
>>>>>>> feature/login
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
<<<<<<< HEAD
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMemberPost $request, $id)
    {
        $member = Member::findOrFail($id);
        $member->update($request->all());

        return redirect()->route('member.index');
=======
     * @p{aram  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMember $request, $id)
    {
        $data = $request->all();    
        $image = $request->file('image');
        if ($image != '') {
            $imageName = uniqid() . '.' . request()->image->getClientOriginalExtension();
            request()->image->storeAs('public/images', $imageName);
            $data['image'] = $imageName;
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        Member::findOrFail($id)->update($data);
        return redirect()->route('member.index')->with('success', __('messages.update'));
>>>>>>> feature/login
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
<<<<<<< HEAD
        return redirect()->route('member.index');
=======
        return redirect()->route('member.index')->with('success', __('messages.destroy'));
>>>>>>> feature/login
    }
}
