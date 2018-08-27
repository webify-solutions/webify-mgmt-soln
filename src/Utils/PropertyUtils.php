<?php
/**
 * Created by PhpStorm.
 * User: mohammed.waked
 * Date: 2018-07-22
 * Time: 5:01 PM
 */

namespace App\Utils;


class PropertyUtils
{
    public static $currencies = ['USD' => 'USD', 'LL' => 'LL'];
    public static $discountUnits = ['Percentage' => 'Percentage', 'Amount' => 'Amount'];

    public static $orderTypes = ['one-time' => 'One time payment', 'recurring-payments' => 'Multiple Payments', 'recurring-invoicing' => 'Subscription'];

    public static  $roles = ['Admin'=> 'Admin', 'Sales' => 'Sales', 'Cashier' => 'Cashier', 'Technician' => 'Technician'];

    public static $inputTypes = [
      'text' => 'Text',
      'number' => 'Number',
      'file' => 'File Upload',
      // 'checkbox' => 'Check Box',
      'date' => 'Date',
      'datetime-local' => 'Date Time',
      'email' => 'Email',
      'password' => 'Password',
      'tel' => 'Telephone',
      'url' => 'URL'
    ];
}
