<?php
namespace App\ExcelImports;

use App\Model\Admin\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductTypeImport implements ToCollection, WithStartRow
{
    private $import_rows = 0;
    private $skip_rows = 0;
    private $invalid_rows = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row)
        {
            $errors = [];
            if (empty($row[1]) || empty($row[2])) {
                $this->skip_rows++;
                continue;
            }
            $parent_name = trim($row[1]);
            $name = trim($row[2]);
            $parent_category = Category::where('name', $parent_name)->where('parent_id', 0)->where('level', 0)->first();
            if(!$parent_category) {
                $this->skip_rows++;
                continue;
            }
            $category = Category::where('name', $name)->where('parent_id', $parent_category->id)->where('level', 1)->first();
            if($category) {
                $this->skip_rows++;
                continue;
            }

            $category = new Category();
            $category->name = $name;
            $category->parent_id = $parent_category->id;
            $category->level = 1;
            $category->sort_order = 0;
            $category->type = 1;
            $category->show_home_page = 1;
            $category->created_by = 1;
            $category->updated_by = 1;

            $category->save();
            $this->import_rows++;
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    // public function sheets(): array
    // {
    //     return [
    //         3 => new ProductCategoryImport(),
    //         0 => $this,
    //     ];
    // }

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
