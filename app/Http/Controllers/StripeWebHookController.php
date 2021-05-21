<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Http\Controllers\WebhookController;

class StripeWebHookController extends WebhookController
{


  public function handleCustomerCreated(array $payload)
  {
    Log::info("Creacion de un cliente");
    Log::info($payload);
  }

  public function handleChargeSucceeded(array $payload)
  {
    Log::info("cargo exitoso");
    Log::info($payload);
  }

  public function handleChargeFailed(array $payload)
  {
    Log::info("cargo fallido");
    Log::info($payload);
  }
}
