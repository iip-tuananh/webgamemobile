<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends BaseRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'type' => 'required|in:0,1',
            'name' => 'required|unique:products,name',
            'cate_id' => 'required|exists:categories,id',
            'manufacturer_id' => 'nullable|exists:manufacturers,id',
            'origin_id' => 'nullable|exists:origins,id',
            'intro' => 'nullable',
            'short_des' => 'nullable',
            'body' => 'nullable',
            'base_price' => 'nullable|integer',
            'price' => 'nullable|integer',
            'status' =>'required|in:0,1',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:3000',
            'galleries' => 'nullable|array|min:1|max:20',
            'galleries.*.image' => 'nullable|file|mimes:png,jpg,jpeg|max:10000',
            'post_ids' => 'nullable|array|max:5',
            'videos' => 'nullable|array',
            // 'person_in_charge' => 'required_if:type,0|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'aff_link' => 'required|url',
            'short_link' => 'required|url',
            'origin_link' => 'required|url',
        ];

        // if($this->input('type') == 0) {
        //     $rules['cate_id'] = 'required|exists:categories,id';
        //     $rules['person_in_charge'] = 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        // }

        // if($this->input('type') == 1) {
        //     $rules['aff_link'] = 'required|url';
        //     $rules['short_link'] = 'required|url';
        //     $rules['origin_link'] = 'required|url';
        // }

        // if($this->input('base_price') > 0) {
        //     $rules['base_price'] = 'nullable|integer|min:' . $this->input('price');
        // }

        $url_custom = $this->get('url_custom');
        if($url_custom) {
            $rules['url_custom']  = 'unique:products,url_custom';
        }

        $videoInput = $this->get('videos');

        if(($videoInput)) {
            foreach ($videoInput as $key => $video) {
                $rules['videos.'.$key.'.'.'link']   = 'required';
                $rules['videos.'.$key.'.'.'video']   = 'required';
            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'aff_link.url' => 'Link zalo không hợp lệ',
            'short_link.url' => 'Link fanpage không hợp lệ',
            'origin_link.url' => 'Link game không hợp lệ',
        ];
    }
}
