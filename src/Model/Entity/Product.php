<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int|null $productId
 * @property string|null $sku
 * @property string|null $title
 * @property string|null $description
 * @property int|null $inventory_quantity
 * @property float|null $price
 * @property string|null $status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Product extends Entity
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
        'productId' => true,
        'sku' => true,
        'title' => true,
        'description' => true,
        'inventory_quantity' => true,
        'price' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
    ];
}
