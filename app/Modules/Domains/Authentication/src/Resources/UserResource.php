<?php

namespace App\Modules\Domains\Authentication\src\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'status'  => true,
            'data'    => [
                $this->token,
            ],
            'message' => 'success',
        ];
    }
}
