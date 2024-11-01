<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\HtmlString;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('status', function (User $user) {
                $status = '<div class="form-check form-switch mb-2">';
                $status .= '<input class="form-check-input change-status-input" type="checkbox" id="flexSwitchCheckChecked" data-student-id="' . $user->id . '" ' . ($user->status == 'active' ? 'checked' : '') . '>';
                $status .= '</div>';
                return new HtmlString($status);
            })
            ->addColumn('parent_info', function (User $user) {
                $status = '<div class="form-check form-switch mb-2">';
                $status .= '<p><strong>Father</strong> : ' . $user->father . '</p>';
                $status .= "<p><strong>Father's Phone</strong> : " . $user->father_phone . "</p>";
                $status .= "<hr>";
                $status .= '<span><strong>Mother</strong> : ' . $user->mother . '</span><br>';
                $status .= "<span><strong>Mother's Phone</strong> : " . $user->mother_phone . "</span>";
                $status .= '</div>';
                return new HtmlString($status);
            })
            ->addColumn('index', function ($row) {
                // This will add a sequential number column starting from 1
                return $row->serial_no;
            })
            ->addColumn('created_at', function (User $user) {
                $dates = 'Created: ' . $user->created_at->diffForHumans() . '<br><hr/>';
                $dates .= 'Updated: ' . $user->updated_at->diffForHumans();
                return new HtmlString($dates);
            })
            ->addColumn('action', function (User $user) {
                return '<a class="dropdown-item" href="' . route("admin.students.edit", $user) . '"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                        <a class="dropdown-item delete-plan" href="' . route("admin.students.destroy", $user) . '" onclick="return confirm(\'Are you sure?\')" data-id="' . $user->id . '"><i class="bx bx-trash me-1"></i> Delete</a>';
            })
            ->addColumn('image', function (User $user) {
                return '<img class="w-25 img-thumbnail imgRenderContainer" src="' . public_asset($user->image) . '" alt="' . $user->title . '">';
            })
            ->rawColumns(['image', 'status', 'created_at', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $user): QueryBuilder
    {
        return $user->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('home-page-carousel-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('
                <"row"<"col-md-6 d-flex justify-content-start"f><"col-sm-12 col-md-6 d-flex align-items-center justify-content-end"lB>>
                <"row"<"col-md-12 custom-table"tr>>
                <"row"<"col-md-6"i><"col-md-6"p>>
            ')
            ->orderBy(1, 'asc')
            ->language(["search" => "", "lengthMenu" => "_MENU_", "searchPlaceholder" => 'Search student'])
            ->buttons(
                Button::make()
                    ->className('btn btn-primary')
                    ->text('New <i class="bx bx-user-plus"></i>')
                    ->action(
                        'function(e, dt, node, config) {
                            let url = "' . route('admin.students.create') . '";
                            window.location.href = url;
                        }'
                    )
            )
            ->parameters([
                'paging' => true,
                'lengthMenu' => [
                    [5, 10, 25, 50, -1],
                    ['5', '10', '25', '50', 'Show all']
                ],
                'drawCallback' => 'function(settings) {
                    var api = this.api();
                    api.column(0).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }',
                'initComplete' => 'function () {
                    $(".change-status-input").change(function() {
                        var status = $(this).is(":checked") ? "1" : "0"; // Fixed quotes
                        var studentId = $(this).data("student-id");
                        var requestData = {
                            "status": status,
                            "id": studentId,
                            "_token": "' . csrf_token() . '",
                        };
                        $.ajax({
                            type: "POST",
                            url: "' . route('admin.students.change.status') . '",
                            data: requestData,
                            dataType: "json",
                            success: function(response) {
                                console.log(response);
                                if (response.status == "success") {
                                    toastr.success(response.message);
                                } else {
                                    toastr.error(response.message);
                                }
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                console.log(xhr);
                                console.log(xhr.responseText);
                                console.log(textStatus, errorThrown);
                                console.log(errorThrown);
                            },
                        });
                    });
                }',
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('index') // Add this column for serial numbers
                ->title('S.No') // Title for the column header
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('name'),
            Column::make('email'),
            Column::computed('parent_info'),
            Column::make('status'),
            // Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
