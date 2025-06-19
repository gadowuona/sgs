<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __invoke(Request $request): Collection
    {
        return Student::query()
            ->select('id', 'full_name', 'email', 'index_number')
            ->orderBy('index_number')
            ->when(
                $request->filled('search'),
                function (Builder $query) use ($request) {
                    $search = $request->input('search');
                    $query->where(function ($q) use ($search) {
                        $q->where('index_number', 'like', "%{$search}%")
                            ->orWhere('full_name', 'like', "%{$search}%");
                    });
                }
            )
            ->when(
                $request->filled('selected'),
                function (Builder $query) use ($request) {
                    $query->whereIn('id', $request->input('selected', []));
                },
                function (Builder $query) {
                    $query->limit(10);
                }
            )
            ->get();
    }
}