<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\ProcessResource;
use App\Http\Resources\ListUserResource;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id')->get();

        return new ListUserResource($users);
    }

    public function process(Request $request)
    {
        $results=[];
        foreach ($request->all() as $key => $value) {
            $results[]= DB::table('users')
            ->leftJoin('skills', 'skills.user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.position', 'skills.skill','skills.value')
                ->where('users.position','=', $value['position'])
                ->where('skills.skill','=', $value['mainSkill'])
                ->get();
        }

        return new ProcessResource($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'position' => $request->position
        ]);

        $user->skills()->createMany($request['playerSkills']);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $find = User::find($id);
        $find->update([
            'name' => $request->name,
            'position' => $request->position
        ]);

        $find->skills()->delete();
        $find->skills()->createMany($request['playerSkills']);

        return new UserResource($find);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $player = User::find($id);
        $player->delete();

        return response($this->index());
    }
}
