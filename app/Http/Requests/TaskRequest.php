<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $taskId = $this->route('task');
        return [
            'title' => [
                'required',
                'min:3',
                Rule::unique('tasks', 'title')->ignore($taskId)
            ],
            'description' => 'required|min:10',
            'user_id' => 'required|exists:users,id',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'nullable|in:to-do,in_progress,done'
        ];
    }

    public function messages(): array
    {
        return [
            'title.unique' => 'Bro, this task title already exists. Pick another one!',
            'user_id.exists' => 'That team member does not exist in our system.',
            'description.min' => 'Please provide a bit more detail (at least 10 characters).'
        ];
    }
}
