<?php

namespace App\Transformers;

use App\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransfomer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Seller $seller)
    {
        return [
            'identifier' => (int)$seller->id,
            'name' => (string)$seller->name,
            'email' => (string)$seller->email,
            'isVerified' => (int)$seller->verified,
            'creationDate' => $seller->created_at,
            'lastChange' => $seller->updated_at,
            'deleteDate' => isset($seller->delete_at) ? (string) $seller->delete_at : null,
        ];
    }
}