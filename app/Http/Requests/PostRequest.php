<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'excerpt' => 'required|string|max:500', // extrait
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048', // max 2MB
            'status' => 'required|in:draft,published',
            'user_id' => 'required|exists:users,id',
            'categorie_id' => 'required|exists:categories,id',
            'published_at' => 'nullable|date',
        ];
    }
}
