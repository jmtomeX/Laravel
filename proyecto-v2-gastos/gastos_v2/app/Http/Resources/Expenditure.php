<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Expenditure extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $res = array();

        if (isset($this->exp_id)) {
            $id = $this->exp_id;
            $res = [
                'id' => $this->exp_id,
                'date' => $this->date,
                'description' => $this->description,
                'amount' => $this->amount,
                'type_id' => $this->type_id,
                'file' => $this->file,
                'type' => $this->type,
                'category_id' => $this->category_id,
                'category' => $this->category,
                //'created_at' => $this->created_at->format('d/m/Y'),
                //'updated_at' => $this->updated_at->format('d/m/Y'),
            ];
        } else {
            $res = [
                'id' => $this->id,
                'date' => $this->date,
                'description' => $this->description,
                'amount' => $this->amount,
                'type_id' => $this->type_id,
                'file' => $this->file,
                //'type' => $this->type,
            ];
        }

        return $res;
    }
}
