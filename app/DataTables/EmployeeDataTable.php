<?php

namespace App\DataTables;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;

class EmployeeDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Employee $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model)
    {
        return $model->newQuery()
            ->join('inventory', 'inventory.inventory_id', '=', 'employees.inventory_id')
            ->join('roles', 'roles.role_id', '=', 'employees.role_id')
            ->select(['employees.employee_id','employees.first_name','employees.last_name','employees.number','employees.email','employees.birth_date','employees.create_date','employees.update_date', 'inventory.inventory_name', 'roles.role_name']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    // public function html(): HtmlBuilder
    // {
    //     return $this->builder()
    //         ->setTableId('table')
    //         ->minifiedAjax();
    //         //->dom('Bfrtip')
            
    // }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    // public function getColumns(): array
    // {
    //     return [
    //         // Column::computed('action')
    //         //       ->exportable(false)
    //         //       ->printable(false)
    //         //       ->width(60)
    //         //       ->addClass('text-center'),
    //         Column::make('employee_id'),
    //         Column::make('first_ma,e'),
    //         Column::make('last_name'),
    //         // Column::make('add your columns'),
    //         // Column::make('created_at'),
    //         // Column::make('updated_at'),
    //     ];

    // }
    public function getCustomParameters()
    {
        return [
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Employee_' . date('YmdHis');
    }
}
