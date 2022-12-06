<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Validator, Redirect};
use Inertia\Inertia;
use Carbon\Carbon;

class SmartphoneController extends Controller
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
            $smartphones = DB::table("smartphones")
                ->select(
                    DB::raw("
                        smartphones.id as id, operating_systems.id as operating_system_id,
                        operating_systems.name as operating_system_name, brands.id as brand_id,
                        brands.name as brand_name, manufacturers.id as manufacturer_id, manufacturers.name as manufacturer_name, 
                        smartphones.type as type, smartphones.price as price, smartphones.stock as stock, 
                        smartphones.deleted_at as deleted_at
                   ")
                )
                ->where("smartphones.deleted_at", "=", null)
                ->join(
                    "operating_systems",
                    "operating_systems.id",
                    "=",
                    "smartphones.os_id"
                )
                ->join("brands", "brands.id", "=", "smartphones.brand_id")
                ->join(
                    "manufacturers",
                    "manufacturers.id",
                    "=",
                    "smartphones.manufacturer_id"
                )
                ->get();
        } else {
            $smartphones = DB::table("smartphones")
                ->select(
                    DB::raw("
                        smartphones.id as id, operating_systems.id as operating_system_id,
                        operating_systems.name as operating_system_name, brands.id as brand_id,
                        brands.name as brand_name, manufacturers.id as manufacturer_id, manufacturers.name as manufacturer_name, 
                        smartphones.type as type, smartphones.price as price, smartphones.stock as stock, 
                        smartphones.deleted_at as deleted_at
                   ")
                )
                ->where("smartphones.deleted_at", "=", null)
                ->where("smartphones.name", "like", "%$search%")
                ->join(
                    "operating_systems",
                    "operating_systems.id",
                    "=",
                    "smartphones.os_id"
                )
                ->join("brands", "brands.id", "=", "smartphones.brand_id")
                ->join(
                    "manufacturers",
                    "manufacturers.id",
                    "=",
                    "smartphones.manufacturer_id"
                )
                ->get();
        }
        return Inertia::render("Smartphones/Index", [
            "smartphones" => $smartphones,
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
        $trashedSmartphones = DB::table("smartphones")
            ->select(
                DB::raw("
                    smartphones.id as id, operating_systems.id as operating_system_id,
                    operating_systems.name as operating_system_name, brands.id as brand_id,
                    brands.name as brand_name, manufacturers.id as manufacturer_id, manufacturers.name as manufacturer_name, 
                    smartphones.type as type, smartphones.price as price, smartphones.stock as stock, 
                    smartphones.deleted_at as deleted_at
               ")
            )
            ->where("smartphones.deleted_at", "!=", null)
            ->join(
                "operating_systems",
                "operating_systems.id",
                "=",
                "smartphones.os_id"
            )
            ->join("brands", "brands.id", "=", "smartphones.brand_id")
            ->join(
                "manufacturers",
                "manufacturers.id",
                "=",
                "smartphones.manufacturer_id"
            )
            ->get();
        return Inertia::render("Smartphones/Trashed", [
            "trashed_smartphones" => $trashedSmartphones,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $operatingsystems = DB::table("operating_systems")
            ->select(DB::raw("id, name, deleted_at"))
            ->where("deleted_at", "=", null)
            ->get();
        $brands = DB::table("brands")
            ->select(DB::raw("id, name, deleted_at"))
            ->where("deleted_at", "=", null)
            ->get();
        $manufacturers = DB::table("manufacturers")
            ->select(DB::raw("id, name, deleted_at"))
            ->where("deleted_at", "=", null)
            ->get();
        return Inertia::render("Smartphones/Create", [
            "operatingsystems" => $operatingsystems,
            "brands" => $brands,
            "manufacturers" => $manufacturers,
        ]);
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
                "os" => ["required", "integer", "exists:operating_systems,id"],
                "brand" => ["required", "integer", "exists:brands,id"],
                "manufacturer" => [
                    "required",
                    "integer",
                    "exists:manufacturers,id",
                ],
                "type" => ["required", "string", "max:255"],
                "price" => ["required", "integer", "min:0"],
                "stock" => ["required", "integer", "min:0"],
            ],
            [],
            [
                "os" => "smartphone operating system",
                "brand" => "smartphone brand",
                "manufacturer" => "smartphone manufacturer",
                "type" => "smartphone type",
                "price" => "smartphone price",
                "stock" => "smartphone stock",
            ]
        );
        DB::table("smartphones")->insert([
            "os_id" => $request->os,
            "brand_id" => $request->brand,
            "manufacturer_id" => $request->manufacturer,
            "type" => $request->type,
            "price" => $request->price,
            "stock" => $request->stock,
        ]);
        return Redirect::route("smartphones.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operatingsystems = DB::table("operating_systems")
            ->select(DB::raw("id, name, deleted_at"))
            ->where("deleted_at", "=", null)
            ->get();
        $brands = DB::table("brands")
            ->select(DB::raw("id, name, deleted_at"))
            ->where("deleted_at", "=", null)
            ->get();
        $manufacturers = DB::table("manufacturers")
            ->select(DB::raw("id, name, deleted_at"))
            ->where("deleted_at", "=", null)
            ->get();
        $smartphones = DB::table("smartphones")
            ->select(
                DB::raw("
                smartphones.id as id, operating_systems.id as operating_system_id,
                    operating_systems.name as operating_system_name, brands.id as brand_id,
                    brands.name as brand_name, manufacturers.id as manufacturer_id, manufacturers.name as manufacturer_name, 
                    smartphones.type as type, smartphones.price as price, smartphones.stock as stock, 
                    smartphones.deleted_at as deleted_at
               ")
            )
            ->where("smartphones.id", "=", $id)
            ->where("smartphones.deleted_at", "=", null)
            ->join(
                "operating_systems",
                "operating_systems.id",
                "=",
                "smartphones.os_id"
            )
            ->join("brands", "brands.id", "=", "smartphones.brand_id")
            ->join(
                "manufacturers",
                "manufacturers.id",
                "=",
                "smartphones.manufacturer_id"
            )
            ->get();
        return Inertia::render("Smartphones/Edit", [
            "operatingsystems" => $operatingsystems,
            "brands" => $brands,
            "manufacturers" => $manufacturers,
            "smartphone" => $smartphones[0],
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
                "os" => ["required", "integer", "exists:operating_systems,id"],
                "brand" => ["required", "integer", "exists:brands,id"],
                "manufacturer" => [
                    "required",
                    "integer",
                    "exists:manufacturers,id",
                ],
                "type" => ["required", "string", "max:255"],
                "price" => ["required", "integer", "min:0"],
                "stock" => ["required", "integer", "min:0"],
            ],
            [],
            [
                "os" => "smartphone operating system",
                "brand" => "smartphone brand",
                "manufacturer" => "smartphone manufacturer",
                "type" => "smartphone type",
                "price" => "smartphone price",
                "stock" => "smartphone stock",
            ]
        );
        DB::table("smartphones")
            ->where("id", "=", $id)
            ->update([
                "os_id" => $request->os,
                "brand_id" => $request->brand,
                "manufacturer_id" => $request->manufacturer,
                "type" => $request->type,
                "price" => $request->price,
                "stock" => $request->stock,
                "updated_at" => Carbon::now(),
            ]);
        return Redirect::route("smartphones.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("smartphones")
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
        DB::table("smartphones")
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
        DB::table("smartphones")
            ->where("id", "=", $id)
            ->where("deleted_at", "!=", null)
            ->update([
                "deleted_at" => null,
            ]);
        return back();
    }
}
