<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Modules\Dashboard\Repositories\ReportRepository;

class InsertReportsRecordsModuleProductStockNowAfter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ReportRepository::newByCategory(['module' => 'ProductStockNowAfter', 'export' => 'ItemsExport', 'alias' => 'Items - Atual e Futuro'], 'Items');
        ReportRepository::newByCategory(['module' => 'ProductStockNowAfter', 'export' => 'ReportProductStockNowAfter', 'alias' => 'Produtos - Atual e Futuro'], 'Produtos');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        ReportRepository::deleteByAlias('Items - Atual e Futuro');
        ReportRepository::deleteByAlias('Produtos - Atual e Futuro');
    }
    
}
