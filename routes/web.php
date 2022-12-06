<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SmartphoneController;
use App\Http\Controllers\OperatingSystemController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ManufacturerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    return Inertia::render("Welcome", [
        "canLogin" => Route::has("login"),
        "canRegister" => Route::has("register"),
        "laravelVersion" => Application::VERSION,
        "phpVersion" => PHP_VERSION,
    ]);
});

Route::middleware([
    "auth:sanctum",
    config("jetstream.auth_session"),
    "verified",
])->group(function () {
    // Smartphones Endpoints
    Route::group(
        [
            "prefix" => "smartphones",
            "as" => "smartphones.",
        ],
        function () {
            Route::get("/", [SmartphoneController::class, "index"])->name(
                "index"
            );
            Route::get("trashed", [
                SmartphoneController::class,
                "trashed",
            ])->name("trashed");
            Route::get("create", [SmartphoneController::class, "create"])->name(
                "create"
            );
            Route::post("store", [SmartphoneController::class, "store"])->name(
                "store"
            );
            Route::get("{id}/edit", [
                SmartphoneController::class,
                "edit",
            ])->name("edit");
            Route::put("{id}/update", [
                SmartphoneController::class,
                "update",
            ])->name("update");
            Route::get("{id}/destroy", [
                SmartphoneController::class,
                "destroy",
            ])->name("destroy");
            Route::get("{id}/destroy-permanent", [
                SmartphoneController::class,
                "destroy_permanent",
            ])->name("destroy_permanent");
            Route::get("{id}/restore", [
                SmartphoneController::class,
                "restore",
            ])->name("restore");
        }
    );

    // Operating Systems Endpoints
    Route::group(
        [
            "prefix" => "operatingsystems",
            "as" => "operatingsystems.",
        ],
        function () {
            Route::get("/", [OperatingSystemController::class, "index"])->name(
                "index"
            );
            Route::get("trashed", [
                OperatingSystemController::class,
                "trashed",
            ])->name("trashed");
            Route::get("create", [
                OperatingSystemController::class,
                "create",
            ])->name("create");
            Route::post("store", [
                OperatingSystemController::class,
                "store",
            ])->name("store");
            Route::get("{id}/edit", [
                OperatingSystemController::class,
                "edit",
            ])->name("edit");
            Route::put("{id}/update", [
                OperatingSystemController::class,
                "update",
            ])->name("update");
            Route::get("{id}/destroy", [
                OperatingSystemController::class,
                "destroy",
            ])->name("destroy");
            Route::get("{id}/destroy-permanent", [
                OperatingSystemController::class,
                "destroy_permanent",
            ])->name("destroy_permanent");
            Route::get("{id}/restore", [
                OperatingSystemController::class,
                "restore",
            ])->name("restore");
        }
    );

    // Manufacturers Endpoints
    Route::group(
        [
            "prefix" => "manufacturers",
            "as" => "manufacturers.",
        ],
        function () {
            Route::get("/", [ManufacturerController::class, "index"])->name(
                "index"
            );
            Route::get("/", [ManufacturerController::class, "index"])->name(
                "index"
            );
            Route::get("trashed", [
                ManufacturerController::class,
                "trashed",
            ])->name("trashed");
            Route::get("create", [
                ManufacturerController::class,
                "create",
            ])->name("create");
            Route::post("store", [
                ManufacturerController::class,
                "store",
            ])->name("store");
            Route::get("{id}/edit", [
                ManufacturerController::class,
                "edit",
            ])->name("edit");
            Route::put("{id}/update", [
                ManufacturerController::class,
                "update",
            ])->name("update");
            Route::get("{id}/destroy", [
                ManufacturerController::class,
                "destroy",
            ])->name("destroy");
            Route::get("{id}/destroy-permanent", [
                ManufacturerController::class,
                "destroy_permanent",
            ])->name("destroy_permanent");
            Route::get("{id}/restore", [
                ManufacturerController::class,
                "restore",
            ])->name("restore");
        }
    );

    // Brands Endpoints
    Route::group(
        [
            "prefix" => "brands",
            "as" => "brands.",
        ],
        function () {
            Route::get("/", [BrandController::class, "index"])->name("index");
            Route::get("/", [BrandController::class, "index"])->name("index");
            Route::get("trashed", [BrandController::class, "trashed"])->name(
                "trashed"
            );
            Route::get("create", [BrandController::class, "create"])->name(
                "create"
            );
            Route::post("store", [BrandController::class, "store"])->name(
                "store"
            );
            Route::get("{id}/edit", [BrandController::class, "edit"])->name(
                "edit"
            );
            Route::put("{id}/update", [BrandController::class, "update"])->name(
                "update"
            );
            Route::get("{id}/destroy", [
                BrandController::class,
                "destroy",
            ])->name("destroy");
            Route::get("{id}/destroy-permanent", [
                BrandController::class,
                "destroy_permanent",
            ])->name("destroy_permanent");
            Route::get("{id}/restore", [
                BrandController::class,
                "restore",
            ])->name("restore");
        }
    );
});
