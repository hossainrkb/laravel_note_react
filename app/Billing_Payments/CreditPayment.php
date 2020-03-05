<?php 
namespace App\Billing_Payments;


class CreditPayment implements PaymentInterface {

    public $curancy;
    public $chargeAmount;
    public $discountAmount;
    public $creditCardNumber;

    public function __construct($curancy)
    {
        $this->curancy = $curancy;
    }

    public function charge($amount)
    {
        $this->chargeAmount = $amount;
    }
    public function discount($amount)
    {
        $this->discountAmount = $amount;
    }

    public function result (){
        $this->charge(500);
        $this->discount(50);
        return [
            'name' => 'Rakib Hossain',
            'curancy' => $this->curancy,
            'amount' => $this->chargeAmount,
            'discount' => $this->discountAmount,
            'final_amount' => $this->chargeAmount - $this->discountAmount,
        ];
    }
}
