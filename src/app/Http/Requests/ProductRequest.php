<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
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
        return [
            'image' => ['nullable', 'mimes:png,jpeg'],
            'name' => ['required'],
            'price' => ['required', 'integer', 'between:0,10000'],
            'seasons' => ['required', 'array'],
            'description' => ['required', 'max:120'],
        ];
    }

    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {
    //         // 編集対象の商品を取得
    //         $productId = $this->route('product'); // ルートパラメータからID取得
    //         $product = \App\Models\Product::find($productId);

    //         // 画像がまだ登録されていない && 今回アップロードもされていない場合
    //         if (!$product || (!$product->image && !$this->hasFile('image'))) {
    //             $validator->errors()->add('image', '商品画像を登録してください');
    //         }
    //     });
    // }

    public function messages()
    {
        return [
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.integer' => '数値で入力してください',
            'price.between' => '0~10000円以内で入力してください',
            'seasons.required' => '季節を選択してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
        ];
    }
}
