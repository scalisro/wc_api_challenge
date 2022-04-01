<?php
namespace App\Controller;

use App\Controller\AppController;
use Automattic\WooCommerce\Client;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('El producto fue eliminado.'));
        } else {
            $this->Flash->error(__('No pudo ser elimando. Vuelva intentar por favor.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Function to get all products from API Woocommerce.
     *
     * @return \Cake\Http\Response|null Redirects 
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function getAllProducts()
    {
        $woocommerce = new Client(
            'https://wp-challenge.ecomexperts.com/',
            'ck_6af9f99c9b577623f83ec48477c96df2c3d19a28',
            'cs_04bdf34c565ab88b8a3f6eda89eb842ddebc9960',
            [
                'version' => 'wc/v2',
            ]
        );

        // Endpoints method.
        $results = $woocommerce->get('products');

        foreach ($results as $key => $result) {

            $productFound = $this->Products->getProductSaved($result->id);

            if(empty($productFound)){
                $product = $this->Products->newEntity();
                $product->productId = $result->id;
                $product->sku = $result->sku;
                $product->title = $result->name;
                $product->description = $result->description;
                $product->inventory_quantity = $result->stock_quantity;
                $product->price = $result->price;
                $product->status = $result->status;

                if(!$this->Products->save($product)){
                    return $this->Flash->error(__('Se produjo un error al un producto.'));
                }
            }
        }
        $this->Flash->success(__('Lista de productos cargada con exito.'));

        return $this->redirect($this->referer());
    }
}
