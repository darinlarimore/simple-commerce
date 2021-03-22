<?php

namespace DoubleThreeDigital\SimpleCommerce\Contracts;

use DoubleThreeDigital\SimpleCommerce\Data\Gateways\GatewayPrep;
use DoubleThreeDigital\SimpleCommerce\Gateways\Purchase;
use DoubleThreeDigital\SimpleCommerce\Gateways\Response;
use Illuminate\Http\Request;
use Statamic\Entries\Entry;

interface Gateway
{
    public function name(): string;

    public function prepare(GatewayPrep $data): Response;

    public function purchase(Purchase $data): Response;

    public function purchaseRules(): array;

    public function getCharge(Entry $order): Response;

    public function refundCharge(Entry $order): Response;

    public function webhook(Request $request);
}
