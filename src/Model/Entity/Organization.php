<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Organization Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property bool $active
 * @property bool $active_product_feature
 * @property bool $active_order_feature
 * @property bool $active_invoicing_feature
 * @property bool $active_case_feature
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $last_updated
 *
 * @property \App\Model\Entity\Customer[] $customer
 * @property \App\Model\Entity\Group[] $group
 * @property \App\Model\Entity\Invoice[] $invoice
 * @property \App\Model\Entity\InvoiceItem[] $invoice_item
 * @property \App\Model\Entity\Order[] $order
 * @property \App\Model\Entity\OrderItem[] $order_item
 * @property \App\Model\Entity\Payment[] $payment
 * @property \App\Model\Entity\PriceEntry[] $price_entry
 * @property \App\Model\Entity\Product[] $product
 * @property \App\Model\Entity\SupportCase[] $support_case
 * @property \App\Model\Entity\User[] $user
 * @property \App\Model\Entity\UserGroup[] $user_group
 */
class Organization extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'email' => true,
        'phone' => true,
        'address' => true,
        'currency_used' => true,
        'active' => true,
        'active_product_feature' => true,
        'active_order_feature' => true,
        'active_invoicing_feature' => true,
        'active_case_feature' => true,
        'created_at' => true,
        'last_updated' => true,
        'customer' => true,
        'group' => true,
        'invoice' => true,
        'invoice_item' => true,
        'order' => true,
        'order_item' => true,
        'payment' => true,
        'price_entry' => true,
        'product' => true,
        'support_case' => true,
        'user' => true,
        'user_group' => true
    ];
}
