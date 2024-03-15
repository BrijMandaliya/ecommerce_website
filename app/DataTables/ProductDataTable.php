<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class ProductDataTable extends DataTable
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
            ->addColumn('category_name',function($model){
                return $model->category->name;
            })
            ->addColumn('action', function ($raw) {
                return '<div class="dropdown">
                        <a type="button" style="font-size:15px;margin:10px;" id="threeDotMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            &#8942;
                        </a>
                        <div class="dropdown-menu h-auto action-option" aria-labelledby="threeDotMenu ">
                            <a class="dropdown-item editbtn" href="/edit_product/' . $raw->id . '" id="editbtn" value="' . $raw->id . '" data-id="' . $raw->id . '">Edit</a>
                            <a class="dropdown-item deletebtn" id="deletebtn" value="' . $raw->id . '" data-id="' . $raw->id . '">Delete</a>
                            <a class="dropdown-item infobtn " id="infobtn" value="' . $raw->id . '" data-id="' . $raw->id . '">Info</a>
                            <a class="dropdown-item variantbtn " id="variantbtn" value="' . $raw->id . '" data-id="' . $raw->id . '">Variant Details</a>
                        </div>
                    </div>';
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->with('category')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                ->setTableId('product-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->dom("Bfrtlip")
                ->orderBy(1)
                ->selectStyleSingle()
                ->buttons([
                    Button::make('excel'),
                    Button::make('csv'),
                    Button::make('pdf'),
                    Button::make('print'),
                    Button::make('reset'),
                    Button::make('reload')
                ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            'action',
            Column::make('name'),
            Column::make('shortDescription'),
            Column::make('Description'),
            Column::make('price'),
            Column::make('category_name'),
            Column::make('p_image_1'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
