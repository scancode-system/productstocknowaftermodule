<?php 
namespace Modules\ProductStockNowAfter\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Modules\Product\Repositories\ProductRepository;
use Modules\Order\Repositories\ItemRepository;
use Modules\ProductStockNowAfter\Entities\Item;

class ReportProductStockNowAfter implements FromCollection, WithStrictNullComparison
{
    public function collection()
    {
        return new Collection($this->data());
    }


    private function data(){
        return array_merge($this->header(), $this->body());
    }

    private function header(){
        return [['Referência', 'Descrição', 'Categoria', 'Preço', 'Unidades Atual Disponibilizada', 'Unidades Vendidas Atual', 'Unidades Atual Restantes', 'Data Entrega Atual', 'Total Bruto Atual', 'Total de Descontos Atual', 'Total de Acréscimos Atual', 'Total Final Atual', 'Unidades Futura Disponibilizada', 'Unidades Vendidas Futuro', 'Unidades Futuras Restantes', 'Data Entrega Futura', 'Total Bruto Futuro', 'Total de Descontos Futuro', 'Total de Acréscimos Futuro', 'Total Final Futuro',  'Unidades Vendidas', 'Total Bruto', 'Total de Descontos', 'Total de Acréscimos', 'Total Final']];
    }


    private function body(){
        $products = ProductRepository::loadAll();
        $body = [];

        foreach ($products as $product) {
            $row = (object) [
                'referencia' => $product->sku,
                'descricao' => $product->description,
                'categoria' => $product->category,
                'preco' => $product->price,
                'available_now' => $product->product_stock_now_after->available_now,
                'qty_sold_now' => 0,
                'qty_left_now' => $product->product_stock_now_after->left_now,
                'date_delivery_now' => $product->product_stock_now_after->date_delivery_now,
                'total_gross_now' => 0,
                'total_discount_value_now' => 0,
                'total_addition_value_now' => 0,
                'total_now' => 0,
                'available_after' => $product->product_stock_now_after->available_after,
                'qty_sold_after' => 0,
                'qty_left_after' => $product->product_stock_now_after->left_after,
                'date_delivery_after' => $product->product_stock_now_after->date_delivery_after,
                'total_gross_after' => 0,
                'total_discount_value_after' => 0,
                'total_addition_value_after' => 0,
                'total_after' => 0,
                'quantidade' => 0,
                'total_bruto' => 0,
                'desconto_valor' => 0,
                'acrescimo_valor' => 0,
                'total' => 0,
            ];

            $items = ItemRepository::loadSoldItemsByProduct($product);

            foreach ($items as $item) {
                $item = new Item($item->toArray());

                $row->qty_sold_now += $item->item_product_stock_now_after->qty_now;
                $row->qty_sold_after += $item->item_product_stock_now_after->qty_after;

                $row->total_gross_now += $item->total_gross_now;
                $row->total_gross_after += $item->total_gross_after;

                $row->total_discount_value_now += round($item->total_discount_value_now, 2);
                $row->total_discount_value_after += round($item->total_discount_value_after, 2);

                $row->total_addition_value_now += round($item->total_addition_value_now, 2);
                $row->total_addition_value_after += round($item->total_addition_value_after, 2);

                $row->total_now += round($item->total_now, 2);
                $row->total_after += round($item->total_after, 2);

                $row->quantidade += $item->qty;
                $row->total_bruto += $item->total_gross;
                $row->desconto_valor += $item->total_discount_value;
                $row->acrescimo_valor += $item->total_addition_value;
                $row->total += $item->total;
            }

            array_push($body, $row);
        }

        return (new Collection($body))->sortByDesc('total')->toArray();

    }

}