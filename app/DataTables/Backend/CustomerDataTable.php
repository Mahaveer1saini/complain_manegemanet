<?php

namespace App\DataTables\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('id', function () {
                // Your code for generating ID column
            })
            ->addColumn('name', function ($user) {
                return $user->name;
            })
            ->addColumn('user_name', function ($user) {
                return $user->user->name;
            })
            ->addColumn('phone', function ($user) {
                return $user->user->phone;
            })
            ->addColumn('email', function ($user) {
                return $user->user->email;
            })
            ->addColumn('address', function ($user) {
                return $user->address;
            })
            // Add other columns as necessary
            ->addColumn('action', function ($user) {
                // Your code for action column
            })
            ->setRowId('id');
    }

    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->with('user')->where('role_id', 7);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('customer-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<"row"<"col-md-4"f><"col-md-8 text-right"B>><"row"<"col-md-12"<"table-responsive"rt>>><"row"<"col-md-3"i><"col-md-2"l><"col-md-7"p>>')
            ->orderBy(1)
            ->selectStyleSingle()
            ->responsive(true)
            ->addTableClass('table table-bordered table-striped datatable-ajex')
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('print'),
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width(60),
            Column::make('name')->title('Name')->width(60),
            Column::make('user_name')->title('User Name')->width(100),
            Column::make('phone')->title('Phone')->width(100),
            Column::make('email')->title('Email')->width(100),
            Column::make('address')->title('Address')->width(100),
            // Add other columns as necessary
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Customer_' . date('YmdHis');
    }
}
