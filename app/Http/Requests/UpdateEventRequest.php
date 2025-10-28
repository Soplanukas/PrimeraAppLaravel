<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_max_capacity' => 'nullable|integer|min:1',
            'event_speaker_name' => 'required|string|max:255',
            'event_location_name' => 'nullable|string|max:255',
            'event_meetup_url' => 'nullable|url',
            'event_is_virtual' => 'required|boolean',
            'fk_venue_event' => 'nullable|exists:venues,id',
            'event_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
