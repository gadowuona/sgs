<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supervisor;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function __invoke(Request $request)
    {

        return Supervisor::query()
            ->select('id', 'user_id', 'staffid', 'picture')
            ->with(['user:id,name,email']) // ✅ Eager load only needed fields
            ->orderBy('staffid')
            ->when(
                $request->search,
                fn(Builder $query) => $query
                    ->where('staffid', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn(Builder $query) => $query->limit(10)
            )
            ->get()
            ->map(function (Supervisor $supervisor) {
                return [
                    'id' => $supervisor->id,
                    'staffid' => $supervisor->staffid,
                    'picture' => asset("assets/supervisor/" . $supervisor->picture),
                    'name' => optional($supervisor->user)->name,
                    'email' => optional($supervisor->user)->email,
                ];
            });
    }
}