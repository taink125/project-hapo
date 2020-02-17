<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMemberPost;
use Move;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $members = Member::Where(function($query) use ($request) 
        {
            if (!empty($request->keySearch)) {
                $query->where('name', 'like', '%' . $request->keySearch . '%')  
                ->orWhere('email', 'like', '%' . $request->keySearch . '%')
                ->orWhere('phone', 'like', '%' . $request->keySearch . '%')
                ->orWhere('id', 'like', '%' . $request->keySearch . '%');      
            }
        })->paginate(config('app.pagination'));
        return view('members.index', ['members' => $members]);

        $members = Member::paginate(config('app.pagination'));
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
        $member = new Member();
        $imageName = uniqid() . '.' . request()->image->getClientOriginalName();
        $path = request()->image->storeAs('/public/uploads', $imageName);
        $member = Member::create($request->all());

        return redirect()->route('member.index');
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
        $member = Member::findOrFail($id);
        $member->update($request->all());

        return redirect()->route('member.index');
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
