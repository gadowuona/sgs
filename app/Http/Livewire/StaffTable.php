<?php

namespace App\Http\Livewire;

use App\Models\SupervisorThesis;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class StaffTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\SupervisorThesis>
     */
    public function datasource(): Builder
    {
        $supervisor_id = null;
        if (Auth::user()->supervisor) {
            $supervisor_id = Auth::user()->supervisor->id;
        }
        return SupervisorThesis::query()->where('supervisor_id', $supervisor_id)->with('thesis');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            'thesis' => [
                'title', 'submission_date', 'complete_status', 'payment_status',
                'student' => [
                    'full_name'
                ]
            ]
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('thesis.title', function (SupervisorThesis $model) {
                $title = Str::words($model->thesis->title, 8);
                $url = route('staff.thesis.show', ['thesi' => $model->thesis->id]);
                return '<a class="m-1 !text-indigo-400 underline decoration-dashed" href="' . $url . '" styel="color:#818cf8;"/>' . $title . '</a>';
            })
            ->addColumn('thesis.submission_date')
            ->addColumn('thesis.complete_status')
            ->addColumn('thesis.payment_status')
            ->addColumn('thesis.student.full_name')
            ->addColumn('updated_at_formatted', fn (SupervisorThesis $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('Title', 'thesis.title')
                ->searchable()
                ->sortable(),

            Column::make('SUBMISSION DATE', 'thesis.submission_date')
                ->searchable()
                ->sortable(),

            Column::make('COMPLETE STATUS', 'thesis.complete_status')
                ->searchable()
                ->sortable(),

            Column::make('PAYMENT STATUS', 'thesis.payment_status')
                ->searchable()
                ->sortable(),

            Column::make('STUDENT NAME', 'thesis.student.full_name')
                ->searchable()
                ->sortable(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
                ->searchable()
                ->sortable(),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid SupervisorThesis Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('supervisor-thesis.edit', ['supervisor-thesis' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('supervisor-thesis.destroy', ['supervisor-thesis' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid SupervisorThesis Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($supervisor-thesis) => $supervisor-thesis->id === 1)
                ->hide(),
        ];
    }
    */
}