<?php
namespace App\ExcelImports;

use App\Model\Admin\Category;
use App\Model\Admin\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductImport implements ToCollection, WithStartRow, WithMultipleSheets
{
    private $import_rows = 0;
    private $skip_rows = 0;
    private $invalid_rows = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row)
        {
            $errors = [];
            if (empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[4]) || empty($row[5]) || empty($row[6]) || empty($row[9])) {
                $this->skip_rows++;
                continue;
            }
            $name = trim($row[0]);
            $cate_name = trim($row[1]);
            $cpu = trim($row[2]);
            $ram = trim($row[3]);
            $storage = trim($row[4]);
            $band_width = trim($row[5]);
            $stream = trim($row[6]);
            $location = trim($row[7]);
            $os = trim($row[8]);
            $price = trim($row[9]);
            $base_price = trim($row[10]);

            $category = Category::where('name', $cate_name)->first();
            if(!$category) {
                $errors[] = 'Danh mục không tồn tại';
            }
            if(count($errors)) {
                $this->invalid_rows[] = [
                    'detail' => implode("\n", $errors),
                    'row' => $row,
                    'index' => $index + 2,
                ];
                $this->skip_rows++;
                continue;
            }
            $product = Product::where('name', $name)->where('cate_id', $category->id)->first();
            if($product) {
                $errors[] = 'VPS đã tồn tại';
            }
            if(count($errors)) {
                $this->invalid_rows[] = [
                    'detail' => implode("\n", $errors),
                    'row' => $row,
                    'index' => $index + 2,
                ];
                $this->skip_rows++;
                continue;
            }
            $product = new Product();
            $product->name = $name;
            $product->cate_id = $category->id;
            $product->cpu = $cpu;
            $product->ram = $ram;
            $product->storage = $storage;
            $product->band_width = $band_width;
            $product->stream = $stream;
            $product->origin = $location;
            $product->os = $os;
            $product->price = !empty($price) ? $price : null;
            $product->base_price = !empty($base_price) ? $base_price : null;
            $product->type = 0;
            $product->status = 1;
            $product->state = 1;
            $product->save();
            $this->import_rows++;
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function sheets(): array
    {
        return [
            2 => new ProductCategoryImport(),
            1 => new ProductTypeImport(),
            0 => $this,
        ];
    }

    public function getImportCount(): int
    {
        return $this->import_rows;
    }

    public function getSkipCount(): int
    {
        return $this->skip_rows;
    }

    public function getInvalidRow()
    {
        return $this->invalid_rows;
    }
}
