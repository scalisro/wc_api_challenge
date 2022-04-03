<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Consultar productos a Tienda'), ['controller'=>'Products', 'action' => 'getAllProducts']) ?></li>
        <li><?= $this->Html->link(__('Exportar y descargar en CSV'), ['controller'=>'Products', 'action' => 'downloadExport']) ?></li>
        <li><?= $this->Html->link(__('Volver a Home'), ['controller'=>'Pages', 'action' => 'home']) ?></li>
    </ul>
</nav>
<div class="products index large-9 medium-8 columns content">
    <h3><?= __('Productos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id', 'Id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sku', 'Sku') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title', 'Titulo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('inventory_quantity', 'Cantidad') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price', 'Precio') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status', 'Estado') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created', 'Creado') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $this->Number->format($product->id) ?></td>
                <td><?= empty(h($product->sku)) ? '(sin datos)': $product->sku ?></td>
                <td><?= h($product->title) ?></td>
                <td><?= $this->Number->format($product->inventory_quantity) ?></td>
                <td><?= $this->Number->format($product->price) ?></td>
                <td><?= h($product->status) ?></td>
                <td><?= h($product->created->format('Y-m-d H:i')) ?></td>
                <td><?= h($product->modified->format('Y-m-d H:i')) ?></td>
                <td>
                    <?php echo $this->Form->postLink('Eliminar',
                                        ['action' => 'delete', $product->id],
                                        ['confirm' => __('¿Seguro que desea eliminar a {0}?', $product->id), 'class'=>'delete', 'escape' => false]); ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
