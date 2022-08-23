<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supervisor;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function __invoke(Request $request): Collection
    {

        return Supervisor::query()
            ->orderBy('staffid')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('staffid', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(10)
            )
            ->with(['user' => function ($query) {
                $query->select('id', 'name', 'email');
            }])
            ->get()->map(function (Supervisor $supervisor) {
                $supervisor->profile_image = asset("assets/supervisor/" . $supervisor->picture);
                return $supervisor;
            });
    }
}