<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'company_name' => $this->company_name,
            'company_phone' => $this->company_phone,
            'job_title' => $this->job_title,
            'apply_link' => $this->apply_link,
            'applied_at' => $this->applied_at,
            'cv_sent' => $this->cv_sent,
            'status' => $this->status,
            'contact_person' => $this->contact_person,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
