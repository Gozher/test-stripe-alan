<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UniqueCharges extends Component
{

    public $User;
    public $cardNumber;
    public $month;
    public $year;
    public $cvc;
    public $allproducts;
    public $amount;

    public $ViewAddMethodPayment = true;

    public $brand;
    public $numberCard;

    public function mount()
    {
        $this->User = User::find(Auth::id());

        if (auth()->user()->hasPaymentMethod()) { // verificar si tiene metodo de pago

            $this->ViewAddMethodPayment = false;
            $this->brand = $this->User->card_brand;
            $this->numberCard = $this->User->card_last_four;

        } else {
            $this->ViewAddMethodPayment = true;
        }
    }

    public function render()
    {
        return view('livewire.unique-charges')->layout('layouts.app');
    }

    public function buy()
    {

        try {

            if (!auth()->user()->hasPaymentMethod()) { //varificas si el usuario no tiene metodo de pago

                //validacion del formualario
                $this->validate([
                    'cardNumber' => ['required'],
                    'month' => ['required'],
                    'year' => ['required'],
                    'cvc' => ['required'],
                ]);

                //crear el cliente
                auth()->user()->createAsStripeCustomer(['name' => $this->User->name], );

                //agregas la conexion a stripe
                \Stripe\Stripe::setApiKey(\config('stripe.secret')); //mira el archivo stripe.php de la carpeta config y agrega STRIPE_SECRET y STRIPE_KEY a tu env

                //creamos el metodo de pago
                $paymentMethod = \Stripe\PaymentMethod::create([
                    'type' => 'card',
                    'card' => [
                        'number' => $this->cardNumber,
                        'exp_month' => $this->month,
                        'exp_year' => $this->year,
                        'cvc' => $this->cvc,
                    ],
                ]);
                //adjuntamos el metodo de pago al cliente logeado
                auth()->user()->updateDefaultPaymentMethod($paymentMethod->id);

                //guardamos el registro
                auth()->user()->save();

                //realizamos el cargo usando cashier, como primer parametro pasamos el monto,y como segundo parametro le pasamos el methodo de pago ya registrado
                $charge = auth()->user()->charge(($this->amount * 100), auth()->user()->defaultPaymentMethod()->id, [
                    'description' => 'Cobro por la cantidad de, ' . ($this->amount * 100),
                ]);

            } else { //en caso de que ya tengia un metodo asociado

                $charge = auth()->user()->charge(($this->amount * 100), auth()->user()->defaultPaymentMethod()->id, [
                    'description' => 'Cobro por la cantidad de, ' . ($this->amount * 100),
                ]);
            }

            //retornamos a la vista dfe inicio
            return redirect()->route('dashboard');

        } catch (\Throwable $th) {
            
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Ya ha realizado esta acción']);
        }

    }

}
