<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at', function ($user) {

                return $user->created_at->format('d/m/Y');
            })
            ->addColumn('action', function ($user) {

                $acoes = link_to(
                            route('admin.user.edit', $user),
                            'Editar',
                            ['class' => 'btn btn-sm btn-primary']
                        );

                $acoes .= FormFacade::button(
                            'Excluir',
                            ['class' =>
                                'btn btn-sm btn-danger ml-1',
                                'onclick' => "excluir('" . route('admin.user.destroy', $user) . "')"
                            ]
                        );

                return $acoes;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->select('id', 'name', 'email', 'created_at');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')->text('Novo Usuário'),
                        Button::make('export')->text('Exportar'),
                        Button::make('print')->text('Imprimir')
                    )
                    ->parameters([
                        'language' => ['url' => '//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json']
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false),
            Column::make('id'),
            Column::make('name')->title('Nome'),
            Column::make('email')->title('E-mail'),
            Column::make('created_at')->title('Data de Criação'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
