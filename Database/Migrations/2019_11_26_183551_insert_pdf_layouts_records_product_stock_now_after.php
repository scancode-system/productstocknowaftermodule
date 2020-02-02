<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Pdf\Repositories\PdfLayoutRepository;

class InsertPdfLayoutsRecordsProductStockNowAfter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        PdfLayoutRepository::create(['title' => 'Estoque Atual e Futuro', 'description' => 'Agrupamento dos items do pedido por estoque atual e estoque futuro.', 'path' => 'productstocknowafter::pdf.order']);

        PdfLayoutRepository::create(['title' => 'Agrupamento - Data', 'description' => 'Agrupamento dos items do pedido por datas.', 'path' => 'productstocknowafter::pdf.data.order']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       PdfLayoutRepository::deleteByTitle('Estoque Atual e Futuro');
       PdfLayoutRepository::deleteByTitle('Agrupamento - Data');
   }
}
 