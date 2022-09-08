<?php

namespace DoubleThreeDigital\SimpleCommerce\Coupons;

use DoubleThreeDigital\SimpleCommerce\Facades\Coupon;
use Illuminate\Support\Arr;
use Statamic\Facades\YAML;
use Statamic\Stache\Stores\BasicStore;

class CouponStore extends BasicStore
{
    public function key()
    {
        return 'simple-commerce-coupons';
    }

    public function makeItemFromFile($path, $contents)
    {
        $data = YAML::file($path)->parse($contents);

        if (! $id = array_pull($data, 'id')) {
            $idGenerated = true;
            $id = app('stache')->generateId();
        }

        $coupon = Coupon::make()
            ->id($id)
            ->code(array_pull($data, 'code'))
            ->type(array_pull($data, 'type'))
            ->value(array_pull($data, 'value'))
            ->enabled(array_pull($data, 'enabled') ?? true)
            ->data(Arr::except($data, ['code', 'type', 'value', 'enabled']));

        if (isset($idGenerated)) {
            $coupon->save();
        }

        return $coupon;
    }
}
