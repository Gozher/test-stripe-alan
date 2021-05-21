<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\products;


class CreateSubscription extends Component
{

  public $User;
  public $cardNumber;
  public $month;
  public $year;
  public $cvc;
  public $allproducts;
  public $PlanSelect;



    public function mount()
    {
      $this->User = User::find(Auth::id());
      $this->allproducts = products::all();
    }

    public function render()
    {
        return view('livewire.create-subscription')->layout('layouts.app');
    }

    public function newSubscription()
    {
        $this->validate([
          'cardNumber' => ['required'],
          'month' => ['required'],
          'year' => ['required'],
          'cvc' => ['required'],
        ]);

        try {

          if(!auth()->user()->hasPaymentMethod()){

            auth()->user()->createAsStripeCustomer(['name' => $this->User->name],);

            \Stripe\Stripe::setApiKey(\config('stripe.secret'));
            $paymentMethod = \Stripe\PaymentMethod::create([
                'type' => 'card',
                'card' => [
                    'number' => $this->cardNumber,
                    'exp_month' => $this->month,
                    'exp_year' => $this->year,
                    'cvc' => $this->cvc,
                ],
            ]);
            auth()->user()->updateDefaultPaymentMethod($paymentMethod->id);
            auth()->user()->save();
            $Plan = products::find($this->PlanSelect);
            auth()->user()->newSubscription($Plan->name_product,$Plan->stripe_price)->create();

            return redirect()->route('dashboard');

          }else{
          //  dd("si tiene");
          }

        } catch (\Exception $exception) {
          dd($exception->getMessage());
        }

    }

}
