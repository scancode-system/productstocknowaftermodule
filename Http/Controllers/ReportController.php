<?php

namespace Modules\ProductStockNowAfter\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Maatwebsite\Excel\Facades\Excel;
use Modules\ProductStockNowAfter\Exports\ReportProductStockNowAfter;
use Modules\ProductStockNowAfter\Exports\ItemsExport;


class ReportController extends Controller
{

    public function report()
    {
        return Excel::download(new ReportProductStockNowAfter, 'Relatório de Produtos.xlsx');
    }

    public function reportItems()
    {
        return Excel::download(new ItemsExport, 'Relatório de Items - Atual e Futuro.xlsx');
    }

} 