<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
    $this->assign('title', 'Exportar Archivos');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Volver a Home'), ['controller'=>'Pages', 'action' => 'home']) ?></li>
    </ul>
</nav>
<div class="products index large-9 medium-8 columns content">
    <h3><?= 'Archivos CSV' ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">Archivos</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $key => $file): ?>
            <tr>
                <td><?= $file ?></td>
                <td>
                    <?= $this->Html->link(__('Descargar'), ['controller'=>'Products', 'action' => 'downloadCsvFile', $file]) ?> |
                    <?php echo $this->Form->postLink('Eliminar',
                                        ['action' => 'deleteCsvFile', $file],
                                        ['confirm' => __('¿Seguro que desea eliminar a {0}?', $file), 'class'=>'delete', 'escape' => false]); ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
