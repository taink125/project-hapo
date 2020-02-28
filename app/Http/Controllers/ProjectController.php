<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Member;
use App\Models\Customer;
use App\Models\Status;
use App\Http\Requests\StoreProjectPost;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::search($request)
            ->paginate(config('app.pagination'));
        $members = Project::with('member_project')->get();

        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'customers' => Customer::all(),
            'statuses' => Status::all(),
            'members' => Member::all()
        ];

        return view('projects.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectPost $request)
    {
        $data = $request->all();
        $project = Project::create($data);
        $members = $request->member_id;
        foreach ((array) $members as $member) {
            $project->members()->attach($member);
        }

        return redirect()->route('project.index')->with('success', __('messages.create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'customers' => Customer::all(),
            'statuses' => Status::all(),
            'members' => Member::all()
        ];
        return view('projects.edit', $data)->with('projects', Project::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProjectPost $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        $members[] = $request->member_id;
        if ($members != '') {
            foreach ((array) $members as $member) {
                $project->members()->sync($member);
            }
        }
        

        return redirect()->route('project.index')->with('success', __('messages.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('project.index')->with('success', __('messages.destroy'));
    }
}
