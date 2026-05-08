<?php

namespace App\Plans;

use Ro749\ListingUtils\Plans\PlansBase;
use Ro749\ListingUtils\Plans\Personalized\DiscountLine;

class Plans extends PlansBase
{
    function get_default_plan($id,$title,$discount,$personal=false)
    {
        $plan = parent::get_default_plan($id,$title,$discount,$personal);
        $plan->top_lines[] = new DiscountLine(
            form: $this->form,
            text: "Descuento",
            id: 'discount_'.$id,
            classes: ['discount'],
            plan_id: $id
            ); 
        return $plan;
    }
}