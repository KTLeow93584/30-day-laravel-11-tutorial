<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'sender_name' => '',
        'recipient_name' => '',
        'message' => '',
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->directory = $this->setDirectory();
    }
}
