<?php

namespace App\Http\Livewire;

use App\Models\Thesis;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};


final class ThesisTable extends PowerGridComponent
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
     * @return Builder<\App\Models\Thesis>
     */
    public function datasource(): Builder
    {
        return Thesis::query()->with('student');
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
            'student' => [
                'full_name', // column enabled to search
            ],
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
            ->addColumn('title')
            ->addColumn('student.full_name')
            ->addColumn('submission_date_formatted', fn (Thesis $model) => Carbon::parse($model->submission_date)->format('d/m/Y'))
            ->addColumn('due_date_formatted', fn (Thesis $model) => Carbon::parse($model->due_date)->format('d/m/Y'))
            ->addColumn('complete_status')
            ->addColumn('payment_status')
            ->addColumn('created_at_formatted', fn (Thesis $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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

            Column::make('TITLE', 'title')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('SUBMISSION DATE', 'submission_date_formatted', 'submission_date')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('DUE DATE', 'due_date_formatted', 'due_date')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('STUDENT NAME', 'student.full_name')
                ->searchable()
                ->sortable(),

            Column::make('COMPLETED STATUS', 'complete_status')
                ->sortable()
                ->searchable(),
            // ->makeInputText(),

            Column::make('PAYMENT STATUS', 'payment_status')
                ->sortable()
                ->searchable(),
            // ->makeInputSelect(Thesis::all(), 'payment_status'),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

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
     * PowerGrid Thesis Action Buttons.
     *
     * @return array<int, Button>
     */
    /*


    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('thesis.edit', ['thesis' => 'id']),

            Button::make('destroy', 'Delete')
                ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                ->route('thesis.destroy', ['thesis' => 'id'])
                ->method('delete')
        ];
    }*/


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Thesis Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($thesis) => $thesis->id === 1)
                ->hide(),
        ];
    }
    */
}