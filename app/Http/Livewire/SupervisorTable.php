<?php

namespace App\Http\Livewire;

use App\Models\Supervisor;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class SupervisorTable extends PowerGridComponent
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
     * @return Builder<\App\Models\Supervisor>
     */
    public function datasource(): Builder
    {
        return Supervisor::query()->with('user')->orderBy('created_at','DESC');
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
        return [];
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
            ->addColumn('staffid')
            ->addColumn('picture', function (Supervisor $model) {
                $path = asset("assets/supervisor/" . $model->picture);
                return '<img class="m-1" src="' . $path . '" />';
            })
            ->addColumn('title')
            ->addColumn('user.name')
            ->addColumn('user.email')
            ->addColumn('phone1')
            ->addColumn('nid')
            // ->addColumn('address')
            ->addColumn('collage')
            ->addColumn('fns')
            ->addColumn('faculty_school')
            ->addColumn('department')
            ->addColumn('qualification')
            ->addColumn('super_status')
            ->addColumn('created_at_formatted', fn (Supervisor $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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

            Column::make('STAFFID', 'staffid')
                ->makeInputRange(),

            Column::make('PICTURE', 'picture'),

            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),

            Column::make('NAME', 'user.name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('EMAIl', 'user.email')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('CONTACT NO.', 'phone1')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('NID', 'nid')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            // Column::make('ADDRESS', 'address')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),

            Column::make('COLLAGE', 'collage')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('Faculty/School', 'fns')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('FACULTY/SCHOOL', 'faculty_school')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('DEPARTMENT', 'department')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('QUALIFICATION', 'qualification')
                ->sortable()
                ->searchable()
                ->makeInputText(),

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
     * PowerGrid Supervisor Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('bg-indigo-500 cursor-pointer m-1 inline-flex items-center px-3 py-1 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-400 active:bg-indigo-600 focus:outline-none focus:border-indigo-600 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150')
                ->route('supervisors.edit', ['supervisor' => 'id']),

            Button::make('destroy', 'Delete')
                ->class('bg-red-500 cursor-pointer m-1 inline-flex items-center px-3 py-1 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-400 active:bg-red-600 focus:outline-none focus:border-red-600 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150')
                ->route('supervisors.destroy', ['supervisor' => 'id'])
                ->method('delete')
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Supervisor Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($supervisor) => $supervisor->id === 1)
                ->hide(),
        ];
    }
    */
}