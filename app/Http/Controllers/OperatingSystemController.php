<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Validator, Redirect};
use Inertia\Inertia;
use Carbon\Carbon;

class OperatingSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query("search");
        if (empty($search)) {
            $operatingsystems = DB::table("operating_systems")
                ->select(DB::raw("id, name, deleted_at"))
                ->where("operating_systems.deleted_at", "=", null)
                ->get();
        } else {
            $operatingsystems = DB::table("operating_systems")
                ->select(DB::raw("id, name, deleted_at"))
                ->where("operating_systems.deleted_at", "=", null)
                ->where("operating_systems.name", "like", "%$search%")
                ->get();
        }
        return Inertia::render("OperatingSystems/Index", [
            "operatingsystems" => $operatingsystems,
        ]);
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $trashedOperatingSystems = DB::table("operating_systems")
            ->select(DB::raw("id, name, deleted_at"))
            ->where("operating_systems.deleted_at", "!=", null)
            ->get();
        return Inertia::render("OperatingSystems/Trashed", [
            "trashed_operatingsystems" => $trashedOperatingSystems,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("OperatingSystems/Create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::validate(
            $request->all(),
            [
                "name" => ["required", "string", "max:255"],
            ],
            [],
            [
                "name" => "operating system name",
            ]
        );
        DB::table("operating_systems")->insert([
            "name" => $request->name,
        ]);
        return Redirect::route("operatingsystems.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operatingsystem = DB::table("operating_systems")
            ->where("id", "=", $id)
            ->get();
        return Inertia::render("OperatingSystems/Edit", [
            "operatingsystem" => $operatingsystem[0],
        ]);
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
        Validator::validate(
            $request->all(),
            [
                "name" => ["required", "string", "max:255"],
            ],
            [],
            [
                "name" => "cake type name",
            ]
        );
        DB::table("operating_systems")
            ->where("id", "=", $id)
            ->update([
                "name" => $request->name,
                "updated_at" => Carbon::now(),
            ]);
        return Redirect::route("operatingsystems.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("operating_systems")
            ->where("id", "=", $id)
            ->update([
                "deleted_at" => Carbon::now(),
            ]);
        return back();
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_permanent($id)
    {
        DB::table("operating_systems")
            ->where("id", "=", $id)
            ->delete();
        return back();
    }

    /**
     * Restore the specified trashed resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        DB::table("operating_systems")
            ->where("id", "=", $id)
            ->where("deleted_at", "!=", null)
            ->update([
                "deleted_at" => null,
            ]);
        return back();
    }
}
