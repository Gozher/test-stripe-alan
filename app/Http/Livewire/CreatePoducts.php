<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\products;

class CreatePoducts extends Component
{
  public $productName;
  public $interval;
  public $price;
  public $allprices;

    public function render()
    {
        return view('livewire.create-poducts')->layout('layouts.app');
    }

    public function mount()
    {
      $this->allprices = products::all();
    }

    public function CreateProduct()
    {
      try {

        $stripe = new \Stripe\StripeClient(\config('stripe.secret'));
        $product = $stripe->products->create([ 'name' => $this->productName, ]);

        $price = $stripe->prices->create([
                  'unit_amount' => ($this->price *100),
                  'currency' => 'mxn',
                  'recurring' => ['interval' => $this->interval],
                  'product' => $product->id,
                ]);

        products::create([
          'name_product' =>$product->name,
          'stripe_product'=>$product->id,
          'stripe_price'=>$price->id,
          'interval'=>$this->interval,
          'price'=>$this->price
        ]);

        return redirect()->route('products');        

      } catch (\Exception $exception) {
        dd($exception->getMessage());
      }

    }
}
