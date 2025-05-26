<?php
namespace App\ExcelImports;

use App\Model\Admin\Category;
use App\Model\Admin\IpProduct;
use App\Model\Admin\Product;
use App\Model\Common\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class IpProductImport implements ToCollection, WithStartRow, WithMultipleSheets
{
    private $import_rows = 0;
    private $skip_rows = 0;
    private $invalid_rows = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row)
        {
            $errors = [];
            if (empty($row[0]) || empty($row[1])) {
                $this->skip_rows++;
                continue;
            }
            $ip = trim($row[0]);
            $product_name = trim($row[1]);
            $customer_name = trim($row[2]);
            $customer_email = trim($row[3]);
            $start_date = is_numeric($row[4]) ? Date::excelToDateTimeObject($row[4])->format('Y-m-d') : $row[4];
            $end_date = is_numeric($row[4]) ? Date::excelToDateTimeObject($row[4] + 30)->format('Y-m-d') : $row[5];
            $data_center = trim($row[6]);
            $note = trim($row[7]);

            $product = Product::where('name', $product_name)->first();
            if(!$product) {
                $errors[] = 'Plan VPS không tồn tại';
            }

            $customer = User::where('type', 10)->where('email', $customer_email)->first();
            if(count($errors)) {
                $this->invalid_rows[] = [
                    'detail' => implode("\n", $errors),
                    'row' => $row,
                    'index' => $index + 2,
                ];
                $this->skip_rows++;
                continue;
            }
            $ip_product = IpProduct::where('ip', $ip)->first();
            if($ip_product) {
                $ip_product->product_id = $product->id;
                $ip_product->user_id = $customer ? $customer->id : null;
                $ip_product->start_date = $start_date;
                $ip_product->end_date = $end_date;
                $ip_product->data_center = $data_center;
                $ip_product->note = $note;
                $ip_product->status = $customer ? 2 : 1;
                $ip_product->payment_status = $customer ? 1 : null;
            } else {
                $ip_product = new IpProduct();
                $ip_product->ip = $ip;
                $ip_product->product_id = $product->id;
                $ip_product->user_id = $customer ? $customer->id : null;
                $ip_product->start_date = $start_date;
                $ip_product->end_date = $end_date;
                $ip_product->data_center = $data_center;
                $ip_product->note = $note;
                $ip_product->status = $customer ? 2 : 1;
                $ip_product->payment_status = $customer ? 1 : null;
                $ip_product->username = 'user';
                $ip_product->password = '123456';
            }
            $ip_product->save();
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
