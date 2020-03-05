<?php 
namespace App\Billing_Payments;
interface PaymentInterface {
    public function charge($amount);
    public function discount($amount);
}

?>