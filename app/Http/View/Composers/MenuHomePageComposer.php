<?php

namespace App\Http\View\Composers;

use App\Model\Admin\Banner;
use App\Model\Admin\Category;
use App\Model\Admin\CategorySpecial;
use App\Model\Admin\PostCategory;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Model\Admin\OrderRevenueDetail;
use App\Model\Common\User;

class MenuHomePageComposer
{
    /**
     * Compose Settings Menu
     * @param View $view
     */
    public function compose(View $view)
    {
        $productCategories = Category::query()->with([
            'childs' => function ($query) {
                $query->with(['childs']);
            }
        ])
        ->where(['type' => 1, 'parent_id' => 0])
        ->orderBy('sort_order')
        ->get();

        $postCategories = PostCategory::query()->where(['parent_id' => 0, 'show_home_page' => 1])->latest()->get();

        $specialCategories = CategorySpecial::query()->with([
            'products' => function($q) {
                $q->where('status', 1);
            }
        ])
        ->has('products')
        ->where('type',10)
        ->where('show_home_page', 1)
        ->orderBy('order_number')->get();

        $users = User::query()->where('status', 1)->where('type', '!=', 1)->latest()->get();

        $view->with(['productCategories' => $productCategories, 'postCategories' => $postCategories, 'specialCategories' => $specialCategories, 'users' => $users]);
    }
}
