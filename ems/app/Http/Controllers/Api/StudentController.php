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
            ->select('id', 'first_name', 'middle_name', 'last_name', 'email', 'index_number')
            ->orderBy('index_number')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('index_number', 'like', "%{$request->search}%")
                    ->orWhere('first_name', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(10)
            )
            ->get()
            ->map(function (Student $student) {
                $name = $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name;
                $student->name = $name;
                return $student;
            });
    }
}